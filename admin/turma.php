<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginAdmin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	$(document).ready(function(){
		$("#tblTurma").tablesorter({
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
	function validaSubmitEditarTurma(){
		if(document.getElementById('txtEditarTurma').value == ""){
			document.getElementById('lblErroTurma').style.display = 'block';
			document.getElementById('lblEditarTurma').innerHTML = "";
			return false;
		}else{
			document.getElementById('lblErroTurma').style.display = 'none';
			
			jQuery.ajax({
			type: 'POST',
			url: 'editarTurma.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Turma atualizada com sucesso!"){
					document.getElementById('frmEditarTurma').style.display = 'none';
					acaoDepoisMsgFechar = "sim";
				}
				document.getElementById('lblEditarTurma').innerHTML = msg;
			}
			});
			return false;
		}
	}
	function editarTurma(id,conteudo){
		inserirForm  = "<form action='editarTurma.php' method='post' name='frmEditarTurma' id='frmEditarTurma' onSubmit='return validaSubmitEditarTurma()'>";
		inserirForm += "<input type='text' id='txtEditarTurma' name='txtEditarTurma' maxlength='50' value='" + conteudo + "' />";
		inserirForm += " <input type='submit' name='btnSubmit' value='Editar' />";
		inserirForm += "<input type='hidden' name='txtIdTurma' id='txtIdTurma' value='" + id + "' />";
		inserirForm += "<br /><div id='lblErroTurma' class='msgErro'>campo turma em branco</div>";
		inserirForm += "</form>";
		inserirForm += "<div id='lblEditarTurma'></div>";
		caixaMsgConteudo.innerHTML = inserirForm;
		abrirMsg();
	}
	function ocultarTurma(acao,id){
		if(confirm('Tem certeza de que deseja ' + acao + ' esta turma?')){
			//window.location = 'editarTurma.php?acao=' + acao + '&idTurma=' + id;
			jQuery.ajax({
			url: 'editarTurma.php?acao=' + acao + '&idTurma=' + id,
			success: function(msg){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
			}
			});
		}
	}
	function inserirTurma(){
		var txtTurma = document.getElementById('txtTurma');
		var inserirTurma = document.getElementById('inserirTurma');
		if(inserirTurma.style.display == 'block'){
			inserirTurma.style.display = 'none';
		}else{
			inserirTurma.style.display = 'block';
			txtTurma.focus();
		}
	}
	function validaSubmitTurma(){
		var txtTurma = document.getElementById('txtTurma');
		var erroTurma = document.getElementById('erroTurma');
		var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
		
		if(txtTurma.value == ""){
			erroTurma.style.display = 'block';
			txtTurma.focus();
			return false;
		}else{
			jQuery.ajax({
			type: 'POST',
			url: 'inserirTurma.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Turma adicionada com sucesso!"){
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
		window.location = 'turma.php';
	}
	</script>
    <p class="titulo">Turmas do formulário de cadastro</p>
    <p><a href="javascript:void(0);" onClick="inserirTurma();">Inserir uma nova turma</a></p>
    <div id="inserirTurma" style="display:none">
        <form action="inserirTurma.php" method="post" name="frmTurma" id="frmTurma" onSubmit="return validaSubmitTurma()">
            Turma: <input type="text" name="txtTurma" id="txtTurma" maxlength="50" />
            <input type="submit" name="btnSubmit" value="Adicionar" />
            <div id="erroTurma" class="msgErro">o campo turma está em branco</div>
        </form>
        <br />
	</div>
		<table border="1" id="tblTurma" class="paddingTbl">
        	<thead>
			<tr>
				<th width="200">Turma</th>
				<th width="60">&nbsp;</th>
				<th width="60">&nbsp;</th>
			</tr>
            </thead>
		<?PHP
			$sql = "SELECT * FROM turma ORDER BY idTurma DESC";
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
			?>
            <tr>
                <td><?PHP echo $registro['turma']; ?></td>
                <td align="center" class="cursorPointer" onClick="editarTurma('<?PHP echo $registro['idTurma']; ?>','<?PHP echo $registro['turma']; ?>');">Editar</td>
                <?PHP
                if($registro['ocultar'] == "sim"){
                    ?><td align="center" class="cursorPointer" onClick="ocultarTurma('exibir','<?PHP echo $registro['idTurma']; ?>');">Exibir</td><?PHP
                }else{
                    ?><td align="center" class="cursorPointer" onClick="ocultarTurma('ocultar','<?PHP echo $registro['idTurma']; ?>');">Ocultar</td><?PHP
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