<?PHP
	Require('header.php');
	
	Require('conecta.php');	
?>
<p class="titulo">Meus pedidos da Loja Virtual</p>
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
					<th>Status</th>
				</tr>
				</thead>
			<?PHP
				$sql = "SELECT * FROM lojapedido WHERE idAluno = '$idAluno' ORDER BY idPedido DESC";
				$selecao = mysql_query($sql);
				
				while($registro = mysql_fetch_assoc($selecao)){
				?>
				<tr onclick="window.location = '<?PHP echo "?idPedido=" . $registro['idPedido']; ?>';" class="cursorPointer">
					<td><?PHP echo formatarData($registro['dataInicio']); ?></td>
					<td<?PHP
                    if($registro['status'] != "cancelado" && $registro['status'] != "finalizado"){
						?> style="font-weight:bold;"<?PHP
					}
					?>><?PHP echo ucwords($registro['status']); ?></td>
				</tr>
				<?PHP
				}
			?>
			</table>
            <p style="font-size:12px;">Para ver mais detalhes do pedido, clique sobre ele.</p>
			<?PHP
		}else{
			?><p><a href="meusPedidos.php">Voltar para Meus pedidos</a></p><?PHP
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
					?>
					<table>
					  <tr>
						<td class="tituloTblDireita">Data do início:</td>
						<td><?PHP echo formatarDataExtenso($registro['dataInicio']); ?></td>
					  </tr>
					  <tr>
						<td class="tituloTblDireita">Status:</td>
						<td><?PHP echo ucwords($registro['status']); ?></td>
					  </tr>
                      <tr>
						<td class="tituloTblDireita">Pagamento:</td>
						<td><?PHP
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
							?>Cartão (<?PHP echo ucwords($registro['cartaoTipo']); ?>) - <?PHP echo $registro['cartaoParcelas'] ; ?> x R$: <?PHP echo number_format($valorTotal/$registro['cartaoParcelas'], 2, ',', ''); ?><?PHP
						}else if($registro['formaPgm'] == "dinheiro"){
							?>Dinheiro<?PHP
						}else{
							?>Não foi efetuado um pagamento<?PHP
						}
						?></td>
					  </tr>
					</table>
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
		}
		?>
        <?PHP
		if($statusPedido == "comprando"){
			?><p><strong><a href="javascript:void(0);" onclick="window.location='carrinho.php?idCarrinho=<?PHP echo $idPedido; ?>'">Continuar comprando com este pedido</a></strong></p><?PHP
		}else if($statusPedido == "pagamento"){
			?>
            <style>
			#pagamentoDinheiro{
				display:none;
			}
			#pagamentoCartao{
				display:none;
			}
			#txtCartaoTipoVisa{
				margin-left:20px;
				margin-right:40px;
			}
			</style>
            <script>
			$(document).ready(function(){
				$("#txtCartaoVenc").mask("99/99");
			});
			function mostraFormaPgm(tipo){
				document.getElementById('txtFormaPgm').value = tipo;
				if(tipo == "dinheiro"){
					document.getElementById('pagamentoDinheiro').style.display = 'block';
					document.getElementById('pagamentoCartao').style.display = 'none';
				}else if(tipo == "cartao"){
					document.getElementById('pagamentoCartao').style.display = 'block';
					document.getElementById('pagamentoDinheiro').style.display = 'none';
				}
			}
			function validaSubmitPagamento(){
				var formaPgm = document.getElementById('txtFormaPgm');
				if(formaPgm.value == "cartao"){
					campoForm = new Array();
					campoForm[0] = "CartaoNum";
					campoForm[1] = "CartaoVenc";
					campoForm[2] = "CartaoNome";
					campoForm[3] = "CartaoCodS";
					
					
					campoVazio = 0;
					validaCampoVazio();
					validaCheckboxs('CartaoTipo');
					validaCheckboxs('CartaoParcelas');
					
					if(campoVazio == 0){
						return true;
					}else{
						return false;
					}
				}
			}
			function validaCheckboxs(campo){
				var txtCampo = document.getElementsByName('txt' + campo);
				var lblErro = document.getElementById('lblErro' + campo);
				var checado = 0;
				var i
				for (i=0;i<txtCampo.length;i++){
				   if(txtCampo[i].checked){
					  checado++;
				   }
				}
				
				if(checado == 0){
					lblErro.style.display = 'block';
					campoVazio++;
				}else{
					lblErro.style.display = 'none';
				}
			}
			</script>
            <form action="pagamento.php?idPedido=<?PHP echo $idPedido; ?>" method="post" name="frmPagamento" id="frmPagamento" onSubmit="return validaSubmitPagamento()">
            <input type="hidden" name="txtFormaPgm" id="txtFormaPgm" />
            <input type="hidden" name="txtValorTotal" id="txtValorTotal" value="<?PHP echo number_format($total, 2, ',', ''); ?>" />
            <p>Selecione a forma de pagamento: <strong><label><input type="radio" name="formaPgm" value="dinheiro" onclick="mostraFormaPgm('dinheiro');" /> dinheiro</label> | <label><input type="radio" name="formaPgm" value="cartao" onclick="mostraFormaPgm('cartao');" /> cartão</label></strong></p>
            <div id="pagamentoDinheiro">
            	<p>O pagamento em dinheiro deve ser feito diretamente na secretaria.</p>
                <input type="submit" name="btnSubmit" value="Finalizar pagamento" />
            </div>
            <div id="pagamentoCartao">
            	<table>
                	<tr>
                    	<td class="tituloTblDireita">Cartão de crédito:</td>
                    	<td valign="top">
                            <label for="txtCartaoTipoVisa"><img src="_img/visa.jpg" /></label>
                            <label for="txtCartaoTipoMastercard"><img src="_img/mastercard.jpg" /></label>
                            <br />
                            <input type="radio" name="txtCartaoTipo" id="txtCartaoTipoVisa" value="Visa" />
                            <input type="radio" name="txtCartaoTipo" id="txtCartaoTipoMastercard" value="Mastercard" />
                            <div id="lblErroCartaoTipo" class="msgErro">o campo tipo do cartão não está selecionado</div>
                        </td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Número do cartão:</td>
                    	<td>
                        	<input type="text" name="txtCartaoNum" id="txtCartaoNum" maxlength="16" onKeyPress="return SomenteNumero(event)" />
                            <div id="lblErroCartaoNum" class="msgErro">o campo número do cartão está em branco</div>
                        </td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Vencimento:</td>
                    	<td>
                        	<input type="text" name="txtCartaoVenc" id="txtCartaoVenc" size="5" maxlength="5" /> (mm/aa)
                            <div id="lblErroCartaoVenc" class="msgErro">o campo vencimento do cartão está em branco</div>
                        </td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Nome:</td>
                    	<td>
                        	<input type="text" name="txtCartaoNome" id="txtCartaoNome" />
                            <div id="lblErroCartaoNome" class="msgErro">o campo nome está em branco</div>
                        </td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Código de Segurança (verso):</td>
                    	<td>
                        	<input type="text" name="txtCartaoCodS" id="txtCartaoCodS" size="3" maxlength="3" onKeyPress="return SomenteNumero(event)" />
                            <div id="lblErroCartaoCodS" class="msgErro">o campo código de segurança está em branco</div>
                        </td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">Parcelas:</td>
                    	<td>
                        	<?PHP
							$qtdParcelas = 5; #define a quantidade de parcelas disponíveis para pagamento.
							for ($i=1; $i<=$qtdParcelas; $i++) {
								?><label><input type="radio" name="txtCartaoParcelas" value="<?PHP echo $i; ?>" /><?PHP echo $i; ?> x R$: <?PHP echo number_format($total/$i, 2, ',', ''); ?></label><br />
								<?PHP
							}
							?>
                            <div id="lblErroCartaoParcelas" class="msgErro">escolha um número de parcelas</div>
                        </td>
                    </tr>
                    <tr>
                    	<td class="tituloTblDireita">&nbsp;</td>
                    	<td><input type="submit" name="btnSubmit" value="Finalizar pagamento" /></td>
                    </tr>
                </table>
            </div>
            </form>
			<?PHP
		}else if($statusPedido == "retirada"){
			?><p><strong><a href="javascript:void(0);" onclick="imprimirPedido('<?PHP echo $idPedido; ?>');">Imprimir pedido</a></strong></p><?PHP
		}else{
			?><p></p><?PHP
		}
		?>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>Legenda (Status)</strong></td>
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
        </table>
        <?PHP
	}
?>
<?PHP
	Require('footer.php');
?>