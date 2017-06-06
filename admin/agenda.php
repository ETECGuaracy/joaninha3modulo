<?PHP
	Require('verificaLogin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
<?PHP
	$sql = "SELECT * FROM funcionario";
	$selecao = mysql_query($sql);
	
	while($registro = mysql_fetch_assoc($selecao)){
		$nomeFuncionarioCompleto[$registro['idFuncionario']] = $registro['nome'];
	}
	
	$sql = "SELECT * FROM aluno";
	$selecao = mysql_query($sql);
	
	while($registro = mysql_fetch_assoc($selecao)){
		$nomeAlunoCompleto[$registro['idAluno']] = $registro['nome'];
	}
	
	$sql = "SELECT * FROM turma";
	$selecao = mysql_query($sql);
	
	while($registro = mysql_fetch_assoc($selecao)){
		$nomeTurmaCompleto[$registro['idTurma']] = $registro['turma'];
	}
	
	$idFuncionario = $_SESSION['idFuncionario'];
	$idAgenda = $_GET['idAgenda'];
?>
    <script>
	var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
	function excluirAgenda(id){
		if(confirm('Tem certeza de que deseja excluir este evento na agenda?')){
			//window.location = 'excluirAgenda.php?idAgenda=' + id;
			jQuery.ajax({
			url: 'excluirAgenda.php?idAgenda=' + id,
			success: function(msg){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
			}
			});
		}
	}
	function acaoDepoisMsg(){
		window.location = 'agenda.php';
	}
	</script>
    <p class="titulo">Agenda OnLine</p>
    <?PHP
    if($idAgenda == ""){ #se não houver um idAgenda exibir todos os eventos da agenda
		?>
        <p><a href="inserirAgenda.php">Inserir um novo evento na Agenda OnLine</a></p>
        <script>
        $(document).ready(function(){
           $("#tblAgenda").tablesorter({
			headers:{
				5:{
					sorter: false
				}
			}
			});
        });
        </script>
        <table border="1" id="tblAgenda" class="paddingTbl">
            <thead>
            <tr>
                <th>Assunto</th>
                <th>Para</th>
                <th>Nome / Turma</th>
                <th>Data Enviado</th>
                <th>Enviado por</th>
                <th width="60">&nbsp;</th>
            </tr>
            </thead>
        <?PHP
            if($_SESSION['tipoFuncionario'] == "admin" || $_SESSION['tipoFuncionario'] == "secretaria"){
                $sql = "SELECT * FROM agenda ORDER BY idAgenda DESC";
            }else{
                $sql = "SELECT * FROM agenda WHERE idFuncionario = $idFuncionario ORDER BY idAgenda DESC";
            }
            $selecao = mysql_query($sql);
            
            while($registro = mysql_fetch_assoc($selecao)){
            ?>
            <tr>
                <td onclick="window.location = '?idAgenda=<?PHP echo $registro['idAgenda']; ?>';" class="cursorPointer"><?PHP echo $registro['titulo']; ?></td>
                <td onclick="window.location = '?idAgenda=<?PHP echo $registro['idAgenda']; ?>';" class="cursorPointer"><?PHP
                    if($registro['idTurma'] == ""){
                        echo "Aluno";
                    }else if($registro['idAluno'] == ""){
                        echo "Turma";
                    }
                ?></td>
                <td onclick="window.location = '?idAgenda=<?PHP echo $registro['idAgenda']; ?>';" class="cursorPointer"><?PHP
                    if($registro['idTurma'] == ""){
                        echo $nomeAlunoCompleto[$registro['idAluno']];
                    }else if($registro['idAluno'] == ""){
                        echo $nomeTurmaCompleto[$registro['idTurma']];
                    }
                ?></td>
                <td onclick="window.location = '?idAgenda=<?PHP echo $registro['idAgenda']; ?>';" class="cursorPointer"><?PHP echo formatarData($registro['dataInserido']); ?></td>
                <td onclick="window.location = '?idAgenda=<?PHP echo $registro['idAgenda']; ?>';" class="cursorPointer"><?PHP echo $nomeFuncionarioCompleto[$registro['idFuncionario']]; ?></td>
                <td onclick="excluirAgenda('<?PHP echo $registro['idAgenda']; ?>');" class="cursorPointer">Excluir</td>
            </tr>
            <?PHP
            }
        ?>
        </table>
        <?PHP
	}else{ #caso exista, mostrar os detahes
		$sql = "SELECT * FROM agenda WHERE idAgenda = $idAgenda";
		$selecao = mysql_query($sql);
		$registro = mysql_fetch_assoc($selecao);
		if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria" && $registro['idFuncionario'] != $_SESSION['idFuncionario']){
			?><script>window.location = 'agenda.php';</script><?PHP
		}else{
			?>
			<table>
			  <tr>
				<td class="tituloTblDireita" width="120">Assunto:</td>
				<td><?PHP echo $registro['titulo']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Mensagem:</td>
				<td><?PHP echo str_replace(chr(10), "<br />", $registro['texto']); ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Enviado por:</td>
				<td><?PHP echo $nomeFuncionarioCompleto[$registro['idFuncionario']]; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Enviado em:</td>
				<td><?PHP echo formatarDataExtenso($registro['dataInserido']); ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Enviado para:</td>
				<td><?PHP
					if($registro['idTurma'] == ""){
						echo "Aluno: " . $nomeAlunoCompleto[$registro['idAluno']];
					}else if($registro['idAluno'] == ""){
						echo "Turma: " . $nomeTurmaCompleto[$registro['idTurma']];
					}
				?></td>
			  </tr>
              <tr>
				<td colspan="2" style="padding-left:100px; font-weight:bold;"><label onclick="excluirAgenda('<?PHP echo $registro['idAgenda']; ?>');" class="cursorPointer">Excluir</label></td>
			  </tr>
			</table>
			<?PHP
		}
	}
?>
<?PHP
	Require('footer.php');
?>