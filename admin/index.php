<?PHP
	Require('header.php');
	
	Require('conecta.php');
?>
<p class="titulo">Área Administrativa</p>
<?PHP
if($_SESSION['login'] == session_id() && $_SESSION['tipoUsuario'] == "funcionario"){
	if($_SESSION['tipoFuncionario'] == "admin" || $_SESSION['tipoFuncionario'] == "secretaria"){
		$sql = "SELECT * FROM contato WHERE dataLeitura = 0";
		$selecao = mysql_query($sql);
		$linhasLidos = mysql_num_rows($selecao);
		
		$sql = "SELECT * FROM contato WHERE resolvido = 'nao'";
		$selecao = mysql_query($sql);
		$linhasResolvido = mysql_num_rows($selecao);
		?><p><a href="contato.php">Existem <strong><?PHP echo $linhasLidos; ?></strong> contatos que não foram lidos e <strong><?PHP echo $linhasResolvido; ?></strong> que não foram resolvidos e/ou respondidos. Clique aqui para ver.</a></p><?PHP
		
		$sql = "SELECT * FROM lojapedido WHERE status = 'pagamento'";
		$selecao = mysql_query($sql);
		$linhasPagamento = mysql_num_rows($selecao);
		
		$sql = "SELECT * FROM lojapedido WHERE status = 'retirada'";
		$selecao = mysql_query($sql);
		$linhasRetirada = mysql_num_rows($selecao);
		?><p><a href="pedido.php">Existem <strong><?PHP echo $linhasPagamento + $linhasRetirada; ?></strong> pedidos pendentes (<strong><?PHP echo $linhasPagamento; ?></strong> pagamentos e <strong><?PHP echo $linhasRetirada; ?></strong> pedidos a serem retirados). Clique aqui para ver.</a></p><?PHP
	}
	?>
	<p>Você está logado !</p>
	<?PHP
}else{
	?>
	<script>
	var foco;
	function acaoDepoisMsg(){
		document.getElementById(foco).focus();
	}
	function validaSubmitLogin(){
		erro = 0;
		
		var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
		
		validaCampoVazio('Senha');
		validaCampoVazio('Usuario');
		
		if(erro == 0){
			jQuery.ajax({
			type: 'POST',
			url: 'login.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == 'Usuário e/ou Senha incorretos<br />Tente novamente'){
					caixaMsgConteudo.innerHTML = msg;
					abrirMsg();
					acaoDepoisMsgFechar = "sim";
					foco = "txtUsuario";
				}else{
					window.location = 'index.php';
				}
			}
			});
			return false;
		}else{
			return false;
		}
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
	<form action="login.php" method="post" name="frmLogin" onsubmit="return validaSubmitLogin()">
	<table width="300" border="0">
	  <tr>
		<td width="100" align="right" valign="top">Usuário</td>
		<td>
        	<input type="text" name="txtUsuario" id="txtUsuario" />
            <div id="lblErroUsuario" class="msgErro">campo usuário em branco</div>
        </td>
	  </tr>
	  <tr>
		<td align="right" valign="top">Senha</td>
		<td>
        	<input type="password" name="txtSenha" id="txtSenha" />
            <div id="lblErroSenha" class="msgErro">campo senha em branco</div>
        </td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSubmitLogin" id="btnSubmitLogin" value="Login" /></td>
	  </tr>
	</table>
	</form>
	<script>document.getElementById('txtUsuario').focus();</script>
	<?PHP
}
?>
<?PHP
	Require('footer.php');
?>