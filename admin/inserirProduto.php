<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		$txtProduto = trim($_POST['txtProduto']);
		
		if($txtProduto == ""){
			echo "Existem campos em branco<br />Tente novamente";
		}else{
			$sql = "SELECT * FROM listaproduto WHERE produto = '$txtProduto'";
		
			if (!mysql_query($sql)){
				echo "Houve um erro e o produto não foi adicionado!<br />Tente novamente mais tarde.";
			}else{
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				if($linhas == 0){
					$sql = "INSERT INTO listaproduto (produto, ocultar) VALUES ('$txtProduto', 'nao')";
					if (!mysql_query($sql)){
						echo "Houve um erro e o produto não foi adicionado!<br />Tente novamente mais tarde.";
					}else{
						echo "Produto adicionado com sucesso!";
					}
				}else{
					echo "Este produto já existe!<br />Tente novamente.";
				}
			}
		}
	}
?>