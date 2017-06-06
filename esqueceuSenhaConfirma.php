<?PHP
	Require('conecta.php');
	
	#coloca as informações passadas via POST nas variáveis
	$txtNomeUsuario = trim($_POST['txtNomeUsuario']);
	$txtEmail = trim($_POST['txtEmail']);
	$txtDataNascimento = trim($_POST['txtDataNascimento']);
	
	if($txtNomeUsuario == "" || $txtEmail == "" || $txtDataNascimento == ""){ #verifica se as variáveis estão em branco
		echo "Existem campos em branco<br />Tente novamente";
	}else{
		$sql = "SELECT * FROM aluno WHERE usuario = '$txtNomeUsuario' AND email = '$txtEmail' AND dataNasc = '$txtDataNascimento' AND ocultar = 'nao'";
		
		if (!mysql_query($sql)){
			echo "Houve um erro!<br />Tente novamente mais tarde.";
		}else{
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 1){
				echo "Um link foi enviado ao seu e-mail.<br />Acesse-o e crie uma nova senha.";
			}else{
				echo "As informações digitadas estão incorretas.<br />Tente novamente.";
			}
		}
	}
?>