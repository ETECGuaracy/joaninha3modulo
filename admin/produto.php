<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginAdmin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	$(document).ready(function(){
		$("#tblProduto").tablesorter({
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
	var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
	function validaSubmitEditarProduto(){
		if(document.getElementById('txtEditarProduto').value == ""){
			document.getElementById('lblErroProduto').style.display = 'block';
			document.getElementById('lblEditarProduto').innerHTML = "";
			return false;
		}else{
			document.getElementById('lblErroProduto').style.display = 'none';
			
			jQuery.ajax({
			type: 'POST',
			url: 'editarProduto.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Produto atualizado com sucesso!"){
					document.getElementById('frmEditarProduto').style.display = 'none';
					acaoDepoisMsgFechar = "sim";
				}
				document.getElementById('lblEditarProduto').innerHTML = msg;
			}
			});
			return false;
		}
	}
	function editarProduto(id,conteudo){
		inserirForm  = "<form action='editarProduto.php' method='post' name='frmEditarProduto' id='frmEditarProduto' onSubmit='return validaSubmitEditarProduto()'>";
		inserirForm += "<input type='text' id='txtEditarProduto' name='txtEditarProduto' maxlength='100' value='" + conteudo + "' />";
		inserirForm += " <input type='submit' name='btnSubmit' value='Editar' />";
		inserirForm += "<input type='hidden' name='txtIdProduto' id='txtIdProduto' value='" + id + "' />";
		inserirForm += "<br /><div id='lblErroProduto' class='msgErro'>campo produto em branco</div>";
		inserirForm += "</form>";
		inserirForm += "<div id='lblEditarProduto'></div>";
		caixaMsgConteudo.innerHTML = inserirForm;
		abrirMsg();
	}
	function ocultarProduto(acao,id){
		if(confirm('Tem certeza de que deseja ' + acao + ' este produto?')){
			//window.location = 'editarProduto.php?acao=' + acao + '&idProduto=' + id;
			jQuery.ajax({
			url: 'editarProduto.php?acao=' + acao + '&idProduto=' + id,
			success: function(msg){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
			}
			});
		}
	}
    function inserirProduto(){
        var txtCampo = document.getElementById('txtProduto');
        var inserirCampo = document.getElementById('inserirProduto');
		
        if(inserirCampo.style.display == 'block'){
            inserirCampo.style.display = 'none';
        }else{
            inserirCampo.style.display = 'block';
            txtCampo.focus();
        }
    }
    function validaSubmitProduto(){
        var txtCampo = document.getElementById('txtProduto');
        var lblErroCampo = document.getElementById('lblErroProduto');
        
        if(txtCampo.value == ""){
            lblErroCampo.style.display = 'block';
            txtCampo.focus();
            return false;
        }else{
            jQuery.ajax({
            type: 'POST',
            url: 'inserirProduto.php',
            data: jQuery('form').serialize(),
            success: function(msg){
                if(msg == "Produto adicionado com sucesso!"){
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
		window.location = 'produto.php';
	}
    </script>
    <p class="titulo">Produtos cadastrados</p>
	<p><a href="javascript:void(0);" onClick="inserirProduto();">Inserir um novo produto / material</a></p>
    <div id="inserirProduto" style="display:none">
        <form action="inserirProduto.php" method="post" name="frmProduto" id="frmProduto" onSubmit="return validaSubmitProduto()">
            Nome do produto: <input type="text" name="txtProduto" id="txtProduto" maxlength="100" />
            <input type="submit" name="btnSubmit" value="Adicionar" />
            <div id="lblErroProduto" class="msgErro">o campo nome do produto está em branco</div>
        </form>
        <br />
	</div>
    <table border="1" id="tblProduto" class="paddingTbl">
        <thead>
        <tr>
            <th width="200">Nome do Produto</th>
            <th width="60">&nbsp;</th>
            <th width="60">&nbsp;</th>
        </tr>
        </thead>
    <?PHP
        $sql = "SELECT * FROM listaproduto ORDER BY idProduto DESC";
        $selecao = mysql_query($sql);
        
        while($registro = mysql_fetch_assoc($selecao)){
        ?>
        <tr>
            <td><?PHP echo $registro['produto']; ?></td>
            <td align="center" class="cursorPointer" onClick="editarProduto('<?PHP echo $registro['idProduto']; ?>','<?PHP echo $registro['produto']; ?>');">Editar</td>
            <?PHP
            if($registro['ocultar'] == "sim"){
                ?><td align="center" class="cursorPointer" onClick="ocultarProduto('exibir','<?PHP echo $registro['idProduto']; ?>');">Exibir</td><?PHP
            }else{
                ?><td align="center" class="cursorPointer" onClick="ocultarProduto('ocultar','<?PHP echo $registro['idProduto']; ?>');">Ocultar</td><?PHP
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