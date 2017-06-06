<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno"){ #verifica se o usuário (aluno) está logado
		header('location: index.php');
	}
?>