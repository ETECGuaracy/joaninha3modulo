<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$idTipo = $_GET['idTipo'];
		$acao = $_GET['acao'];
		
		if($acao == ""){
			$txtEditarTipoFuncionario = trim($_POST['txtEditarTipoFuncionario']);
			
			if($txtEditarTipoFuncionario == ""){
				echo "Existem campos em branco<br />Tente novamente";
			}else{
				$idTipo = $_POST['txtIdTipo'];
				
				$sql = "SELECT * FROM tipofuncionario WHERE tipo = '$txtEditarTipoFuncionario'";
				
				if (!mysql_query($sql)){
					$mensagem = "Houve um erro!<br />Tente novamente mais tarde.";
				}else{
					$selecao = mysql_query($sql);
					$linhas = mysql_num_rows($selecao);
					
					if($linhas == 0){
						$sql = "UPDATE tipofuncionario SET tipo = '$txtEditarTipoFuncionario' WHERE idTipo = $idTipo";
						if (!mysql_query($sql)){
							echo "Houve um erro e o tipo de funcionário não foi atualizado!<br />Tente novamente mais tarde.";
						}else{
							echo "Tipo de funcionário atualizado com sucesso!";
						}
					}else{
						echo "Este tipo de funcionário já existe!<br />Tente novamente.";
					}
				}
			}
		}else if($acao == "ocultar"){
			$sql = "UPDATE tipofuncionario SET ocultar = 'sim' WHERE idTipo = $idTipo";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "O tipo de funcionário foi ocultado com sucesso !";
			}
		}else if($acao == "exibir"){
			$sql = "UPDATE tipofuncionario SET ocultar = 'nao' WHERE idTipo = $idTipo";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "O tipo de funcionário foi exibido com sucesso !";
			}
		}
	}
?>