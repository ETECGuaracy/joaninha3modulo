<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$idProduto = $_GET['idProduto'];
		$acao = $_GET['acao'];
		
		if($idProduto == ""){
			echo "Não foi possível localizar o produto.";
		}else{
			if($acao == ""){
				echo "Não foi possível realizar esta tarefa.";
			}else if($acao == "editar"){
				$sql = "SELECT * FROM lojaproduto WHERE idProduto = $idProduto";
				if (!mysql_query($sql)){
					$mensagem = "Produto não localizado.";
				}else{
					$selecao = mysql_query($sql);
					$registro = mysql_fetch_assoc($selecao);
					?>
					<style>
					#txtNomeProduto{
						width:240px;
					}
					#txtDescricao{
						height:100px;
						width:240px;
					}
					#txtValor{
						width:100px;
					}
					#frmLojaEditar{
						text-align:left;
						color:#000;
					}
					</style>
					<form action="editarLojaConfirma.php" method="post" name="frmLojaEditar" id="frmLojaEditar" onSubmit="return validaSubmitEditarLoja()">
						<table>
							<tr>
								<td class="tituloTblDireita">Nome do produto:</td>
								<td>
									<input type="text" name="txtNomeProduto" id="txtNomeProduto" maxlength="50" value="<?PHP echo $registro['nome']; ?>" />
									<div id="lblErroNomeProduto" class="msgErro">o campo nome do produto está em branco</div>
								</td>
							</tr>
							<tr>
								<td class="tituloTblDireita">Descrição:</td>
								<td>
									<textarea name="txtDescricao" id="txtDescricao"><?PHP echo $registro['descricao']; ?></textarea>
									<div id="lblErroDescricao" class="msgErro">o campo descrição está em branco</div>
								</td>
							</tr>
							<tr>
								<td class="tituloTblDireita">Valor / Preço:</td>
								<td>
									<input type="text" name="txtValor" id="txtValor" maxlength="10" value="<?PHP echo $registro['valor']; ?>" />
									<div id="lblErroValor" class="msgErro">o campo valor / preço está em branco</div>
								</td>
							</tr>
							<tr>
								<td class="tituloTblDireita">&nbsp;</td>
								<td><input type="submit" name="btnSubmit" value="Editar" /></td>
							</tr>
                            <tr>
                            	<td colspan="2">Para alterar a imagem, <a href="javascript:void(0);" onclick="alterarImagem('<?PHP echo $idProduto; ?>');">clique aqui</a>.</td>
                            </tr>
						</table>
                        <input type="hidden" name="idProduto" id="idProduto" value="<?PHP echo $idProduto; ?>" />
					</form>
                    <div id="divMsgErroLoja"></div>
					<?PHP
				}
			}else if($acao == "alterarImagem"){
				?>
                <style>
				#txtImg{
					width:310px;
				}
				#frmLojaImagem{
					text-align:left;
					color:#000;
				}
				</style>
                <form action="editarLojaConfirma.php?acao=enviarImagem" method="post" enctype="multipart/form-data" name="frmLojaImagem" id="frmLojaImagem">
                    <table>
                        <tr>
                            <td class="tituloTblDireita">Imagem:</td>
                            <td>
                                <label for="txtImg"></label>
                                <input type="file" name="txtImg" id="txtImg" />
                            </td>
                        </tr>
                        <tr>
                            <td class="tituloTblDireita">&nbsp;</td>
                            <td><input type="submit" name="btnSubmit" value="Enviar" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="idProduto" id="idProduto" value="<?PHP echo $idProduto; ?>" />
                </form>
				<?PHP
			}else if($acao == "ocultar"){
				$sql = "UPDATE lojaproduto SET ocultar = 'sim' WHERE idProduto = $idProduto";
				if (!mysql_query($sql)){
					echo "Houve um erro!<br />Tente novamente mais tarde.";
				}else{
					echo "O produto foi ocultado com sucesso !";
				}
			}else if($acao == "exibir"){
				$sql = "UPDATE lojaproduto SET ocultar = 'nao' WHERE idProduto = $idProduto";
				if (!mysql_query($sql)){
					echo "Houve um erro!<br />Tente novamente mais tarde.";
				}else{
					echo "O produto foi exibido com sucesso !";
				}
			}
		}
	}
?>