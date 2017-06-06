<?PHP
	session_start();
	
	Require('conecta.php');
	
	$usuario = trim($_POST['txtUsuario']);
	$senha = trim($_POST['txtSenha']);
	
	#proteção contra SQL Injection
	$usuario = addslashes($usuario);
	$senha = addslashes($senha);
	
	$sql = "SELECT * FROM aluno WHERE usuario = '$usuario' AND senha = '$senha' AND ocultar = 'nao'"; #faz uma seleção no banco com as informações passadas e se houver um registro, o usuário e a senha estão corretos
	
	$selecao = mysql_query($sql);
	$linhas = mysql_num_rows($selecao);
	
	if($linhas == 1){
		session_destroy(); #destruindo a sessão caso já esteja logado
		session_start();
		
		$_SESSION['login'] = session_id(); #declarando um variável de sessão
		while($registro = mysql_fetch_assoc($selecao)){
			$_SESSION['idAluno'] = $registro['idAluno'];
			$_SESSION['tipoUsuario'] = "aluno";
		}
		
		header('location: index.php');
	}else{
		?>Usuário e/ou Senha incorretos<br />Tente novamente<?PHP
	}
?>