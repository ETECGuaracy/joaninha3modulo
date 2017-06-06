<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginAdmin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	$(document).ready(function(){
		$("#tblTipoFuncionario").tablesorter({
		headers:{
            1:{
                sorter: false
            },
            2:{
                sorter: false
            }
		}
		});
	});
	</script>
    <script>
	var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
	function validaSubmitEditarTipoFuncionario(){
		if(document.getElementById('txtEditarTipoFuncionario').value == ""){
			document.getElementById('lblErroTipoFuncionario').style.display = 'block';
			document.getElementById('lblEditarTipoFuncionario').innerHTML = "";
			return false;
		}else{
			document.getElementById('lblErroTipoFuncionario').style.display = 'none';
			
			jQuery.ajax({
			type: 'POST',
			url: 'editarTipoFuncionario.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Tipo de funcionário atualizado com sucesso!"){
					document.getElementById('frmEditarTipoFuncionario').style.display = 'none';
					acaoDepoisMsgFechar = "sim";
				}
				document.getElementById('lblEditarTipoFuncionario').innerHTML = msg;
			}
			});
			return false;
		}
	}
	function editarTipoFuncionario(id,conteudo){
		inserirForm  = "<form action='editarTipoFuncionario.php' method='post' name='frmEditarTipoFuncionario' id='frmEditarTipoFuncionario' onSubmit='return validaSubmitEditarTipoFuncionario()'>";
		inserirForm += "<input type='text' id='txtEditarTipoFuncionario' name='txtEditarTipoFuncionario' maxlength='50' value='" + conteudo + "' />";
		inserirForm += " <input type='submit' name='btnSubmit' value='Editar' />";
		inserirForm += "<input type='hidden' name='txtIdTipo' id='txtIdTipo' value='" + id + "' />";
		inserirForm += "<br /><div id='lblErroTipoFuncionario' class='msgErro'>campo tipo de funcionário em branco</div>";
		inserirForm += "</form>";
		inserirForm += "<div id='lblEditarTipoFuncionario'></div>";
		caixaMsgConteudo.innerHTML = inserirForm;
		abrirMsg();
	}
	function ocultarTipoFuncionario(acao,id){
		if(confirm('Tem certeza de que deseja ' + acao + ' este tipo de funcionário?')){
			//window.location = 'editarTipoFuncionario.php?acao=' + acao + '&idTipoFuncionario=' + id;
			jQuery.ajax({
			url: 'editarTipoFuncionario.php?acao=' + acao + '&idTipo=' + id,
			success: function(msg){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
			}
			});
		}
	}
	function inserirTipoFuncionario(){
		var txtTipoFuncionario = document.getElementById('txtTipoFuncionario');
		var inserirTipoFuncionario = document.getElementById('inserirTipoFuncionario');
		if(inserirTipoFuncionario.style.display == 'block'){
			inserirTipoFuncionario.style.display = 'none';
		}else{
			inserirTipoFuncionario.style.display = 'block';
			txtTipoFuncionario.focus();
		}
	}
	function validaSubmitTipoFuncionario(){
		var txtTipoFuncionario = document.getElementById('txtTipoFuncionario');
		var erroTipoFuncionario = document.getElementById('erroTipoFuncionario');
		var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
		
		if(txtTipoFuncionario.value == ""){
			erroTipoFuncionario.style.display = 'block';
			txtTipoFuncionario.focus();
			return false;
		}else{
			jQuery.ajax({
			type: 'POST',
			url: 'inserirTipoFuncionario.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Tipo de Funcionário adicionado com sucesso!"){
					acaoDepoisMsgFechar = "sim";
				}
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
			}
			});
			return false;
		}
	}
	function acaoDepoisMsg(){
		window.location = 'tipoFuncionario.php';
	}
	</script>
    <p class="titulo">Tipos de funcionários do formulário de cadastro</p>
    <p><a href="javascript:void(0);" onClick="inserirTipoFuncionario();">Inserir um novo tipo de funcionário</a></p>
    <div id="inserirTipoFuncionario" style="display:none">
        <form action="inserirTipoFuncionario.php" method="post" name="frmTipoFuncionario" id="frmTipoFuncionario" onSubmit="return validaSubmitTipoFuncionario()">
            Tipo de Funcionário: <input type="text" name="txtTipoFuncionario" id="txtTipoFuncionario" maxlength="50" />
            <input type="submit" name="btnSubmit" value="Adicionar" />
            <div id="erroTipoFuncionario" class="msgErro">o campo tipo de funcionário está em branco</div>
        </form>
        <br />
	</div>
		<table border="1" id="tblTipoFuncionario" class="paddingTbl">
        	<thead>
			<tr>
				<th width="200">Tipo de Funcionário</th>
				<th width="60">&nbsp;</th>
				<th width="60">&nbsp;</th>
			</tr>
            </thead>
		<?PHP
			$sql = "SELECT * FROM tipofuncionario ORDER BY idTipo DESC";
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
			?>
            <tr>
                <td><?PHP echo $registro['tipo']; ?></td>
                <td align="center" class="cursorPointer" onClick="editarTipoFuncionario('<?PHP echo $registro['idTipo']; ?>','<?PHP echo $registro['tipo']; ?>');">Editar</td>
                <?PHP
                if($registro['ocultar'] == "sim"){
                    ?><td align="center" class="cursorPointer" onClick="ocultarTipoFuncionario('exibir','<?PHP echo $registro['idTipo']; ?>');">Exibir</td><?PHP
                }else{
                    ?><td align="center" class="cursorPointer" onClick="ocultarTipoFuncionario('ocultar','<?PHP echo $registro['idTipo']; ?>');">Ocultar</td><?PHP
                }
                ?>
            </tr>
			<?PHP
			}
		?>
		</table>
<?PHP
	Require('footer.php');
?>