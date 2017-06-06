<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$txtAssunto = trim($_POST['txtAssunto']);
		
		if($txtAssunto == ""){
			echo "Existem campos em branco<br />Tente novamente";
		}else{
			$sql = "SELECT * FROM assunto WHERE assunto = '$txtAssunto'";
		
			if (!mysql_query($sql)){
				echo "Houve um erro e o assunto não foi adicionado!<br />Tente novamente mais tarde.";
			}else{
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				if($linhas == 0){
					$sql = "INSERT INTO assunto (assunto, ocultar) VALUES ('$txtAssunto', 'nao')";
					if (!mysql_query($sql)){
						echo "Houve um erro e o assunto não foi adicionado!<br />Tente novamente mais tarde.";
					}else{
						echo "Assunto adicionado com sucesso!";
					}
				}else{
					echo "Este assunto já existe!<br />Tente novamente.";
				}
			}
		}
	}
?>