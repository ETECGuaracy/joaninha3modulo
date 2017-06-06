<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginSecretaria.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	function validaSubmitLista(){
		erro = 0;
		
		//a validação está ocorrendo ao contrário por causa do foco dos campos
		validaCampoVazio('Qtd');
		validaCampoVazio('Produto');
		validaCampoVazio('Turma');
		
		if(erro == 0){
			jQuery.ajax({
			type: 'POST',
			url: 'inserirListaConfirma.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Produto adicionado com sucesso!"){
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
		window.location = 'lista.php';
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
	function SomenteNumero(e){
		var tecla=(window.event)?event.keyCode:e.which;
		if((tecla > 47 && tecla < 58)) return true;
		else{
		if (tecla != 8 && tecla != 13 && tecla != 45) return false;
		else return true;
		}
	}
	</script>
    <p class="titulo">Inserir produto na Lista de Materiais</p>
    <p>Preencha este formulário para inserir um produto na Lista de Materiais</p>
    <form action="inserirListaConfirma.php" method="post" name="frmLista" id="frmLista" onSubmit="return validaSubmitLista()">
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
        <select name="txtProduto" id="txtProduto">
            <option value="" selected="selected">Produto</option>
            <?PHP
                $sql = "SELECT * FROM listaproduto WHERE ocultar = 'nao' ORDER BY produto";
                $selecao = mysql_query($sql);
                
                while($registro = mysql_fetch_assoc($selecao)){
                    ?>
                    <option value="<?PHP echo $registro['idProduto']; ?>"><?PHP echo $registro['produto']; ?></option>
                    <?PHP
                }
            ?>
        </select>
        <input type="text" name="txtQtd" id="txtQtd" size="3" maxlength="3" onkeypress="return SomenteNumero(event)" />
        <input type="submit" name="btnSubmit" value="Adicionar" />
        <div id="lblErroTurma" class="msgErro">o campo turma não está selecionado</div>
        <div id="lblErroProduto" class="msgErro">o campo produto não está selecionado</div>
        <div id="lblErroQtd" class="msgErro">o campo quantidade está em branco</div>
    </form>
<?PHP
	Require('footer.php');
?>