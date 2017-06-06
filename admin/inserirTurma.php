<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$txtTurma = trim($_POST['txtTurma']);
		
		if($txtTurma == ""){
			echo "Existem campos em branco<br />Tente novamente";
		}else{
			$sql = "SELECT * FROM turma WHERE turma = '$txtTurma'";
		
			if (!mysql_query($sql)){
				echo "Houve um erro e a turma não foi adicionada!<br />Tente novamente mais tarde.";
			}else{
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				if($linhas == 0){
					$sql = "INSERT INTO turma (turma, ocultar) VALUES ('$txtTurma', 'nao')";
					if (!mysql_query($sql)){
						echo "Houve um erro e a turma não foi adicionada!<br />Tente novamente mais tarde.";
					}else{
						echo "Turma adicionada com sucesso!";
					}
				}else{
					echo "Esta turma já existe!<br />Tente novamente.";
				}
			}
		}
	}
?>