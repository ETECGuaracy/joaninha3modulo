<?PHP
	Require('header.php');
	
	Require('conecta.php');	
?>
<p class="titulo">Lista de Materiais</p>
<?PHP
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno"){
		?>
        	<p>Página restrita a pais e alunos da escola.</p>
            <p>Para acessar o conteúdo faça o login.</p>
            <p>Caso seu filho não esteja cadastrado no sistema, por favor, solicite a secretaria.</p>
		<?PHP
	}else{
		?>
        <p>Lista de Materiais de: <strong><?PHP echo $nomeTurma; ?></strong></p>
        <script>
		$(document).ready(function(){
			$("#tblLista").tablesorter();
		});
		</script>
		<table id="tblLista" border="1" class="paddingTbl">
        	<thead>
            <tr>
                <th>Quantidade</th>
                <th>Material</th>
            </tr>
            </thead>
		<?PHP
			$sql = "SELECT lp.idProduto, lp.produto, lt.idLista, lt.idTurma, lt.idProduto, lt.qtd FROM listaturma lt
			INNER JOIN listaproduto lp ON lp.idProduto = lt.idProduto
			WHERE lt.idTurma = $idTurma
			ORDER BY lp.produto";
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
			?>
			<tr>
				<td align="right"><?PHP echo $registro['qtd']; ?></td>
                <td><?PHP echo $registro['produto']; ?></td>
			</tr>
			<?PHP
			}
		?>
		</table>
        <?PHP
	}
?>
<?PHP
	Require('footer.php');
?>