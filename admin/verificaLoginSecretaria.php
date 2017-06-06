<?PHP
	session_start();
	
	if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria"){
		header('location: index.php');
	}
?>