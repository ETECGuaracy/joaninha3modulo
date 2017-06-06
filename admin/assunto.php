<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginAdmin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	$(document).ready(function(){
		$("#tblAssunto").tablesorter({
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
	function validaSubmitEditarAssunto(){
		if(document.getElementById('txtEditarAssunto').value == ""){
			document.getElementById('lblErroAssunto').style.display = 'block';
			document.getElementById('lblEditarAssunto').innerHTML = "";
			return false;
		}else{
			document.getElementById('lblErroAssunto').style.display = 'none';
			
			jQuery.ajax({
			type: 'POST',
			url: 'editarAssunto.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Assunto atualizado com sucesso!"){
					document.getElementById('frmEditarAssunto').style.display = 'none';
					acaoDepoisMsgFechar = "sim";
				}
				document.getElementById('lblEditarAssunto').innerHTML = msg;
			}
			});
			return false;
		}
	}
	function editarAssunto(id,conteudo){
		inserirForm  = "<form action='editarAssunto.php' method='post' name='frmEditarAssunto' id='frmEditarAssunto' onSubmit='return validaSubmitEditarAssunto()'>";
		inserirForm += "<input type='text' id='txtEditarAssunto' name='txtEditarAssunto' maxlength='50' value='" + conteudo + "' />";
		inserirForm += " <input type='submit' name='btnSubmit' value='Editar' />";
		inserirForm += "<input type='hidden' name='txtIdAssunto' id='txtIdAssunto' value='" + id + "' />";
		inserirForm += "<br /><div id='lblErroAssunto' class='msgErro'>campo assunto em branco</div>";
		inserirForm += "</form>";
		inserirForm += "<div id='lblEditarAssunto'></div>";
		caixaMsgConteudo.innerHTML = inserirForm;
		abrirMsg();
	}
	function ocultarAssunto(acao,id){
		if(confirm('Tem certeza de que deseja ' + acao + ' este assunto?')){
			//window.location = 'editarAssunto.php?acao=' + acao + '&idAssunto=' + id;
			jQuery.ajax({
			url: 'editarAssunto.php?acao=' + acao + '&idAssunto=' + id,
			success: function(msg){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
			}
			});
		}
	}
	function inserirAssunto(){
		var txtAssunto = document.getElementById('txtAssunto');
		var inserirAssunto = document.getElementById('inserirAssunto');
		if(inserirAssunto.style.display == 'block'){
			inserirAssunto.style.display = 'none';
		}else{
			inserirAssunto.style.display = 'block';
			txtAssunto.focus();
		}
	}
	function validaSubmitAssunto(){
		var txtAssunto = document.getElementById('txtAssunto');
		var erroAssunto = document.getElementById('erroAssunto');
		var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
		
		if(txtAssunto.value == ""){
			erroAssunto.style.display = 'block';
			txtAssunto.focus();
			return false;
		}else{
			jQuery.ajax({
			type: 'POST',
			url: 'inserirAssunto.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Assunto adicionado com sucesso!"){
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
		window.location = 'assunto.php';
	}
	</script>
    <p class="titulo">Assuntos do formulário de contato</p>
    <p><a href="javascript:void(0);" onClick="inserirAssunto();">Inserir um novo assunto</a></p>
    <div id="inserirAssunto" style="display:none">
        <form action="inserirAssunto.php" method="post" name="frmAssunto" id="frmAssunto" onSubmit="return validaSubmitAssunto()">
            Assunto: <input type="text" name="txtAssunto" id="txtAssunto" maxlength="50" />
            <input type="submit" name="btnSubmit" value="Adicionar" />
            <div id="erroAssunto" class="msgErro">o campo assunto está em branco</div>
        </form>
        <br />
	</div>
		<table border="1" id="tblAssunto" class="paddingTbl">
        	<thead>
			<tr>
				<th width="200">Assunto</th>
				<th width="60">&nbsp;</th>
				<th width="60">&nbsp;</th>
			</tr>
            </thead>
		<?PHP
			$sql = "SELECT * FROM assunto ORDER BY idAssunto DESC";
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
			?>
            <tr>
                <td><?PHP echo $registro['assunto']; ?></td>
                <td align="center" class="cursorPointer" onClick="editarAssunto('<?PHP echo $registro['idAssunto']; ?>','<?PHP echo $registro['assunto']; ?>');">Editar</td>
                <?PHP
                if($registro['ocultar'] == "sim"){
                    ?><td align="center" class="cursorPointer" onClick="ocultarAssunto('exibir','<?PHP echo $registro['idAssunto']; ?>');">Exibir</td><?PHP
                }else{
                    ?><td align="center" class="cursorPointer" onClick="ocultarAssunto('ocultar','<?PHP echo $registro['idAssunto']; ?>');">Ocultar</td><?PHP
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