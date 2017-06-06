<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$idAgenda = $_GET['idAgenda'];
		$idFuncionario = $_SESSION['idFuncionario'];
		
		if($idAgenda == ""){
			header('location: index.php');
		}else{
			$sql = "SELECT * FROM agenda WHERE idAgenda = $idAgenda";
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria" && $registro['idFuncionario'] != $idFuncionario){
				header('location: index.php');
			}else{
				$sql = "DELETE FROM agenda WHERE idAgenda = $idAgenda";
				
				if (!mysql_query($sql)){
					echo "Houve um erro e o evento não foi excluído!<br />Tente novamente mais tarde.";
				}else{
					echo "Evento excluído com sucesso!";
				}
			}
		}
	}
?>