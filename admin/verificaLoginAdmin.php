<?PHP
	session_start();
	
	if($_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}
?>