<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$idProduto = $_GET['idProduto'];
		$acao = $_GET['acao'];
		
		if($acao == ""){
			$txtEditarProduto = trim($_POST['txtEditarProduto']);
			
			if($txtEditarProduto == ""){
				echo "Existem campos em branco<br />Tente novamente";
			}else{
				$idProduto = $_POST['txtIdProduto'];
				
				$sql = "SELECT * FROM listaproduto WHERE produto = '$txtEditarProduto' AND idProduto <> $idProduto";
				
				if (!mysql_query($sql)){
					$mensagem = "Houve um erro!<br />Tente novamente mais tarde.";
				}else{
					$selecao = mysql_query($sql);
					$linhas = mysql_num_rows($selecao);
					
					if($linhas == 0){
						$sql = "UPDATE listaproduto SET produto = '$txtEditarProduto' WHERE idProduto = $idProduto";
						if (!mysql_query($sql)){
							echo "Houve um erro e o produto não foi atualizado!<br />Tente novamente mais tarde.";
						}else{
							echo "Produto atualizado com sucesso!";
						}
					}else{
						echo "Este produto já existe!<br />Tente novamente.";
					}
				}
			}
		}else if($acao == "ocultar"){
			$sql = "UPDATE listaproduto SET ocultar = 'sim' WHERE idProduto = $idProduto";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "O produto foi ocultado com sucesso !";
			}
		}else if($acao == "exibir"){
			$sql = "UPDATE listaproduto SET ocultar = 'nao' WHERE idProduto = $idProduto";
			if (!mysql_query($sql)){
				echo "Houve um erro!<br />Tente novamente mais tarde.";
			}else{
				echo "O produto foi exibido com sucesso !";
			}
		}
	}
?>