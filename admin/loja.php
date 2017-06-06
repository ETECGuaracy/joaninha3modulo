<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginAdmin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	$(document).ready(function(){
		$("#tblLoja").tablesorter({
		headers:{
            2:{
                sorter: false
            },
            3:{
                sorter: false
            }
		}
		});
	});
	</script>
    <script>
	var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
	function editarProduto(id){
		jQuery.ajax({
		url: 'editarLoja.php?acao=editar&idProduto=' + id,
		success: function(msg){
			caixaMsgConteudo.innerHTML = msg;
			abrirMsg();
			acaoDepoisMsgFechar = "sim";
			$("#txtValor").maskMoney({symbol:"R$",decimal:",",thousands:"."})
		}
		});
	}
	function validaSubmitEditarLoja(){
		campoForm = new Array();
		campoForm[0] = "NomeProduto";
		campoForm[1] = "Descricao";
		campoForm[2] = "Valor";
		
		campoVazio = 0;
		validaCampoVazio();
		
		if(campoVazio == 0){
			jQuery.ajax({
			type: 'POST',
			url: 'editarLojaConfirma.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				document.getElementById('frmLojaEditar').style.display = 'none';
				document.getElementById('divMsgErroLoja').innerHTML = msg;
			}
			});
		}
		return false;
	}
	function alterarImagem(id){
		caixaMsgConteudo.innerHTML = '<iframe id="iframeEditarImagem" height="140" width="380" frameborder="0" scrolling="auto" src="editarLoja.php?acao=alterarImagem&idProduto=' + id + '"></iframe>';
		abrirMsg();
		acaoDepoisMsgFechar = "sim";
	}
	function ocultarProduto(acao,id){
		if(confirm('Tem certeza de que deseja ' + acao + ' este produto?')){
			jQuery.ajax({
			url: 'editarLoja.php?acao=' + acao + '&idProduto=' + id,
			success: function(msg){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
			}
			});
		}
	}
	function verProduto(id){
		jQuery.ajax({
		url: 'verLoja.php?idProduto=' + id,
		success: function(msg){
			caixaMsgConteudo.innerHTML = msg;
			abrirMsg();
		}
		});
	}
	function acaoDepoisMsg(){
		window.location = 'loja.php';
	}
	</script>
    <p class="titulo">Produtos da Loja Virtual</p>
    <p><a href="inserirLoja.php">Inserir um novo produto</a></p>
		<table border="1" id="tblLoja" class="paddingTbl">
        	<thead>
			<tr>
				<th>Nome do produto</th>
                <th>Valor</th>
				<th width="60">&nbsp;</th>
				<th width="60">&nbsp;</th>
			</tr>
            </thead>
		<?PHP
			$sql = "SELECT * FROM lojaproduto ORDER BY idProduto DESC";
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
			?>
            <tr>
                <td class="cursorPointer" onClick="verProduto('<?PHP echo $registro['idProduto']; ?>');"><?PHP echo $registro['nome']; ?></td>
                <td class="cursorPointer" onClick="verProduto('<?PHP echo $registro['idProduto']; ?>');">R$: <?PHP echo $registro['valor']; ?></td>
                <td align="center" class="cursorPointer" onClick="editarProduto('<?PHP echo $registro['idProduto']; ?>');">Editar</td>
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
        <p style="font-size:12px;">Para ver mais detalhes, clique sobre o nome do produto.<br /><label style="color:#F00;">Alterações nos preços podem causar conflitos nos pedidos já iniciados.</label></p>
<?PHP
	Require('footer.php');
?>