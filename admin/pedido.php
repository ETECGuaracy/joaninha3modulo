<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginSecretaria.php');
	
	Require('header.php');
	
	Require('conecta.php');
?>
<p class="titulo">Pedidos da Loja Virtual</p>
<?PHP
	$idPedido = $_GET['idPedido'];
	
	if($idPedido == ""){
		?>
        <script>
		$(document).ready(function(){
			$("#tblPedido").tablesorter();
		});
		</script>
        <table border="1" id="tblPedido" class="paddingTbl">
			<thead>
			<tr>
				<th>Data do início</th>
                <th>Aluno</th>
				<th>Status</th>
			</tr>
			</thead>
		<?PHP
			$sql = "SELECT * FROM lojapedido AS p LEFT JOIN aluno AS a ON p.idAluno = a.idAluno ORDER BY idPedido DESC";
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
			?>
			<tr onclick="window.location = '<?PHP echo "?idPedido=" . $registro['idPedido']; ?>';" class="cursorPointer">
				<td><?PHP echo formatarData($registro['dataInicio']); ?></td>
                <td><?PHP
                	if($registro['nome'] == ""){
						echo "(Anônimo)";
					}else{
						echo $registro['nome'];
					}
				?></td>
				<td<?PHP
				if($registro['status'] != "cancelado" && $registro['status'] != "finalizado" && $registro['status'] != "comprando"){
					?> style="font-weight:bold;"<?PHP
				}
				?>><?PHP echo ucwords($registro['status']); ?></td>
			</tr>
			<?PHP
			}
		?>
		</table>
		<?PHP
	}else{
		$status = $_GET['status'];
		if($status == "comprando" || $status == "pagamento" || $status == "retirada" || $status == "finalizado" || $status == "cancelado"){
			$sql = "UPDATE lojapedido SET status = '$status' WHERE idPedido = $idPedido";
			if (!mysql_query($sql)){
				echo "Não foi possível alterar o status deste pedido.";
			}else{
				?><script>window.location='pedido.php?idPedido=' + <?PHP echo $idPedido; ?>;</script><?PHP
			}
		}
		
		$sql = "SELECT * FROM lojapedido AS p LEFT JOIN aluno AS a ON p.idAluno = a.idAluno WHERE idPedido = $idPedido";
		$selecao = mysql_query($sql);
		$registro = mysql_fetch_assoc($selecao);
		$linhas = mysql_num_rows($selecao);
		if($linhas == 0){
			?><p>Pedido não encontrado.</p><?PHP
		}else{
			?>
            <script>
			function alterarStatus(status){
				if(confirm('Tem certeza de que deseja alterar o status deste pedido?')){
					window.location = '?status=' + status + '&idPedido=<?PHP echo $idPedido; ?>';
				}
			}
			function visualizarCartao(){
				div = document.getElementById('dadosCartao');
				if(div.style.display == "block"){
					div.style.display = "none";
				}else{
					div.style.display = "block";
				}
			}
			</script>
            <style>
			#dadosCartao{
				display:none;
			}
			</style>
			<p><a href="pedido.php">Voltar para Pedidos</a></p>
			<table>
			  <tr>
				<td class="tituloTblDireita">Data do início:</td>
				<td><?PHP echo formatarDataExtenso($registro['dataInicio']); ?></td>
			  </tr>
              <tr>
				<td class="tituloTblDireita">Nome do aluno:</td>
				<td><?PHP
                	if($registro['nome'] == ""){
						echo "(Anônimo)";
					}else{
						echo "<a href='cadastro.php?tipo=aluno&idCadastro=" . $registro['idAluno'] . "'>" . $registro['nome'] . " (clique para detalhes)</a>";
					}
				?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Status:</td>
				<td><?PHP echo ucwords($registro['status']); ?></td>
			  </tr>
              <tr>
              	<td class="tituloTblDireita">Alterar status:</td>
				<td><a href="javascript:void(0);" onclick="javascript:alterarStatus('comprando');">Abrir pedido</a> | <a href="javascript:void(0);" onclick="javascript:alterarStatus('cancelado');">Cancelar pedido</a> | <a href="javascript:void(0);" onclick="javascript:alterarStatus('pagamento');">Não pagou</a> | <a href="javascript:void(0);" onclick="javascript:alterarStatus('retirada');">Já pagou</a> | <a href="javascript:void(0);" onclick="javascript:alterarStatus('finalizado');">Já retirou</a></td>
              </tr>
              <tr>
                <td class="tituloTblDireita">Pagamento:</td>
                <td><?PHP
                if($registro['formaPgm'] == "cartao"){
                    ?><a href="javascript:visualizarCartao();">Cartão (<?PHP echo ucwords($registro['cartaoTipo']); ?>)</a>
					<div style="font-size:10px;">para visualizar os dados do cartão, clique acima.</div><?PHP
                }else if($registro['formaPgm'] == "dinheiro"){
                    ?>Dinheiro<?PHP
                }else{
                    ?>Não foi efetuado um pagamento<?PHP
                }
                ?></td>
              </tr>
			</table>
            <?PHP
            if($registro['formaPgm'] == "cartao"){
				#faz a soma total do pedido e salva na variável $valorTotal
				$sql2 = "SELECT * FROM lojaitem i, lojaproduto p WHERE i.idProduto = p.idProduto AND i.idPedido = $idPedido";
				$selecao2 = mysql_query($sql2);
				$valorTotal = 0;
				$contador = 0;
				while($registro2 = mysql_fetch_assoc($selecao2)){
					$contador++;
					$valorTotalProduto = str_replace(",",".",$registro2['valor']) * $registro2['qtd'];
					$valorTotal = $valorTotal + $valorTotalProduto;
				}
				?>
				<div id="dadosCartao">
                <table>
                	<tr>
                    	<td class="tituloTblDireita">Número do Cartão:</td>
                        <td><?PHP echo $registro['cartaoNum'] ; ?></td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Vencimento:</td>
                        <td><?PHP echo $registro['cartaoVenc'] ; ?></td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Nome impresso:</td>
                        <td><?PHP echo $registro['cartaoNome'] ; ?></td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Código de Segurança:</td>
                        <td><?PHP echo $registro['cartaoCodS'] ; ?></td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Parcelas:</td>
                        <td><?PHP echo $registro['cartaoParcelas'] ; ?> x R$: <?PHP echo number_format($valorTotal/$registro['cartaoParcelas'], 2, ',', ''); ?></td>
                    </tr>
                </table>
                </div>
				<?PHP
			}
			?>
			<p></p>
			<script>
			$(document).ready(function(){
				$("#tblCarrinho").tablesorter();
			});
			</script>
			<table border="1" id="tblCarrinho" class="paddingTbl">
				<thead>
				<tr>
					<th>Ordem</th>
					<th>Nome do produto</th>
					<th>Valor unitário</th>
					<th>Quantidade</th>
					<th>Valor total</th>
				</tr>
				</thead>
				<?PHP
				$sql = "SELECT * FROM lojaitem i, lojaproduto p WHERE i.idProduto = p.idProduto AND i.idPedido = $idPedido ORDER BY i.idItem";
				$selecao = mysql_query($sql);
				$total = 0;
				$contador = 0;
				while($registro = mysql_fetch_assoc($selecao)){
					$contador++;
					$valorTotalProduto = str_replace(",",".",$registro['valor']) * $registro['qtd'];
					?>
					<tr>
						<td><?PHP echo $contador; ?></td>
						<td><?PHP echo $registro['nome']; ?></td>
						<td>R$: <?PHP echo $registro['valor']; ?></td>
						<td align="center"><?PHP echo $registro['qtd']; ?></td>
						<td>R$: <?PHP echo number_format($valorTotalProduto, 2, ',', ''); ?></td>
					</tr>
					<?PHP
					$total = $total + $valorTotalProduto;
				}
				?>
				<tfoot>
				<tr>
					<td colspan="4" class="tituloTblDireita">Total:</td>
					<td>R$: <?PHP echo number_format($total, 2, ',', ''); ?></td>
				</tr>
				</tfoot>
			</table>
			<?PHP
		}
	}
	?>
	<p></p>
	<table>
		<tr>
			<td colspan="2" align="center"><strong>Legenda</strong></td>
		</tr>
		<tr>
			<td class="tituloTblDireita">Comprando</td>
			<td>O usuário ainda está escolhendo os produtos e as quantidades que quer comprar.</td>
		</tr>
		<tr>
			<td class="tituloTblDireita">Pagamento</td>
			<td>O usuário já terminou de escolher os produtos e falta efetuar o pagamento.</td>
		</tr>
		<tr>
			<td class="tituloTblDireita">Retirada</td>
			<td>O usuário já pagou e ainda não retirou o produto.</td>
		</tr>
		<tr>
			<td class="tituloTblDireita">Finalizado</td>
			<td>A compra foi finalizada com sucesso!</td>
		</tr>
		<tr>
			<td class="tituloTblDireita">Cancelado</td>
			<td>A compra foi cancelada.</td>
		</tr>
        <tr>
			<td class="tituloTblDireita">(Anônimo)</td>
			<td>O usuário não fez o login.</td>
		</tr>
	</table>
	<?PHP
?>
<?PHP
	Require('footer.php');
?>