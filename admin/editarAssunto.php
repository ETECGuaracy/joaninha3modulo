<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$idAssunto = $_GET['idAssunto'];
		$acao = $_GET['acao'];
		
		if($acao == ""){
			$txtEditarAssunto = trim($_POST['txtEditarAssunto']);
			
			if($txtEditarAssunto == ""){
				echo "Existem campos em branco<br />Tente novamente";
			}else{
				$idAssunto = $_POST['txtIdAssunto'];
				
				$sql = "SELECT * FROM assunto WHERE assunto = '$txtEditarAssunto'";
				
				if (!mysql_query($sql)){
					$mensagem = "Houve um erro!<br />Tente novamente mais tarde.";
				}else{
					$selecao = mysql_query($sql);
					$linhas = mysql_num_rows($selecao);
					
					if($linhas == 0){
						$sql = "UPDATE assunto SET assunto = '$txtEditarAssunto' WHERE idAssunto = $idAssunto";
						if (!mysql_query($sql)){
							echo "Houve um erro e o assunto não foi atualizado!<br />Tente novamente mais tarde.";
						}else{
							echo "Assunto atualizado com sucesso!";
						}
					}else{
						echo "Este assunto já existe!<br />Tente novamente.";
					}
				}
			}
		}else if($acao == "ocultar"){
			$sql = "UPDATE assunto SET ocultar = 'sim' WHERE idAssunto = $idAssunto";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "O assunto foi ocultado com sucesso !";
			}
		}else if($acao == "exibir"){
			$sql = "UPDATE assunto SET ocultar = 'nao' WHERE idAssunto = $idAssunto";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "O assunto foi exibido com sucesso !";
			}
		}
	}
?>