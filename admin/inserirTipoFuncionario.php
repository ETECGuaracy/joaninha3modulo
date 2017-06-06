<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$txtTipoFuncionario = trim($_POST['txtTipoFuncionario']);
		
		if($txtTipoFuncionario == ""){
			echo "Existem campos em branco<br />Tente novamente";
		}else{
			$sql = "SELECT * FROM tipofuncionario WHERE tipo = '$txtTipoFuncionario'";
		
			if (!mysql_query($sql)){
				echo "Houve um erro e o tipo de funcionário não foi adicionado!<br />Tente novamente mais tarde.";
			}else{
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				if($linhas == 0){
					$sql = "INSERT INTO tipofuncionario (tipo, ocultar) VALUES ('$txtTipoFuncionario', 'nao')";
					if (!mysql_query($sql)){
						echo "Houve um erro e o tipo de funcionário não foi adicionado!<br />Tente novamente mais tarde.";
					}else{
						echo "Tipo de funcionário adicionado com sucesso!";
					}
				}else{
					echo "Este tipo de funcionário já existe!<br />Tente novamente.";
				}
			}
		}
	}
?>