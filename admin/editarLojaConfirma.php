<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		Require('redimensionarImagem.php');
		
		$acao = $_GET['acao'];
		
		if($acao == ""){
			$txtNomeProduto = trim($_POST['txtNomeProduto']);
			$txtDescricao = trim($_POST['txtDescricao']);
			$txtValor = trim($_POST['txtValor']);
			$idProduto = $_POST['idProduto'];
			
			if($txtNomeProduto == "" || $txtDescricao == "" || $txtValor == ""){
				echo "Existem campos em branco.";
			}else{
				verificaExisteProduto();
			}
		}else if($acao == "enviarImagem"){
			$idProduto = $_POST['idProduto'];
			$txtImg = $_FILES["txtImg"]["name"];
			
			enviarImagem();
		}
	}
	
	function verificaExisteProduto(){
		global $txtNomeProduto, $idProduto;
		
		$sql = "SELECT * FROM lojaproduto WHERE nome = '$txtNomeProduto' AND idProduto <> $idProduto";
		
		if (!mysql_query($sql)){
			echo "Houve um erro!";
		}else{
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				editarProduto();
			}else{
				echo "O produto '$txtNomeProduto' já existe na loja. Verifique se ele já não foi cadastrado e caso contrário, defina um outro nome para este produto.";
			}
		}
	}
	
	function enviarImagem(){
		global $idProduto, $caminhoImg, $novoNomeImg;
		if ((($_FILES["txtImg"]["type"] == "image/gif") || ($_FILES["txtImg"]["type"] == "image/jpeg") || ($_FILES["txtImg"]["type"] == "image/pjpeg"))){
			if ($_FILES["txtImg"]["error"] > 0){
				echo "Erro: " . $_FILES["txtImg"]["error"];
			}else{
				$novoNomeImg = $idProduto . "." . end(explode(".", strtolower($_FILES["txtImg"]["name"])));
				$caminhoImg = "../loja/imgOriginal/" . $novoNomeImg;
				$backupImg = "../loja/backupImgOriginal/" . $novoNomeImg;
				
				rename($caminhoImg,$backupImg); #movendo a imagem antiga para pasta backup
				
				if (file_exists($caminhoImg)){
					echo "Houve um erro e a imagem do produto não pode ser salva.";
				}else{
					move_uploaded_file($_FILES["txtImg"]["tmp_name"], $caminhoImg);
					
					$sql = "UPDATE lojaproduto SET img = '$novoNomeImg' WHERE idProduto = $idProduto";
					if (!mysql_query($sql)){
						echo "Houve um erro e a imagem não foi atualizada.";
					}else{
						#a imagem foi salva e agora iremos redimensioná-la.
						if(redimensionarImagem()){
							echo "Imagem atualizada com sucesso!";
						}else{
							echo "A imagem não pode ser salva.";
						}
					}
				}
			}
		}else{
			echo "Envie uma foto no formato .jpg (JPEG)";
		}
	}
	
	function editarProduto(){
		global $txtNomeProduto, $txtDescricao, $txtValor, $idProduto;
		
		$sql = "UPDATE lojaproduto SET nome = '$txtNomeProduto', descricao = '$txtDescricao', valor = '$txtValor' WHERE idProduto = $idProduto";
		if (!mysql_query($sql)){
			echo "Houve um erro e o produto não foi editado.";
		}else{
			echo "O produto foi editado com sucesso !";
		}
	}
?>