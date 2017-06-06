<?PHP
	Require('header.php');
	
	Require('conecta.php');	
?>
<style>
#divBuscarBorda{
	width:680px;
	margin:auto;
	padding:5px;
	background-color:#f78c18;
	color:white;
	font-weight:bold;
}
</style>
<script>
$('#divBuscarBorda').corner();
</script>
<p class="titulo">Resultados da busca na Loja Virtual</p>
<form action="buscar.php" method="get" name="frmBuscar" id="frmBuscar">
    <div id="divBuscarBorda">Buscar na loja: <input type="text" name="txtBuscar" id="txtBuscar" size="80" /> <input type="submit" name="btnSubmit" value="Buscar" /></div>
</form>
<?PHP
	$txtBuscar = $_GET['txtBuscar'];
	
	if($txtBuscar != ""){
		?><p><strong>Resultados da busca de "<?PHP echo $txtBuscar; ?>"</strong></p><?PHP
		$sql = "SELECT * FROM lojaproduto WHERE nome LIKE '%$txtBuscar%' ORDER BY idProduto DESC";
		$selecao = mysql_query($sql);
		$contador = 0;
		?>
        <script>
		$(document).ready(function(){
			$("#tblResultadoBusca").tablesorter({
			headers:{
				0:{
					sorter: false
				},
				3:{
					sorter: false
				}
			}
			});
		});
		</script>
        <table id="tblResultadoBusca" border="1" class="paddingTbl">
			<thead>
			<tr>
				<th>Miniatura</th>
				<th>Nome do produto</th>
				<th>Valor unitário</th>
                <th>&nbsp;</th>
			</tr>
			</thead>
		<?PHP
		while($registro = mysql_fetch_assoc($selecao)){
			?>
			<tr class="cursorPointer" onclick="window.location='loja.php?idProduto=<?PHP echo $registro['idProduto']; ?>';">
            	<td><img src="loja/imgPeq/<?PHP echo $registro['img']; ?>" /></td>
                <td><?PHP echo $registro['nome']; ?></td>
                <td>R$: <?PHP echo $registro['valor']; ?></td>
                <td>Ver mais detalhes</td>
            </tr>
			<?PHP
			$contador++;
		}
		?>
        	<tfoot>
			<tr>
				<th colspan="4">Foram encontrados: <?PHP echo $contador; ?> registros.</th>
			</tr>
			</tfoot>
        </table>
		<?PHP
	}
?>
<?PHP
	Require('footer.php');
?>