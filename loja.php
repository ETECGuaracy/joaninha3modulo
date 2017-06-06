<?PHP
	Require('header.php');
	
	Require('conecta.php');	
?>
<p class="titulo">Loja Virtual</p>
<?PHP
	$idProduto = $_GET['idProduto'];
	
	if($idProduto == ""){
		?>
        <style>
		#divBuscar{
			float:left;
			width:800px;
			text-align:center;
			margin-bottom:10px;
		}
		#divBuscarBorda{
			width:680px;
			margin:auto;
			padding:5px;
			background-color:#f78c18;
			color:white;
			font-weight:bold;
		}
		#divMeuCarrinho{
			float:right;
		}
		</style>
        <script>
		$('#divBuscarBorda').corner();
		</script>
        <form action="buscar.php" method="get" name="frmBuscar" id="frmBuscar">
        	<div id="divBuscar"><div id="divBuscarBorda">Buscar na loja: <input type="text" name="txtBuscar" id="txtBuscar" size="80" /> <input type="submit" name="btnSubmit" value="Buscar" /></div></div>
            <div id="divMeuCarrinho"><a href="carrinho.php"><img src="_img/meuCarrinho.jpg" border="0" /></a></div>
        </form>
		<table border="1" bordercolor="#f78c18">
			<?PHP
				$sql = "SELECT * FROM lojaproduto WHERE ocultar = 'nao'";
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				$contador = 0;
				while($contador < $linhas){
					$sql = "SELECT * FROM lojaproduto WHERE ocultar = 'nao' ORDER BY idProduto DESC LIMIT " . $contador . ",5";
					?>
                    <?PHP
					if($contador != 0){
						?>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <?PHP
					}
					?>
					<tr align="center">
						<?PHP
							$selecao = mysql_query($sql);
							while($registro = mysql_fetch_assoc($selecao)){
							?>
							<td><strong><a href="?idProduto=<?PHP echo $registro['idProduto']; ?>"><?PHP echo $registro['nome']; ?></a></strong></td>
							<?PHP
							}
						?>
					</tr>
					<tr>
						<?PHP
							$selecao = mysql_query($sql);
							while($registro = mysql_fetch_assoc($selecao)){
							?>
							<td><a href="?idProduto=<?PHP echo $registro['idProduto']; ?>"><img src="loja/imgPeq/<?PHP echo $registro['img']; ?>" border="0" /></a></td>
							<?PHP
							}
						?>
					</tr>
                    <tr align="center">
						<?PHP
							$selecao = mysql_query($sql);
							while($registro = mysql_fetch_assoc($selecao)){
							?>
							<td><strong><a href="?idProduto=<?PHP echo $registro['idProduto']; ?>">R$: <?PHP echo $registro['valor']; ?></a></strong></td>
							<?PHP
							}
						?>
					</tr>
                    <tr align="center">
						<?PHP
							$selecao = mysql_query($sql);
							while($registro = mysql_fetch_assoc($selecao)){
							?>
							<td><a href="?idProduto=<?PHP echo $registro['idProduto']; ?>"><img src="_img/detalhes.jpg" border="0" /></a></td>
							<?PHP
							}
						?>
					</tr>
					<?PHP
					$contador = $contador + 5;
				}
			?>
		</table>
	<?PHP
	}else{
		$sql = "SELECT * FROM lojaproduto WHERE idProduto = $idProduto AND ocultar = 'nao'";
		$selecao = mysql_query($sql);
		$registro = mysql_fetch_assoc($selecao);
		
		?>
        <p><a href="loja.php"><img src="_img/voltar.jpg" border="0" /></a></p>
		<table align="center">
        	<tr>
            	<td colspan="2" align="center"><strong><?PHP echo $registro['nome']; ?></strong></td>
            </tr>
        	<tr>
            	<td><img src="loja/imgGrd/<?PHP echo $registro['img']; ?>" /></td>
                <td valign="top" width="400">
                	<strong><br />Descrição do produto:</strong>
                    <br />
                    <?PHP echo str_replace(chr(10), "<br />", $registro['descricao']); ?>
                    <br />
                    <strong>Preço:</strong> R$: <?PHP echo $registro['valor']; ?>
                    <br />
                    <strong><a href="carrinho.php?idProduto=<?PHP echo $registro['idProduto']; ?>"><br /><img src="_img/adicionar.jpg" border="0" /></a></strong>
                </td>
            </tr>
        </table>
		<?PHP
	}
	?>
<?PHP
	Require('footer.php');
?>