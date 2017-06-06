<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		Require('conecta.php');	
		
		$idFuncionario = $_SESSION['idFuncionario'];
		$senhaAtual = trim($_POST['txtSenhaAtual']);
		$senhaNova = trim($_POST['txtSenhaNova']);
		$senhaNovaConfirma = trim($_POST['txtSenhaNovaConfirma']);
		
		if($senhaAtual == "" || $senhaNova == "" || $senhaNovaConfirma == ""){
			echo "Existem campos em branco!<br />Tente novamente.";
		}else{
			$sql = "SELECT * FROM funcionario WHERE idFuncionario = $idFuncionario AND senha = '$senhaAtual'";
			
			if(!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				if($linhas == 1){
					if($senhaNova == $senhaNovaConfirma){
						$sql = "UPDATE funcionario SET senha = '$senhaNova' WHERE idFuncionario = $idFuncionario";
						
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