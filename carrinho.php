<?PHP
	session_start();
	
	Require('conecta.php');
	
	$acao = $_GET['acao'];
	$idProduto = $_GET['idProduto'];
	$qtd = $_GET['qtd'];
	$idAluno = $_SESSION['idAluno'];
	
	if($_GET['idCarrinho'] != ""){
		$idPedido = addslashes($_GET['idCarrinho']);
	}else if($_SESSION['idCarrinho'] != ""){
		$idPedido = $_SESSION['idCarrinho'];
	}else if($_COOKIE['idCarrinho'] != ""){
		$idPedido = $_COOKIE['idCarrinho'];
	}
	
	if($idAluno != "" && $_COOKIE['idCarrinho'] != ""){
		$sql = "UPDATE lojapedido SET idAluno = '$idAluno' WHERE idPedido = '$idPedido'";
		if (!mysql_query($sql)){
			$erroCarrinho = "Houve um erro.";
		}else{
			$_SESSION['idCarrinho'] = $_COOKIE['idCarrinho'];
			setcookie("idCarrinho", "", time()-60*60*24*7); #limpando o cookie.
			header('location: carrinho.php');
			exit();
		}
	}
	
	if($idPedido != ""){
		if($_GET['idCarrinho'] != ""){
			$sql = "SELECT * FROM lojapedido WHERE idPedido = '$idPedido' AND status = 'comprando' AND idAluno = '$idAluno'";
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				header('location: carrinho.php');
				exit();
			}else{
				$_SESSION['idCarrinho'] = $idPedido;
				header('location: carrinho.php');
			}
		}else if($_SESSION['idCarrinho'] != ""){
			$sql = "SELECT * FROM lojapedido WHERE idPedido = '$idPedido' AND status = 'comprando' AND idAluno = '$idAluno'";
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				$_SESSION['idCarrinho'] = ""; #limpando a session.
				header('location: carrinho.php');
				exit();
			}
		}else if($_COOKIE['idCarrinho'] != ""){
			$sql = "SELECT * FROM lojapedido WHERE idPedido = '$idPedido' AND status = 'comprando' AND idAluno = '0'";
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				setcookie("idCarrinho", "", time()-60*60*24*7); #limpando o cookie.
				header('location: carrinho.php');
				exit();
			}
		}
	}
	
	if($idProduto != ""){
		if($acao == ""){
			if($idPedido == ""){ #criar um pedido caso o usuário não tenha pedido nada.
				$data = time();
				$sql = "INSERT INTO lojapedido (idAluno, dataInicio, status) VALUES ('$idAluno', '$data()', 'comprando')";
				mysql_query($sql);
				$idCarrinho = mysql_insert_id();
				if($idAluno == ""){ #se o usuário estiver logado, coloca o id na sessão, caso contrário, coloca no cookie.
					setcookie("idCarrinho", $idCarrinho, time()+60*60*24*7); #o cookie irá expirar em 7 dias.
				}else{
					$_SESSION['idCarrinho'] = $idCarrinho;
				}
				$idPedido = $idCarrinho;
			}
			
			$sql = "SELECT * FROM lojaitem WHERE idPedido = '$idPedido' AND idProduto = '$idProduto'"; #verificar se o produto já não esta na lista.
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas != 0 && $qtd == 0){ #se o produto já estiver no pedido e a quantidade for 0.
				$erroCarrinho = "Este produto já existe em seu pedido. Para alterar a quantidade, clique sobre ela.";
			}else{
				if($qtd == 0){ #então insere o produto no pedido.
					$qtd = 1;
					$data = time();
					$sql = "INSERT INTO lojaitem (idPedido, idProduto, qtd, dataInserido) VALUES ('$idPedido', '$idProduto', '$qtd', '$data')";
					if (!mysql_query($sql)){
						$erroCarrinho = "Houve um erro e o produto não foi adicionado ao carrinho.";
					}else{
						header('location: carrinho.php');
					}
				}else{ #alterar a quantidade do produto.
					$sql = "UPDATE lojaitem SET qtd = '$qtd' WHERE idPedido = '$idPedido' AND idProduto = '$idProduto'";
					if (!mysql_query($sql)){
						$erroCarrinho = "Houve um erro e a quantidade do produto não foi alterada.";
					}else{
						header('location: carrinho.php');
					}
				}
			}
		}else{ #então a variavel acao tem algum valor.
			if($idPedido == ""){
				$erroCarrinho = "Não conseguimos localizar o seu pedido.";
			}else{ #executa quando tem o idProduto e o idPedido e alguma acao é solicitada.
				if($acao == "excluir"){
					$sql = "DELETE FROM lojaitem WHERE idPedido = '$idPedido' AND idProduto = '$idProduto'";
					if (!mysql_query($sql)){
						$erroCarrinho = "Houve um erro e o produto não pode ser excluído.";
					}else{
						header('location: carrinho.php');
					}
				}
			}
		}
	}else{ #idProduto é vazio
		if($acao != ""){
			if($idPedido == ""){
				$erroCarrinho = "Não conseguimos localizar o seu pedido.";
			}else{ #executa quando idProduto é vazio mas temos um idPedido em aberto (no cookie ou na session)
				if($acao == "cancelar"){
					$sql = "UPDATE lojapedido SET status = 'cancelado' WHERE idPedido = '$idPedido'";
					if (!mysql_query($sql)){
						$erroCarrinho = "Houve um erro e o seu pedido não foi cancelado.";
					}else{
						setcookie("idCarrinho", "", time()-60*60*24*7); #limpando o cookie.
						$_SESSION['idCarrinho'] = ""; #limpando a session.
						header('location: carrinho.php');
					}
				}else if($acao == "finalizar"){
					if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno" || $_SESSION['idAluno'] == ""){
						$erroCarrinho = "Por favor, faça o login acima para finalizar a compra.";
					}else{
						if($idAluno == ""){
							$erroCarrinho = "Não conseguimos localizar o aluno.";
						}else{
							$sql = "UPDATE lojapedido SET idAluno = '$idAluno', status = 'pagamento' WHERE idPedido = '$idPedido'";
							if(!mysql_query($sql)){
								$erroCarrinho = "Houve um erro e o seu pedido não pode ser concluído.";
							}else{
								setcookie("idCarrinho", "", time()-60*60*24*7); #limpando o cookie.
								$_SESSION['idCarrinho'] = ""; #limpando a session.
								header("location: meusPedidos.php?idPedido=$idPedido");
							}
						}
					}
				}
			}
		}
	}
?>
<?PHP
	Require('header.php');
?>
<p class="titulo">Meu Carrinho</p>
<?PHP
	if($erroCarrinho != ""){
		?>
		<script>
			document.getElementById('caixaMsgConteudo').innerHTML = '<?PHP echo $erroCarrinho; ?>';
			acaoDepoisMsgFechar = "nao";
			abrirMsg();
        </script>
		<?PHP
	}
	if($idPedido == ""){
		?>O seu carrinho está vazio. <a href="loja.php"><strong>Clique aqui</strong></a> para comprar.<?PHP
	}else{
		?>
		<script>
		$(document).ready(function(){
			$("#tblCarrinho").tablesorter({
			headers:{
				5:{
					sorter: false
				}
			}
			});
		});
		function alteraQtd(id,qtdOriginal){
			qtd = document.getElementById('qtd' + id);
			if(qtdOriginal != qtd.value){
				window.location = 'carrinho.php?idProduto=' + id + '&qtd=' + qtd.value;
			}
		}
		function excluirProduto(id){
			if(confirm('Tem certeza de que deseja remover este produto?')){
				window.location = 'carrinho.php?acao=excluir&idProduto=' + id;
			}
		}
		</script>
        <?PHP
		$sql = "SELECT * FROM lojapedido WHERE idPedido = $idPedido";
		$selecao = mysql_query($sql);
		$registro = mysql_fetch_assoc($selecao);
		?>
        <p>Pedido iniciado em: <?PHP echo formatarDataExtenso($registro['dataInicio']); ?></p>
        <a href="loja.php"><img src="_img/continuar.jpg" border="0" /></a>
        <a href="carrinho.php?acao=cancelar"><img src="_img/cancelar.jpg" border="0" /></a>
        <a href="carrinho.php?acao=finalizar"><img src="_img/finalizar.jpg" border="0" /></a>
		<table border="1" id="tblCarrinho">
			<thead>
			<tr>
				<th>Ordem</th>
				<th>Nome do produto</th>
				<th>Valor unitário</th>
				<th>Quantidade</th>
				<th>Valor total</th>
				<th width="60">Remover</th>
			</tr>
			</thead>
		<?PHP
		$sql = "SELECT * FROM lojaitem i, lojaproduto p WHERE i.idProduto = p.idProduto AND i.idPedido = $idPedido ORDER BY i.idItem";
		$selecao = mysql_query($sql);
		$contador = 0;
		while($registro = mysql_fetch_assoc($selecao)){
			$contador++;
			$valorTotalProduto = str_replace(",",".",$registro['valor']) * $registro['qtd'];
			?>
			<tr>
				<td><?PHP echo $contador; ?></td>
				<td><?PHP echo $registro['nome']; ?></td>
				<td>R$: <?PHP echo $registro['valor']; ?></td>
				<td align="center"><input type="text" value="<?PHP echo $registro['qtd']; ?>" name="qtd<?PHP echo $registro['idProduto']; ?>" id="qtd<?PHP echo $registro['idProduto']; ?>" size="2" style="text-align:center" onKeyPress="return SomenteNumero(event)" onBlur="alteraQtd('<?PHP echo $registro['idProduto']; ?>','<?PHP echo $registro['qtd']; ?>');" /></td>
				<td>R$: <?PHP echo number_format($valorTotalProduto, 2, ',', ''); ?></td>
				<td align="center" class="cursorPointer" onClick="excluirProduto('<?PHP echo $registro['idProduto']; ?>');"><img src="_img/errado.jpg" width="25" /></td>
			</tr>
			<?PHP
			$total = $total + $valorTotalProduto;
		}
		?>
        	<tfoot>
            <tr>
				<td colspan="4" class="tituloTblDireita">Total:</td>
				<td>R$: <?PHP echo number_format($total, 2, ',', ''); ?></td>
				<td>&nbsp;</td>
			</tr>
            </tfoot>
		</table>
        <div style="font-size:12px;">para alterar a quantidade de algum produto, digite o novo valor e clique fora do campo para atualizar</div>
       <a href="loja.php"><img src="_img/continuar.jpg" border="0" /></a>
       <a href="carrinho.php?acao=cancelar"><img src="_img/cancelar.jpg" border="0" /></a>
       <a href="carrinho.php?acao=finalizar"><img src="_img/finalizar.jpg" border="0" /></a>
		<?PHP
	}
?>
<?PHP
	Require('footer.php');
?>