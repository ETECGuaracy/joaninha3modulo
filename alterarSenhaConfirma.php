<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno"){ #verifica se o usuário está logado no sistema
		header('location: index.php');
	}else{
		Require('conecta.php');	
		
		#coloca as senhas passadas via POST para as variáveis
		$idAluno = $_SESSION['idAluno'];
		$senhaAtual = trim($_POST['txtSenhaAtual']);
		$senhaNova = trim($_POST['txtSenhaNova']);
		$senhaNovaConfirma = trim($_POST['txtSenhaNovaConfirma']);
		
		if($senhaAtual == "" || $senhaNova == "" || $senhaNovaConfirma == ""){ #faz a validação de campos em branco
			echo "Existem campos em branco!<br />Tente novamente.";
		}else{
			$sql = "SELECT * FROM aluno WHERE idAluno = $idAluno AND senha = '$senhaAtual'"; #verifica se a senha atual está correta
			
			if(!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				if($linhas == 1){
					if($senhaNova == $senhaNovaConfirma){
						$sql = "UPDATE aluno SET senha = '$senhaNova' WHERE idAluno = $idAluno"; # altera a senha
						
						if(!mysql_query($sql)){
							echo "Houve um erro!<br />Tente novamente mais tarde.";
						}else{
							echo "Senha alterada com sucesso!";
						}
					}else{
						echo "O campo nova senha e campo confirma nova senha estão diferentes<br />Tente novamente";
					}
				}else{
					echo "Senha atual incorreta<br />Tente novamente";
				}
			}
		}
	}
?>