<?PHP
	Require('header.php');
?>
<script>
$(document).ready(function(){
	$("#txtDataNascimento").mask("99/99/9999");
});
function validaSubmitEsqueceuSenha(){
	erro = 0;
	
	//a validação está ocorrendo ao contrário por causa do foco dos campos
	validaCampoVazio('DataNascimento','false');
	validaEmail();
	validaCampoVazio('NomeUsuario');
	
	if(erro == 0){
		jQuery.ajax({
		type: 'POST',
		url: 'esqueceuSenhaConfirma.php',
		data: jQuery('form').serialize(),
		success: function(msg){
			if(msg == "Um link foi enviado ao seu e-mail.<br />Acesse-o e crie uma nova senha."){
				acaoDepoisMsgFechar = "sim";
			}
			document.getElementById('caixaMsgConteudo').innerHTML = msg;
			abrirMsg();
		}
		});
		return false;
	}else{
		return false;
	}
}
function acaoDepoisMsg(){
	window.location = 'index.php';
}
function validaCampoVazio(campo,foco){
	var txtCampo = document.getElementById('txt' + campo);
	var lblErroCampo = document.getElementById('lblErro' + campo);
	if(txtCampo.value == ""){
		lblErroCampo.style.display = 'block';
		if(foco != "false"){
			txtCampo.focus();
		}
		erro++;
	}else{
		lblErroCampo.style.display = 'none';
	}
}
function validaEmail(){
	var txtEmail = document.getElementById('txtEmail');
	var lblErroEmail = document.getElementById('lblErroEmail');
	var lblErroEmailIncorreto = document.getElementById('lblErroEmailIncorreto');
	if(txtEmail.value == ""){
		lblErroEmail.style.display = 'block';
		lblErroEmailIncorreto.style.display = 'none';
		txtEmail.focus();
		erro++;
	}else{
		lblErroEmail.style.display = 'none';
		if(txtEmail.value.length < 7 || txtEmail.value.indexOf("@") < 1 || txtEmail.value.indexOf(".",txtEmail.value.indexOf("@") + 2) == -1){
			lblErroEmailIncorreto.style.display = 'block';
			txtEmail.focus();
			erro++;
		}else{
			lblErroEmailIncorreto.style.display = 'none';
		}
	}
}
</script>
<p class="titulo">Esqueceu sua senha</p>
<form action="esqueceuSenhaConfirma.php" method="post" name="frmEsqueceuSenha" id="frmEsqueceuSenha" onSubmit="return validaSubmitEsqueceuSenha()">
	<table>
	  <tr>
		<td class="tituloTblDireita" width="150">Nome de Usuário:</td>
		<td>
			<input type="text" name="txtNomeUsuario" id="txtNomeUsuario" size="30" />
			<div id="lblErroNomeUsuario" class="msgErro">o campo nome de usuário está em branco</div>
		</td>
	  </tr>
	  <tr>
		<td class="tituloTblDireita">E-mail:</td>
		<td>
			<input type="text" name="txtEmail" id="txtEmail" size="30" />
			<div id="lblErroEmail" class="msgErro">o campo email está em branco</div>
			<div id="lblErroEmailIncorreto" class="msgErro">preencha um e-mail válido</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Data de Nascimento:</td>
		<td>
			<input type="text" name="txtDataNascimento" id="txtDataNascimento" size="10" />
			<div id="lblErroDataNascimento" class="msgErro">o campo data de nascimento está em branco</div>
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