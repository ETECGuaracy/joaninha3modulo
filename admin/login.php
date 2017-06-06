<?PHP
	session_start();
	
	Require('conecta.php');
	
	$usuario = trim($_POST['txtUsuario']);
	$senha = trim($_POST['txtSenha']);
	
	#proteção contra SQL Injection
	$usuario = addslashes($usuario);
	$senha = addslashes($senha);
	
	$sql = "SELECT * FROM funcionario WHERE usuario = '$usuario' AND senha = '$senha' AND ocultar = 'nao'";
	
	$selecao = mysql_query($sql);
	$linhas = mysql_num_rows($selecao);
	
	if($linhas == 1){
		session_destroy(); #destruindo a sessão caso já esteja logado
		session_start();
		
		$_SESSION['login'] = session_id(); #declarando um variável de sessão
		while($registro = mysql_fetch_assoc($selecao)){
			$_SESSION['idFuncionario'] = $registro['idFuncionario'];
			$_SESSION['tipoUsuario'] = "funcionario";
			$idTipo = $registro['idTipo'];
		}
		
		$sql = "SELECT * FROM tipofuncionario WHERE idTipo = $idTipo";
		$selecao = mysql_query($sql);
		while($registro = mysql_fetch_assoc($selecao)){
			$tipoUsuario = strtolower($registro['tipo']);
			switch($tipoUsuario){
				case "administrador":
					$_SESSION['tipoFuncionario'] = "admin";
					break;
				case "secretaria":
					$_SESSION['tipoFuncionario'] = "secretaria";
					break;
				case "professor":
					$_SESSION['tipoFuncionario'] = "professor";
					break;
			}
		}
		
		header('location: index.php');
	}else{
		?>Usuário e/ou Senha incorretos<br />Tente novamente<?PHP
	}
?>