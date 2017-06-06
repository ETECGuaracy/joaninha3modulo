<?PHP
	Require('verificaLogin.php');
	
	Require('header.php');
?>
<script language="javascript">
function validaSubmitAlterarSenha(){
	erro = 0;
	
	var txtSenhaAtual = document.getElementById('txtSenhaAtual');
	var txtSenhaNova = document.getElementById('txtSenhaNova');
	var txtSenhaNovaConfirma = document.getElementById('txtSenhaNovaConfirma');
	var lblErroSenhaNaoConfere = document.getElementById('lblErroSenhaNaoConfere');
	
	if(txtSenhaNova.value != "" && txtSenhaNovaConfirma.value != ""){
		if(txtSenhaNova.value != txtSenhaNovaConfirma.value){
			lblErroSenhaNaoConfere.style.display = 'block';
			txtSenhaNova.focus();
			erro++;
		}else{
			lblErroSenhaNaoConfere.style.display = 'none';
		}	
	}else{
		lblErroSenhaNaoConfere.style.display = 'none';
	}
	
	validaCampoVazio('SenhaNovaConfirma');
	validaCampoVazio('SenhaNova');
	validaCampoVazio('SenhaAtual');
	
	if(erro == 0){
		var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
		
		jQuery.ajax({
		type: 'POST',
		url: 'alterarSenhaConfirma.php',
		data: jQuery('form').serialize(),
		success: function(msg){
			if(msg == "Senha alterada com sucesso!"){
				acaoDepoisMsgFechar = "sim";
			}
			caixaMsgConteudo.innerHTML = msg;
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
function validaCampoVazio(campo){
	var txtCampo = document.getElementById('txt' + campo);
	var erroCampo = document.getElementById('lblErro' + campo);
	if(txtCampo.value == ""){
		erroCampo.style.display = 'block';
		txtCampo.focus();
		erro++;
	}else{
		erroCampo.style.display = 'none';
	}
}
</script>
<p class="titulo">Alterar senha</p>
<form action="alterarSenhaConfirma.php" method="post" name="frmAlterarSenha" onsubmit="return validaSubmitAlterarSenha()">
<table width="600">
  <tr>
    <td class="tituloTblDireita" width="160">Senha atual</td>
    <td>
    	<input type="password" name="txtSenhaAtual" id="txtSenhaAtual" />
        <div id="lblErroSenhaAtual" class="msgErro">campo senha atual em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Nova senha</td>
    <td>
    	<input type="password" name="txtSenhaNova" id="txtSenhaNova" />
        <div id="lblErroSenhaNova" class="msgErro">campo nova senha em branco</div>
        <div id="lblErroSenhaNaoConfere" class="msgErro">campo nova senha e confirma nova senha estão diferentes</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Confirma nova senha</td>
    <td>
    	<input type="password" name="txtSenhaNovaConfirma" id="txtSenhaNovaConfirma" />
        <div id="lblErroSenhaNovaConfirma" class="msgErro">campo confirma nova senha em branco</div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="btnSubmit" value="Alterar" /></td>
  </tr>
</table>
</form>
<script>document.getElementById('txtSenhaAtual').focus();</script>
<?PHP
	Require('footer.php');
?>