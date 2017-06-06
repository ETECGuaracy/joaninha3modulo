<?PHP
	Require('header.php');
	
	Require('conecta.php');	
?>
<p class="titulo">Loja Virtual</p>
<?PHP
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno"){
		?>
        	<p>Página restrita a pais e alunos da escola.</p>
            <p>Para acessar o conteúdo faça o login.</p>
            <p>Caso seu filho não esteja cadastrado no sistema, por favor, solicite a secretaria.</p>
		<?PHP
	}else{
		$idAluno = $_SESSION['idAluno'];
		$idPedido = $_GET['idPedido'];
		
		$sql = "SELECT * FROM lojapedido WHERE idPedido = $idPedido AND idAluno = '$idAluno'";
		if(!mysql_query($sql)){
			?><p>Pedido não encontrado.</p><?PHP
		}else{
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			$linhas = mysql_num_rows($selecao);
			if($linhas == 0){
				?><p>Pedido não encontrado.</p><?PHP
			}else{
				$statusPedido = $registro['status'];
				if($statusPedido != "pagamento"){#ver se o status do pedido é de pagamento
					?><p>Este pedido não está pronto para ser pago ou já foi efetuado um pagamento.</p><?PHP
				}else{
					$txtFormaPgm = $_POST['txtFormaPgm'];
					$txtValorTotal = $_POST['txtValorTotal'];
					$txtCartaoTipo = $_POST['txtCartaoTipo'];
					$txtCartaoNum = $_POST['txtCartaoNum'];
					$txtCartaoVenc = $_POST['txtCartaoVenc'];
					$txtCartaoNome = $_POST['txtCartaoNome'];
					$txtCartaoCodS = $_POST['txtCartaoCodS'];
					$txtCartaoParcelas = $_POST['txtCartaoParcelas'];
					
					if($txtFormaPgm == "dinheiro"){
						$sql = "UPDATE lojapedido SET status = 'retirada', formaPgm = '$txtFormaPgm' WHERE idPedido = '$idPedido'";
						if (!mysql_query($sql)){
							?><p>Houve um erro e o pagamento não foi efetuado. Tente novamente mais tarde.</p><?PHP
						}else{
							?>
                                <p>Forma de pagamento: <strong>Dinheiro</strong></p>
                                <p>O valor total do pagamento é de: <strong>R$: <?PHP echo $txtValorTotal; ?></strong></p>
                                <p>O pagamento em dinheiro é feito na secretaria da escola a qualquer momento ou na retirada do(s) produto(s).</p>
                                <p>O seu pedido foi concluído com sucesso! Para retirar o(s) produto(s) basta informar o nome do aluno na secretaria da escola.</p>
                                <p><strong><a href="javascript:void(0);" onclick="imprimirPedido('<?PHP echo $idPedido; ?>');">Imprimir pedido</a> | <a href="meusPedidos.php">Ir para Meus Pedidos</a></strong></p>
                            <?PHP
						}
					}else if($txtFormaPgm == "cartao"){
						if($txtCartaoTipo == "" || $txtCartaoNum == "" || $txtCartaoVenc == "" || $txtCartaoNome == "" || $txtCartaoCodS == "" ||$txtCartaoParcelas == ""){#verificar se os campos não estão em branco
							?>
                            	<p>É necessário preencher todo o formulário do cartão.</p>
                                <p><a href="meusPedidos.php?idPedido=<?PHP echo $idPedido; ?>"><strong>Voltar para o pedido.</strong></a></p>
							<?PHP
						}else{
							#salvar dados do cartão no banco de dados
							$sql = "UPDATE lojapedido SET status = 'retirada', formaPgm = '$txtFormaPgm', cartaoTipo = '$txtCartaoTipo', cartaoNum = '$txtCartaoNum', cartaoVenc = '$txtCartaoVenc', cartaoNome = '$txtCartaoNome', cartaoCodS = '$txtCartaoCodS', cartaoParcelas = '$txtCartaoParcelas' WHERE idPedido = '$idPedido'";
							if (!mysql_query($sql)){
								?><p>Houve um erro e o pagamento não foi efetuado. Tente novamente mais tarde.</p><?PHP
							}else{
								?>
                                    <p>Forma de pagamento: <strong>Cartão</strong></p>
                                    <p>Você escolheu pagar em <strong><?PHP echo $txtCartaoParcelas; ?></strong> parcelas de <strong>R$: <?PHP echo number_format($txtValorTotal/$txtCartaoParcelas, 2, ',', ''); ?></strong></p>
                                    <p>O valor total do pagamento é de: <strong>R$: <?PHP echo $txtValorTotal; ?></strong></p>
                                    <p>O seu pedido foi concluído com sucesso! Para retirar o(s) produto(s) basta informar o nome do aluno na secretaria da escola.</p>
                                    <p><strong><a href="javascript:void(0);" onclick="imprimirPedido('<?PHP echo $idPedido; ?>');">Imprimir pedido</a> | <a href="meusPedidos.php">Ir para Meus Pedidos</a></strong></p>
                                <?PHP
							}
						}
					}else{
						?>
                        	<p>Não foi possível efetuar o pagamento de seu pedido. Tente novamente mais tarde.</p>
                            <p><a href="meusPedidos.php?idPedido=<?PHP echo $idPedido; ?>"><strong>Voltar para o pedido.</strong></a></p>
						<?PHP
					}
				}
			}
		}
	}
?>
<?PHP
	Require('footer.php');
?>