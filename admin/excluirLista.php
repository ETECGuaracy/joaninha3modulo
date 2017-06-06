<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria"){
			header('location: index.php');
		}else{
			Require('conecta.php');
			
			$idLista = $_GET['idLista'];
			
			if($idLista == ""){
				header('location: index.php');
			}else{
				$sql = "DELETE FROM listaturma WHERE idLista = $idLista";
				if (!mysql_query($sql)){
					echo "Houve um erro e o produto não foi excluido!<br />Tente novamente mais tarde.";
				}else{
					echo "Produto excluido com sucesso!";
				}
			}
		}
	}
?>