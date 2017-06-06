<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$idTurma = $_GET['idTurma'];
		$acao = $_GET['acao'];
		
		if($acao == ""){
			$txtEditarTurma = trim($_POST['txtEditarTurma']);
			
			if($txtEditarTurma == ""){
				echo "Existem campos em branco<br />Tente novamente";
			}else{
				$idTurma = $_POST['txtIdTurma'];
				
				$sql = "SELECT * FROM turma WHERE turma = '$txtEditarTurma'";
				
				if (!mysql_query($sql)){
					$mensagem = "Houve um erro!<br />Tente novamente mais tarde.";
				}else{
					$selecao = mysql_query($sql);
					$linhas = mysql_num_rows($selecao);
					
					if($linhas == 0){
						$sql = "UPDATE turma SET turma = '$txtEditarTurma' WHERE idTurma = $idTurma";
						if (!mysql_query($sql)){
							echo "Houve um erro e a turma não foi atualizada!<br />Tente novamente mais tarde.";
						}else{
							echo "Turma atualizada com sucesso!";
						}
					}else{
						echo "Esta turma já existe!<br />Tente novamente.";
					}
				}
			}
		}else if($acao == "ocultar"){
			$sql = "UPDATE turma SET ocultar = 'sim' WHERE idTurma = $idTurma";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "A turma foi ocultada com sucesso !";
			}
		}else if($acao == "exibir"){
			$sql = "UPDATE turma SET ocultar = 'nao' WHERE idTurma = $idTurma";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "A turma foi exibida com sucesso !";
			}
		}
	}
?>