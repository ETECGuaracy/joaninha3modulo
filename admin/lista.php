<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginSecretaria.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	$(document).ready(function(){
		$("#tblLista").tablesorter({
		headers:{
			3:{
				sorter: false
			}
		}
		});
	});
	
	var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
	function editarQtd(id,conteudo){
		inserirForm  = "<form action='editarLista.php' method='post' name='frmEditarLista' id='frmEditarLista' onSubmit='return validaSubmitEditarLista()'>";
		inserirForm += "<input type='text' id='txtEditarQtd' name='txtEditarQtd' size='3' maxlength='3' value='" + conteudo + "' onkeypress='return SomenteNumero(event)' />";
		inserirForm += " <input type='submit' name='btnSubmit' value='Editar' />";
		inserirForm += "<input type='hidden' name='txtIdLista' id='txtIdLista' value='" + id + "' />";
		inserirForm += "<br /><div id='lblErroQtd' class='msgErro'>campo qantidade em branco</div>";
		inserirForm += "</form>";
		inserirForm += "<div id='lblEditarQtd'></div>";
		caixaMsgConteudo.innerHTML = inserirForm;
		abrirMsg();
	}
	function validaSubmitEditarLista(){
		if(document.getElementById('txtEditarQtd').value == ""){
			document.getElementById('lblErroQtd').style.display = 'block';
			document.getElementById('lblEditarQtd').innerHTML = "";
			return false;
		}else{
			document.getElementById('lblErroQtd').style.display = 'none';
			
			jQuery.ajax({
			type: 'POST',
			url: 'editarLista.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Quantidade atualizada com sucesso!"){
					document.getElementById('frmEditarLista').style.display = 'none';
					acaoDepoisMsgFechar = "sim";
				}
				document.getElementById('lblEditarQtd').innerHTML = msg;
			}
			});
			return false;
		}
	}
	function excluir(id){
		if(confirm('Tem certeza de que deseja excluir este produto?')){
			jQuery.ajax({
			url: 'excluirLista.php?idLista=' + id,
			success: function(msg){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
			}
			});
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
	function acaoDepoisMsg(){
		window.location = 'lista.php';
	}
	</script>
    <p class="titulo">Lista de Materiais</p>
	<?PHP
		if($_SESSION['tipoFuncionario'] == "admin"){
			?><p><a href="produto.php">Gerenciar produtos cadastrados</a></p><?PHP
		}
	?>
    <p><a href="inserirLista.php">Inserir um produto na lista de materiais</a></p>
    <table border="1" id="tblLista" class="paddingTbl">
        <thead>
        <tr>
            <th width="200">Turma</th>
            <th width="200">Produto</th>
            <th>Quantidade</th>
            <th width="60">&nbsp;</th>
        </tr>
        </thead>
    <?PHP
        $sql = "SELECT t.idTurma, t.turma, lp.idProduto, lp.produto, lt.idLista, lt.idTurma, lt.idProduto, lt.qtd FROM listaturma lt
		INNER JOIN turma t ON t.idTurma = lt.idTurma
		INNER JOIN listaproduto lp ON lp.idProduto = lt.idProduto
		ORDER BY t.idTurma DESC";
        $selecao = mysql_query($sql);
        
        while($registro = mysql_fetch_assoc($selecao)){
        ?>
        <tr>
            <td><?PHP echo $registro['turma']; ?></td>
            <td><?PHP echo $registro['produto']; ?></td>
            <td align="right" class="cursorPointer" onClick="editarQtd('<?PHP echo $registro['idLista']; ?>','<?PHP echo $registro['qtd']; ?>');"><?PHP echo $registro['qtd']; ?></td>
            <td align="center" class="cursorPointer" onClick="excluir('<?PHP echo $registro['idLista']; ?>');">Excluir</td>
        </tr>
        <?PHP
        }
    ?>
    </table>
    <p style="font-size:12px;">Para editar a quantidade de produtos, clique sobre ela.</p>
<?PHP
	Require('footer.php');
?>