<?PHP
	Require('header.php');
	
	Require('conecta.php');	
?>
<p class="titulo">Agenda OnLine</p>
<?PHP
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno"){
		?>
        	<p>Página restrita a pais e alunos da escola.</p>
            <p>Para acessar o conteúdo faça o login.</p>
            <p>Caso seu filho não esteja cadastrado no sistema, por favor, solicite a secretaria.</p>
		<?PHP
	}else{
		$idAluno = $_SESSION['idAluno'];
		$idTurma = $idTurma;
		$idAgenda = $_GET['idAgenda'];
		
		if($idAgenda == ""){
			?>
			<script>
			$(document).ready(function(){
				$("#tblAgenda").tablesorter();
			});
			</script>
			<table border="1" id="tblAgenda" class="paddingTbl">
				<thead>
				<tr>
					<th>Assunto</th>
					<th>Data Enviado</th>
					<th>Enviado por</th>
				</tr>
				</thead>
			<?PHP
				$sql = "SELECT * FROM agenda ag
				INNER JOIN funcionario f ON f.idFuncionario = ag.idFuncionario
				WHERE ag.idAluno = $idAluno OR ag.idTurma = $idTurma
				ORDER BY ag.idAgenda DESC";
				$selecao = mysql_query($sql);
				
				while($registro = mysql_fetch_assoc($selecao)){
				?>
				<tr onclick="window.location = '?idAgenda=<?PHP echo $registro['idAgenda']; ?>';" class="cursorPointer">
					<td><?PHP echo $registro['titulo']; ?></td>
					<td><?PHP echo formatarData($registro['dataInserido']); ?></td>
					<td><?PHP echo $registro['nome']; ?></td>
				</tr>
				<?PHP
				}
			?>
			</table>
			<?PHP
		}else{
			$sql = "SELECT * FROM agenda ag
			INNER JOIN funcionario f ON f.idFuncionario = ag.idFuncionario
			WHERE ag.idAgenda = $idAgenda";
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			if($registro['idAluno'] == $idAluno || $registro['idTurma'] == $idTurma){
				?>
				<table>
				  <tr>
					<td width="120" class="tituloTblAgenda">Assunto:</td>
					<td><?PHP echo $registro['titulo']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblAgenda" valign="top">Mensagem:</td>
					<td><?PHP echo str_replace(chr(10), "<br />", $registro['texto']); ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblAgenda">Enviado por:</td>
					<td><?PHP echo $registro['nome']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblAgenda">Enviado em:</td>
					<td><?PHP echo formatarDataExtenso($registro['dataInserido']); ?></td>
				  </tr>
				</table>
				<?PHP
			}else{
				?><script>window.location = 'agendaOnline.php';</script><?PHP
			}
		}
	}
?>
<?PHP
	Require('footer.php');
?>