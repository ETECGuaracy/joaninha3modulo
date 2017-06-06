<?PHP
	Require('conecta.php');
	
	#coloca as informações passadas via POST nas variáveis
	$nome = trim($_POST['txtNome']);
	$email = trim($_POST['txtEmail']);
	$telefone = trim($_POST['txtTelefone']);
	$idAssunto = trim($_POST['txtAssunto']);
	$mensagem = trim($_POST['txtMensagem']);
	$data = time();
	
	if($nome == "" || $email == "" || $telefone == "" || $idAssunto == "" || $mensagem == ""){ #verifica se os campos estão em branco
		echo "Existem campos em branco<br />Tente novamente";
	}else{
		$sql = "INSERT INTO contato (nome, email, telefone, idAssunto, mensagem, dataEnvio, dataLeitura, resolvido) VALUES ('$nome', '$email', '$telefone', '$idAssunto', '$mensagem', '$data', '0', 'nao')"; #insere o contato no banco
		if (!mysql_query($sql)){
			echo "Houve um erro e sua mensagem não pode ser enviada!<br />Tente novamente mais tarde ou entre em contato através do telefone da escola.";
		}else{
			echo "Mensagem enviada com sucesso!<br />Aguarde uma resposta em seu e-mail.";
		}
	}
?>