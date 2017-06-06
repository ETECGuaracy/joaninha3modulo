<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria"){
			header('location: index.php');
		}else{
			Require('conecta.php');
			
			$txtTurma = trim($_POST['txtTurma']);
			$txtProduto = trim($_POST['txtProduto']);
			$txtQtd = trim($_POST['txtQtd']);
			
			if($txtTurma == "" || $txtProduto == "" || $txtQtd == ""){
				echo "Existem campos em branco<br />Tente novamente";
			}else{
				$sql = "SELECT * FROM listaturma WHERE idTurma = '$txtTurma' AND idProduto = '$txtProduto'";
				
				if (!mysql_query($sql)){
					echo "Houve um erro e o produto não foi adicionado!<br />Tente novamente mais tarde.";
				}else{
					$selecao = mysql_query($sql);
					$linhas = mysql_num_rows($selecao);
					
					if($linhas == 0){
						$sql = "INSERT INTO listaturma (idTurma, idProduto, qtd) VALUES ('$txtTurma', '$txtProduto', '$txtQtd')";
						if (!mysql_query($sql)){
							echo "Houve um erro e o produto não foi adicionado!<br />Tente novamente mais tarde.";
						}else{
							echo "Produto adicionado com sucesso!";
						}
					}else{
						echo "Este produto já existe para esta turma!<br />Para alterar a quantidade, acesse a lista geral.";
					}
				}
			}
		}
	}
?>