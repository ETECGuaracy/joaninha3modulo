<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria" && $_SESSION['tipoFuncionario'] != "professor"){
			header('location: index.php');
		}else{
			Require('conecta.php');
			
			$txtAluno = trim($_POST['txtAluno']);
			$txtTurma = trim($_POST['txtTurma']);
			$txtTitulo = trim($_POST['txtTitulo']);
			$txtTexto = trim($_POST['txtTexto']);
			$idFuncionario = $_SESSION['idFuncionario'];
			$data = time();
			
			if($txtAluno == "" && $txtTurma == ""){
				echo "Escolha um destinatário";
			}else{
				if($txtTitulo == "" || $txtTexto == ""){
					echo "Existem campos em branco<br />Tente novamente";
				}else{
					if($txtAluno != ""){
						$sql = "INSERT INTO agenda (idAluno, titulo, texto, idFuncionario, dataInserido) VALUES ('$txtAluno', '$txtTitulo', '$txtTexto', '$idFuncionario', '$data')";
					}else if($txtTurma != ""){
						$sql = "INSERT INTO agenda (idTurma, titulo, texto, idFuncionario, dataInserido) VALUES ('$txtTurma', '$txtTitulo', '$txtTexto', '$idFuncionario', '$data')";
					}
					
					if (!mysql_query($sql)){
						echo "Houve um erro e o evento não foi adicionado!<br />Tente novamente mais tarde.";
					}else{
						echo "Evento adicionado com sucesso!";
					}
				}
			}
		}
	}
?>