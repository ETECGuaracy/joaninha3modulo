<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginSecretaria.php');
	
	Require('conecta.php');
	
	$txtNomeUsuario = trim($_POST['txtNomeUsuario']);
	$tipoCadastro = $_POST['txtTipoCadastro'];
	
	if($txtNomeUsuario == ""){
		echo "o campo nome de usuário está em branco";
	}else{
		if($tipoCadastro != "aluno" && $tipoCadastro != "funcionario"){
			echo "Houve um erro. Por favor tente mais tarde.";
		}else{
			$sql = "SELECT * FROM $tipoCadastro WHERE usuario = '$txtNomeUsuario'";
			
			if (!mysql_query($sql)){
				echo "Houve um erro. Por favor tente mais tarde.";
			}else{
				$selecao = mysql_query($sql);
				$linhas = mysql_num_rows($selecao);
				
				if($linhas == 0){
					echo "<font color='green'>usuário disponível !</font>";
				}else{
					echo "este usuário já existe, por favor escolha outro";
				}
			}
		}
	}
?>