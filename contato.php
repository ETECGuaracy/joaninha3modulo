<?PHP
	Require('header.php');
	
	Require('conecta.php');
?>
<script language="javascript">
$(document).ready(function(){
	$("#txtTelefone").mask("(99) 9999-9999");
});
function validaSubmitContato(){
	campoForm = new Array();
	campoForm[0] = "Nome";
	campoForm[1] = "Email";
	campoForm[2] = "Telefone";
	campoForm[3] = "Assunto";
	campoForm[4] = "Mensagem";
	
	
	campoVazio = 0;
	validaCampoVazio();
	validaEmail();
	
	if(campoVazio == 0){
		jQuery.ajax({
		type: 'POST',
		url: 'enviarContato.php',
		data: jQuery('form').serialize(),
		success: function(msg){
			if(msg == "Mensagem enviada com sucesso!<br />Aguarde uma resposta em seu e-mail."){
				document.getElementById('frmContato').reset();
			}
			document.getElementById('caixaMsgConteudo').innerHTML = msg;
			acaoDepoisMsgFechar = "nao";
			abrirMsg();
		}
		});
		return false;
	}else{
		return false;
	}
}
</script>
<style>
#txtMensagem{
	height:200px;
	width:400px;
}
.campoObrigatorio{
	color:#F00;
}
</style>
<p class="titulo">Contato</p>
<p class="campoObrigatorio">Os campos identificados com * são de preenchimento obrigatório.</p>
<form action="enviarContato.php" method="post" name="frmContato" id="frmContato" onSubmit="return validaSubmitContato()">
	<table>
	  <tr>
		<td class="tituloTblDireita" width="100">Nome<label class="campoObrigatorio">*</label>:</td>
		<td>
			<input type="text" name="txtNome" id="txtNome" size="30" maxlength="100" />
			<div id="lblErroNome" class="msgErro">o campo nome está em branco</div>
		</td>
	  </tr>
	  <tr>
		<td class="tituloTblDireita">E-mail<label class="campoObrigatorio">*</label>:</td>
		<td>
			<input type="text" name="txtEmail" id="txtEmail" size="30" maxlength="100" />
			<div id="lblErroEmail" class="msgErro">o campo email está em branco</div>
			<div id="lblErroEmailInvalido" class="msgErro">preencha um e-mail válido</div>
		</td>
	  </tr>
	  <tr>
		<td class="tituloTblDireita">Telefone<label class="campoObrigatorio">*</label>:</td>
		<td>
			<input type="text" name="txtTelefone" id="txtTelefone" size="13" />
			<div id="lblErroTelefone" class="msgErro">o campo telefone está em branco<br />preencha o telefone no formato: (11) 5555-5555</div>
		</td>
	  </tr>
	  <tr>
		<td class="tituloTblDireita">Assunto<label class="campoObrigatorio">*</label>:</td>
		<td>
		<select name="txtAssunto" id="txtAssunto">
        	<?PHP
			$assunto = $_GET['assunto'];
			
			$sql = "SELECT * FROM assunto WHERE ocultar = 'nao' ORDER BY assunto";
			$selecao = mysql_query($sql);
			
			if($assunto == "prematricula" || $assunto == "transporte"){
				?><option value="">Assunto</option>
				<?PHP
					while($registro = mysql_fetch_assoc($selecao)){
						if(($assunto == "prematricula" && $registro['assunto'] == "Pré-Matrícula") || ($assunto == "transporte" && $registro['assunto'] == "Transporte")){
							$selecionado = " selected='selected'";
						}else{
							$selecionado = "";
						}
						?>
						<option value="<?PHP echo $registro['idAssunto']; ?>"<?PHP echo $selecionado; ?>><?PHP echo $registro['assunto']; ?></option>
						<?PHP
					}
				?><?PHP
			}else if($assunto == ""){
				?><option value="" selected="selected">Assunto</option>
				<?PHP
					while($registro = mysql_fetch_assoc($selecao)){
						?>
						<option value="<?PHP echo $registro['idAssunto']; ?>"><?PHP echo $registro['assunto']; ?></option>
						<?PHP
					}
				?><?PHP
			}
            ?>
		</select>
		<div id="lblErroAssunto" class="msgErro">o campo assunto não está selecionado</div>
		</td>
	  </tr>
	  <tr>
		<td class="tituloTblDireita">Mensagem<label class="campoObrigatorio">*</label>:</td>
		<td>
			<textarea name="txtMensagem" id="txtMensagem"></textarea>
			<div id="lblErroMensagem" class="msgErro">o campo mensagem está em branco</div>
		</td>
	  </tr>
	  <tr>
		<td class="tituloTblDireita">&nbsp;</td>
		<td><input type="submit" name="btnSubmit" value="Enviar" /></td>
	  </tr>
	</table>
</form>
<?PHP
	Require('footer.php');
?>