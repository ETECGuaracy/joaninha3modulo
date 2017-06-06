<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('header.php');
		
		Require('conecta.php');
		
		Require('redimensionarImagem.php');
		
		?><p class="titulo">Inserindo um novo produto na Loja Virtual</p>
        <p><strong>Mensagem:</strong> <?PHP
		
		$txtNomeProduto = trim($_POST['txtNomeProduto']);
		$txtDescricao = trim($_POST['txtDescricao']);
		$txtValor = trim($_POST['txtValor']);
		$txtImg = $_FILES["txtImg"]["name"];
		$data = time();
		
		if($txtNomeProduto == "" || $txtDescricao == "" || $txtValor == "" || $txtImg == ""){
			echo "Existem campos em branco.";
		}else{
			verificaExisteProduto();
		}
		
		?></p>
		<p><a href="loja.php">Ver produtos cadastrados</a><?PHP
		
		Require('footer.php');
	}
	
	function verificaExisteProduto(){
		global $txtNomeProduto;
		
		$sql = "SELECT * FROM lojaproduto WHERE nome = '$txtNomeProduto'";
		
		if (!mysql_query($sql)){
			echo "Houve um erro!";
		}else{
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				salvarImagem();
			}else{
				echo "O produto '$txtNomeProduto' já existe na loja. Verifique se ele já não foi cadastrado e caso contrário, defina um outro nome para este produto.";
			}
		}
	}
	
	function salvarImagem(){
		global $idProdutoAdicionado, $caminhoImg, $novoNomeImg;
		
		if ((($_FILES["txtImg"]["type"] == "image/gif") || ($_FILES["txtImg"]["type"] == "image/jpeg") || ($_FILES["txtImg"]["type"] == "image/pjpeg"))){
			if ($_FILES["txtImg"]["error"] > 0){
				echo "Erro: " . $_FILES["txtImg"]["error"];
			}else{
				inserirNoBanco();
				
				$novoNomeImg = $idProdutoAdicionado . "." . end(explode(".", strtolower($_FILES["txtImg"]["name"])));
				$caminhoImg = "../loja/imgOriginal/" . $novoNomeImg;
				
				if (file_exists($caminhoImg)){
					echo "Houve um erro e a imagem do produto não pode ser salva.";
				}else{
					move_uploaded_file($_FILES["txtImg"]["tmp_name"], $caminhoImg);
				}
				
				$sql = "UPDATE lojaproduto SET img = '$novoNomeImg' WHERE idProduto = $idProdutoAdicionado";
				if (!mysql_query($sql)){
					echo "Houve um erro e o produto foi adicionado sem a imagem enviada.";
				}else{
					#a imagem foi salva e agora iremos redimensioná-la.
					if(redimensionarImagem()){
						echo "Produto adicionado com sucesso!";
					}else{
						echo "O produto foi adicionado mas a imagem não pode ser salva.";
					}
				}
			}
		}else{
			echo "Envie a foto no formato .jpg (JPEG)";
		}
	}
	
	function inserirNoBanco(){
		global $txtNomeProduto, $txtDescricao, $txtValor, $txtImg, $data, $idProdutoAdicionado;
		
		$sql = "INSERT INTO lojaproduto (nome, descricao, valor, img, dataInserido, ocultar) VALUES ('$txtNomeProduto', '$txtDescricao', '$txtValor', '$txtImg', '$data', 'nao')";
		
		if (!mysql_query($sql)){
			echo "Houve um erro e o produto não foi adicionado!";
		}else{
			$idProdutoAdicionado = mysql_insert_id();
		}
	}
?>