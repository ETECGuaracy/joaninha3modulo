<?PHP
	Require('verificaLogin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
<script>
$(document).ready(function(){
	$("#txtDataNascimento").mask("99/99/9999");
	$("#txtCPF").mask("999.999.999-99");
	$("#txtTelefone").mask("(99) 9999-9999");
	$("#txtCelular").mask("(99) 9999-9999");
	$("#txtCEP").mask("99999-999");
});
function validaSubmitAlterarDados(){
	campoForm = new Array();
	campoForm[0] = "Nome";
	campoForm[1] = "Email";
	campoForm[2] = "DataNascimento";
	campoForm[3] = "CPF";
	campoForm[4] = "Telefone";
	campoForm[5] = "Celular";
	campoForm[6] = "Endereco";
	campoForm[7] = "EnderecoNumero";
	campoForm[8] = "CEP";
	campoForm[9] = "Cidade";
	campoForm[10] = "UF";
	
	
	campoVazio = 0;
	validaCampoVazio();
	validaEmail();
	
	if(campoVazio == 0){
		jQuery.ajax({
		type: 'POST',
		url: 'alterarDadosConfirma.php',
		data: jQuery('form').serialize(),
		success: function(msg){
			document.getElementById('caixaMsgConteudo').innerHTML = msg;
			acaoDepoisMsgFechar = "nao";
			abrirMsg();
			if(msg == "Dados alterados com sucesso!"){
				acaoDepoisMsgFechar = "sim";
			}
		}
		});
	}
	return false;
}
function acaoDepoisMsg(){
	window.location = 'meusDados.php';
}
</script>
<p class="titulo">Alterar dados</p>
<form action="alterarDadosConfirma.php" method="post" name="frmAlterarDados" onSubmit="return validaSubmitAlterarDados()">
<?PHP
	$idFuncionario = $_SESSION['idFuncionario'];
	$sql = "SELECT * FROM funcionario, tipofuncionario WHERE funcionario.idTipo = tipofuncionario.idTipo AND idFuncionario = $idFuncionario";
	$selecao = mysql_query($sql);
	$registro = mysql_fetch_assoc($selecao);
?>
<table id="tblAlterarDados">
  <tr>
    <td class="tituloTblDireita">Nome:</td>
    <td>
        <input type="text" name="txtNome" id="txtNome" size="30" maxlength="100" value="<?PHP echo $registro['nome']; ?>" />
        <div id="lblErroNome" class="msgErro">o campo nome está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Sexo:</td>
    <td>
        <?PHP
			if($registro['sexo'] == "m"){
				$checkSexoM = " checked='checked'";
				$checkSexoF = "";
			}else if($registro['sexo'] == "f"){
				$checkSexoM = "";
				$checkSexoF = " checked='checked'";
			}
		?>
        <label><input type="radio" id="txtSexo" name="txtSexo" value="m"<?PHP echo $checkSexoM; ?> />Masculino</label>
        <label><input type="radio" id="txtSexo" name="txtSexo" value="f"<?PHP echo $checkSexoF; ?> />Feminino</label>
        <div id="lblErroSexo" class="msgErro">o campo sexo não está selecionado</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">E-mail:</td>
    <td>
        <input type="text" name="txtEmail" id="txtEmail" size="30" maxlength="100" value="<?PHP echo $registro['email']; ?>" />
        <div id="lblErroEmail" class="msgErro">o campo email está em branco</div>
        <div id="lblErroEmailInvalido" class="msgErro">preencha um e-mail válido</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Data de Nascimento:</td>
    <td>
        <input type="text" name="txtDataNascimento" id="txtDataNascimento" size="10" maxlength="10" value="<?PHP echo $registro['dataNasc']; ?>" />
        <div id="lblErroDataNascimento" class="msgErro">o campo data de nascimento está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">CPF:</td>
    <td>
        <input type="text" name="txtCPF" id="txtCPF" size="14" maxlength="14" value="<?PHP echo $registro['CPF']; ?>" />
        <div id="lblErroCPF" class="msgErro">o campo CPF está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Telefone:</td>
    <td>
        <input type="text" name="txtTelefone" id="txtTelefone" size="13" maxlength="14" value="<?PHP echo $registro['telefone']; ?>" />
        <div id="lblErroTelefone" class="msgErro">o campo telefone está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Celular:</td>
    <td>
        <input type="text" name="txtCelular" id="txtCelular" size="13" maxlength="14" value="<?PHP echo $registro['celular']; ?>"  />
        <div id="lblErroCelular" class="msgErro">o campo celular está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Endereço:</td>
    <td>
        <input type="text" name="txtEndereco" id="txtEndereco" size="30" maxlength="100" value="<?PHP echo $registro['endereco']; ?>" />
        <div id="lblErroEndereco" class="msgErro">o campo endereço está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Número:</td>
    <td>
        <input type="text" name="txtEnderecoNumero" id="txtEnderecoNumero" size="5" maxlength="10" onKeyPress="return SomenteNumero(event)" value="<?PHP echo $registro['numero']; ?>" />
        <div id="lblErroEnderecoNumero" class="msgErro">o campo número do endereço está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Complemento:</td>
    <td>
        <input type="text" name="txtEnderecoComplemento" id="txtEnderecoComplemento" size="20" maxlength="20" value="<?PHP echo $registro['complemento']; ?>" />
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">CEP:</td>
    <td>
        <input type="text" name="txtCEP" id="txtCEP" size="9" maxlength="9" value="<?PHP echo $registro['CEP']; ?>" />
        <div id="lblErroCEP" class="msgErro">o campo CEP está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Cidade:</td>
    <td>
        <input type="text" name="txtCidade" id="txtCidade" size="30" maxlength="30" value="<?PHP echo $registro['cidade']; ?>" />
        <div id="lblErroCidade" class="msgErro">o campo cidade está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">UF (Estado):</td>
    <td>
        <select name="txtUF" id="txtUF">
        	<?PHP
			$sql2 = "SELECT * FROM uf";
			$selecao2 = mysql_query($sql2);
			
			?><option value="">UF</option>
			<?PHP
                while($registro2 = mysql_fetch_assoc($selecao2)){
					if($registro['UF'] == $registro2['uf']){
						$selecionadoUF = " selected='selected'";
					}else{
						$selecionadoUF = "";
					}
                    ?>
                    <option value="<?PHP echo $registro2['uf']; ?>"<?PHP echo $selecionadoUF; ?>><?PHP echo $registro2['uf']; ?> - <?PHP echo $registro2['nome']; ?></option>
                    <?PHP
                }
            ?>
		</select>
        <div id="lblErroUF" class="msgErro">o campo UF está em branco</div>
    </td>
  </tr>
  <tr>
    <td class="tituloTblDireita">&nbsp;</td>
    <td><input type="submit" name="btnSubmit" value="Alterar" /></td>
  </tr>
</table>
</form>
<?PHP
	Require('footer.php');
?>