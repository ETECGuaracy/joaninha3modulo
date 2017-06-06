<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria"){
			header('location: index.php');
		}else{
			Require('conecta.php');
			
			$idCadastro = $_GET['idCadastro'];
			$tipo = $_GET['tipo'];
			$acao = $_GET['acao'];
			
			if($tipo == "" || $idCadastro == ""){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				
				#pegar o id de administrador
				$sql = "SELECT * FROM tipofuncionario WHERE tipo = 'administrador'";
				$selecao = mysql_query($sql);
				$registro = mysql_fetch_assoc($selecao);
				$idDeAdministrador = $registro['idTipo'];
				
				if($acao == ""){
					echo "Houve um erro!<br />Tente novamente mais tarde.";
				}else if($acao == "ocultar"){
					if($tipo == "aluno"){
						$sql = "UPDATE aluno SET ocultar = 'sim' WHERE idAluno = $idCadastro";
					}else if($tipo == "funcionario"){
						if($_SESSION['tipoFuncionario'] != "admin" && $idCadastro == $idDeAdministrador){
							$sql = "";
						}else{
							$sql = "UPDATE funcionario SET ocultar = 'sim' WHERE idFuncionario = $idCadastro";
						}
					}
					
					if (!mysql_query($sql)){
						echo "Houve um erro!<br />Tente novamente mais tarde.";
					}else{
						echo "O cadastro foi ocultado com sucesso !";
					}
				}else if($acao == "exibir"){
					if($tipo == "aluno"){
						$sql = "UPDATE aluno SET ocultar = 'nao' WHERE idAluno = $idCadastro";
					}else if($tipo == "funcionario"){
						if($_SESSION['tipoFuncionario'] != "admin" && $idCadastro == $idDeAdministrador){
							$sql = "";
						}else{
							$sql = "UPDATE funcionario SET ocultar = 'nao' WHERE idFuncionario = $idCadastro";
						}
					}
					
					if (!mysql_query($sql)){
						echo "Houve um erro!<br />Tente novamente mais tarde.";
					}else{
						echo "O cadastro foi exibido com sucesso !";
					}
				}
			}
		}
	}
?>