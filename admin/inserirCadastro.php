<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginSecretaria.php');
	
	Require('header.php');
	
	Require('conecta.php');
?>
<script>
$(document).ready(function(){
	$("#txtDataNascimento").mask("99/99/9999");
	$("#txtTelefone").mask("(99) 9999-9999");
	$("#txtCelular").mask("(99) 9999-9999");
	$("#txtCEP").mask("99999-999");
	$("#txtCPF").mask("999.999.999-99");
});
var erro = 0;
function validaSubmitCadastro(){
	erro = 0;
	
	txtTipoCadastro = document.getElementById('txtTipoCadastro');
	if(txtTipoCadastro.value == "aluno"){
		validaCampoVazio3('Responsavel');
		validaCampoVazio('NomePai');
		validaCampoVazio('NomeMae');
		validaCampoVazio('UF');
		validaCampoVazio('Cidade');
		validaCampoVazio2('CEP');
		validaCampoVazio('EnderecoNumero');
		validaCampoVazio('Endereco');
		validaCampoVazio2('Telefone');
		validaCampoVazio2('DataNascimento');
		validaEmail();
		validaCampoVazio2('CPF');
		validaCampoVazio3('Sexo');
		validaCampoVazio('Nome');
		validaCampoVazio('Turma');
		validaSenha();
		validaCampoVazio('SenhaConfirmaCadastro');
		validaCampoVazio('SenhaCadastro');
		validaCampoVazio('NomeUsuario');
	}else if(txtTipoCadastro.value == "funcionario"){
		validaCampoVazio('UF');
		validaCampoVazio('Cidade');
		validaCampoVazio2('CEP');
		validaCampoVazio('EnderecoNumero');
		validaCampoVazio('Endereco');
		validaCampoVazio2('Telefone');
		validaCampoVazio2('DataNascimento');
		validaEmail();
		validaCampoVazio2('CPF');
		validaCampoVazio3('Sexo');
		validaCampoVazio('Nome');
		validaCampoVazio('TipoFuncionario');
		validaSenha();
		validaCampoVazio('SenhaConfirmaCadastro');
		validaCampoVazio('SenhaCadastro');
		validaCampoVazio('NomeUsuario');
	}else{
		alert('Escolha um tipo de cadastro');
		erro++;
	}
	
	if(erro == 0){
		var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
		
		jQuery.ajax({
		type: 'POST',
		url: 'inserirCadastroConfirma.php',
		data: jQuery('form').serialize(),
		success: function(msg){
			if(msg == "Cadastro adicionado com sucesso!"){
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
	window.location = 'cadastro.php';
}
function validaCampoVazio(campo){
	var txtCampo = document.getElementById('txt' + campo);
	var erroCampo = document.getElementById('erroCadastro' + campo);
	if(txtCampo.value == ""){
		erroCampo.style.display = 'block';
		txtCampo.focus();
		erro++;
	}else{
		erroCampo.style.display = 'none';
	}
}
function validaCampoVazio2(campo){
	var txtCampo = document.getElementById('txt' + campo);
	var erroCampo = document.getElementById('erroCadastro' + campo);
	if(txtCampo.value == ""){
		erroCampo.style.display = 'block';
		//txtCampo.focus();
		erro++;
	}else{
		erroCampo.style.display = 'none';
	}
}
function validaCampoVazio3(campo){
	var txtCampo = document.getElementsByName('txt' + campo);
	var erroCampo = document.getElementById('erroCadastro' + campo);
	var checado = 0;
	var i
	for (i=0;i<txtCampo.length;i++){
	   if(txtCampo[i].checked){
		  checado++;
	   }
	}
	
	if(checado == 0){
		erroCampo.style.display = 'block';
		//txtCampo.focus();
		erro++;
	}else{
		erroCampo.style.display = 'none';
	}
}
function validaEmail(){
	var txtEmail = document.getElementById('txtEmail');
	var erroCadastroEmail = document.getElementById('erroCadastroEmail');
	var erroCadastroEmailIncorreto = document.getElementById('erroCadastroEmailIncorreto');
	if(txtEmail.value == ""){
		erroCadastroEmail.style.display = 'block';
		erroCadastroEmailIncorreto.style.display = 'none';
		txtEmail.focus();
		erro++;
	}else{
		erroCadastroEmail.style.display = 'none';
		if(txtEmail.value.length < 7 || txtEmail.value.indexOf("@") < 1 || txtEmail.value.indexOf(".",txtEmail.value.indexOf("@") + 2) == -1){
			erroCadastroEmailIncorreto.style.display = 'block';
			txtEmail.focus();
			erro++;
		}else{
			erroCadastroEmailIncorreto.style.display = 'none';
		}
	}
}
function validaSenha(){
	var txtSenhaCadastro = document.getElementById('txtSenhaCadastro');
	var txtSenhaConfirmaCadastro = document.getElementById('txtSenhaConfirmaCadastro');
	var erroCadastroSenhaIncorreta = document.getElementById('erroCadastroSenhaIncorreta');
	if(txtSenhaCadastro.value != txtSenhaConfirmaCadastro.value){
		erroCadastroSenhaIncorreta.style.display = 'block';
		erro++;
	}else{
		erroCadastroSenhaIncorreta.style.display = 'none';
		
	}
}
function tipoCadastroMostra(tipo){
	document.getElementById('tblInserirCadastro').style.display = 'block';
	document.getElementById('txtTipoCadastro').value = tipo;
	document.getElementById('txtNomeUsuario').focus();
	
	if(tipo == "aluno"){
		document.getElementById('tipoCadastroAluno').style.fontWeight = 'bold';
		document.getElementById('tipoCadastroFuncionario').style.fontWeight = 'normal';
		document.getElementById('campoTipoFuncionario').style.display = 'none';
		document.getElementById('campoTipoFuncionarioConteudo').style.display = 'none';
		document.getElementById('campoTurma').style.display = 'block';
		document.getElementById('campoTurmaConteudo').style.display = 'block';
		document.getElementById('alunoCPFResponsavel').style.display = 'block';
		document.getElementById('campoNomePai').style.display = 'block';
		document.getElementById('campoNomePaiConteudo').style.display = 'block';
		document.getElementById('campoNomeMae').style.display = 'block';
		document.getElementById('campoNomeMaeConteudo').style.display = 'block';
		document.getElementById('campoResponsavel').style.display = 'block';
		document.getElementById('campoResponsavelConteudo').style.display = 'block';
	}else if(tipo == "funcionario"){
		document.getElementById('tipoCadastroAluno').style.fontWeight = 'normal';
		document.getElementById('tipoCadastroFuncionario').style.fontWeight = 'bold';
		document.getElementById('campoTipoFuncionario').style.display = 'block';
		document.getElementById('campoTipoFuncionarioConteudo').style.display = 'block';
		document.getElementById('campoTurma').style.display = 'none';
		document.getElementById('campoTurmaConteudo').style.display = 'none';
		document.getElementById('alunoCPFResponsavel').style.display = 'none';
		document.getElementById('campoNomePai').style.display = 'none';
		document.getElementById('campoNomePaiConteudo').style.display = 'none';
		document.getElementById('campoNomeMae').style.display = 'none';
		document.getElementById('campoNomeMaeConteudo').style.display = 'none';
		document.getElementById('campoResponsavel').style.display = 'none';
		document.getElementById('campoResponsavelConteudo').style.display = 'none';
	}
}
</script>
<script>
$(document).ready(function(){
	jQuery('#btnVerificaUsuario').click(function() {
		jQuery.ajax({
		type: 'POST',
		url: 'verificaExisteUsuario.php',
		data: jQuery('form').serialize(),
		success: function(msg){
			document.getElementById('erroCadastroNomeUsuario').style.display = 'none';
			document.getElementById('msgVerificaExisteUsuario').style.display = 'block';
			document.getElementById('msgVerificaExisteUsuario').innerHTML = msg;
			document.getElementById('txtNomeUsuario').focus();
		}
		});
	});
});
</script>
<p class="titulo">Inserir novo cadastro</p>
<p>Preencha este formulário para adicionar um novo cadastro no site</p>
<form action="inserirCadastroConfirma.php" method="post" name="frmCadastro" id="frmCadastro" onSubmit="return validaSubmitCadastro()">
	<table>
        <tr>
            <td class="tituloTblDireita" width="150">Tipo de Cadastro:</td>
            <td>
                <label id="tipoCadastroAluno"><input type="radio" id="tipoCadastroClick" name="tipoCadastroClick" value="aluno" onclick="tipoCadastroMostra('aluno');" />Aluno</label>
                <label id="tipoCadastroFuncionario"><input type="radio" id="tipoCadastroClick" name="tipoCadastroClick" value="funcionario" onclick="tipoCadastroMostra('funcionario');" />Funcionário</label>
            </td>
        </tr>
    </table>
    <table id="tblInserirCadastro">
      <tr>
		<td class="tituloTblDireita" width="150">Nome de Usuário:</td>
		<td>
			<input type="text" name="txtNomeUsuario" id="txtNomeUsuario" size="20" maxlength="20" />
            <input type="button" name="btnVerificaUsuario" id="btnVerificaUsuario" value="Verificar" />
			<div id="erroCadastroNomeUsuario" class="msgErro">o campo nome de usuário está em branco</div>
            <div id="msgVerificaExisteUsuario" class="msgErro"></div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Senha:</td>
		<td>
			<input type="password" name="txtSenhaCadastro" id="txtSenhaCadastro" size="20" maxlength="20" />
			<div id="erroCadastroSenhaCadastro" class="msgErro">o campo senha está em branco</div>
            <div id="erroCadastroSenhaIncorreta" class="msgErro">o campo senha e confirma senha estão diferentes</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Confirma Senha:</td>
		<td>
			<input type="password" name="txtSenhaConfirmaCadastro" id="txtSenhaConfirmaCadastro" size="20" maxlength="20" />
			<div id="erroCadastroSenhaConfirmaCadastro" class="msgErro">o campo confirma senha está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">
        	<div id="campoTipoFuncionario">Tipo de Funcionário:</div>
            <div id="campoTurma">Turma:</div>
        </td>
		<td>
			<div id="campoTipoFuncionarioConteudo">
                <select name="txtTipoFuncionario" id="txtTipoFuncionario">
                <option value="" selected="selected">Tipo de Funcionário</option>
                <?PHP
                    if($_SESSION['tipoFuncionario'] == "admin"){
                        $sql = "SELECT * FROM tipofuncionario WHERE ocultar = 'nao' ORDER BY tipo";
                    }else{
                        $sql = "SELECT * FROM tipofuncionario WHERE ocultar = 'nao' AND tipo <> 'administrador' ORDER BY tipo";
                    }
                    $selecao = mysql_query($sql);
                    
                    while($registro = mysql_fetch_assoc($selecao)){
                        ?>
                        <option value="<?PHP echo $registro['idTipo']; ?>"><?PHP echo $registro['tipo']; ?></option>
                        <?PHP
                    }
                ?>
                </select>
                <div id="erroCadastroTipoFuncionario" class="msgErro">o campo tipo de funcionário não está selecionado</div>
            </div>
            <div id="campoTurmaConteudo">
                <select name="txtTurma" id="txtTurma">
                <option value="" selected="selected">Turma</option>
                <?PHP
                    $sql = "SELECT * FROM turma WHERE ocultar = 'nao' ORDER BY turma";
                    $selecao = mysql_query($sql);
                    
                    while($registro = mysql_fetch_assoc($selecao)){
                        ?>
                        <option value="<?PHP echo $registro['idTurma']; ?>"><?PHP echo $registro['turma']; ?></option>
                        <?PHP
                    }
                ?>
                </select>
                <div id="erroCadastroTurma" class="msgErro">o campo turma não está selecionado</div>
            </div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Nome:</td>
		<td>
			<input type="text" name="txtNome" id="txtNome" size="30" maxlength="100" />
			<div id="erroCadastroNome" class="msgErro">o campo nome está em branco</div>
		</td>
	  </tr>
      <tr>
        <td class="tituloTblDireita">Sexo:</td>
        <td>
            <label><input type="radio" id="txtSexo" name="txtSexo" value="m" />Masculino</label>
            <label><input type="radio" id="txtSexo" name="txtSexo" value="f" />Feminino</label>
            <div id="erroCadastroSexo" class="msgErro">o campo sexo não está selecionado</div>
        </td>
      </tr>
      <tr>
		<td class="tituloTblDireita">CPF:</td>
		<td>
			<input type="text" name="txtCPF" id="txtCPF" size="14" maxlength="14" />
			<div id="erroCadastroCPF" class="msgErro">o campo CPF está em branco</div>
            <div id="alunoCPFResponsavel" class="msgErro">preencha o CPF do responsável</div>
		</td>
	  </tr>
	  <tr>
		<td class="tituloTblDireita">E-mail:</td>
		<td>
			<input type="text" name="txtEmail" id="txtEmail" size="30" maxlength="100" />
			<div id="erroCadastroEmail" class="msgErro">o campo email está em branco</div>
			<div id="erroCadastroEmailIncorreto" class="msgErro">preencha um e-mail válido</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Data de Nascimento:</td>
		<td>
			<input type="text" name="txtDataNascimento" id="txtDataNascimento" size="10" maxlength="10" />
			<div id="erroCadastroDataNascimento" class="msgErro">o campo data de nascimento está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Telefone:</td>
		<td>
			<input type="text" name="txtTelefone" id="txtTelefone" size="13" maxlength="14" />
			<div id="erroCadastroTelefone" class="msgErro">o campo telefone está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Celular:</td>
		<td>
			<input type="text" name="txtCelular" id="txtCelular" size="13" maxlength="14"  />
			<div id="erroCadastroCelular" class="msgErro">o campo celular está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Endereço:</td>
		<td>
			<input type="text" name="txtEndereco" id="txtEndereco" size="30" maxlength="100" />
			<div id="erroCadastroEndereco" class="msgErro">o campo endereço está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Número:</td>
		<td>
			<input type="text" name="txtEnderecoNumero" id="txtEnderecoNumero" size="5" maxlength="10" onKeyPress="return SomenteNumero(event)" />
			<div id="erroCadastroEnderecoNumero" class="msgErro">o campo número do endereço está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Complemento:</td>
		<td>
			<input type="text" name="txtEnderecoComplemento" id="txtEnderecoComplemento" size="20" maxlength="20" />
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">CEP:</td>
		<td>
			<input type="text" name="txtCEP" id="txtCEP" size="9" maxlength="9" />
			<div id="erroCadastroCEP" class="msgErro">o campo CEP está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita">Cidade:</td>
		<td>
			<input type="text" name="txtCidade" id="txtCidade" size="30" maxlength="30" />
			<div id="erroCadastroCidade" class="msgErro">o campo cidade está em branco</div>
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
			<div id="erroCadastroUF" class="msgErro">o campo UF está em branco</div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita"><div id="campoNomeMae">Nome da Mãe:</div></td>
		<td>
			<div id="campoNomeMaeConteudo">
                <input type="text" name="txtNomeMae" id="txtNomeMae" size="30" maxlength="100" />
                <div id="erroCadastroNomeMae" class="msgErro">o campo nome da mãe está em branco</div>
            </div>
		</td>
	  </tr>
      <tr>
		<td class="tituloTblDireita"><div id="campoNomePai">Nome do Pai:</div></td>
		<td>
			<div id="campoNomePaiConteudo">
                <input type="text" name="txtNomePai" id="txtNomePai" size="30" maxlength="100" />
                <div id="erroCadastroNomePai" class="msgErro">o campo nome do pai está em branco</div>
            </div>
		</td>
	  </tr>
      <tr>
        <td class="tituloTblDireita"><div id="campoResponsavel">Responsável:</div></td>
        <td>
            <div id="campoResponsavelConteudo">
                <label><input type="radio" id="txtResponsavel" name="txtResponsavel" value="mae" />Mãe</label>
                <label><input type="radio" id="txtResponsavel" name="txtResponsavel" value="pai" />Pai</label>
                <div id="erroCadastroResponsavel" class="msgErro">o campo responsável não está selecionado</div>
            </div>
        </td>
      </tr>
	  <tr>
		<td class="tituloTblDireita">&nbsp;</td>
		<td><input type="submit" name="btnSubmit" value="Cadastrar" /></td>
	  </tr>
	</table>
    <input type="hidden" id="txtTipoCadastro" name="txtTipoCadastro" />
</form>
<?PHP
	Require('footer.php');
?>