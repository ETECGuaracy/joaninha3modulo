<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria"){
			header('location: index.php');
		}else{
			Require('conecta.php');
			
			$txtEditarQtd = $_POST['txtEditarQtd'];
			$txtIdLista = $_POST['txtIdLista'];
			
			if($txtEditarQtd == "" || $txtIdLista == ""){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				$sql = "UPDATE listaturma SET qtd = '$txtEditarQtd' WHERE idLista = $txtIdLista";
				if (!mysql_query($sql)){
					echo "Houve um erro e a quantidade do produto não foi atualizado!<br />Tente novamente mais tarde.";
				}else{
					echo "Quantidade atualizada com sucesso!";
				}
			}
		}
	}
?>