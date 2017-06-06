<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		#Passando os valores recebidos via POST para as variáveis
		$txtNome = trim($_POST['txtNome']);
		$txtSexo = trim($_POST['txtSexo']);
		$txtEmail = trim($_POST['txtEmail']);
		$txtDataNascimento = trim($_POST['txtDataNascimento']);
		$txtCPF = trim($_POST['txtCPF']);
		$txtTelefone = trim($_POST['txtTelefone']);
		$txtCelular = trim($_POST['txtCelular']);
		$txtEndereco = trim($_POST['txtEndereco']);
		$txtEnderecoNumero = trim($_POST['txtEnderecoNumero']);
		$txtEnderecoComplemento = trim($_POST['txtEnderecoComplemento']);
		$txtCEP = trim($_POST['txtCEP']);
		$txtCidade = trim($_POST['txtCidade']);
		$txtUF = trim($_POST['txtUF']);
		
		$idFuncionario = $_SESSION['idFuncionario'];
		
		if($txtNome == "" || $txtSexo == "" || $txtEmail == "" || $txtDataNascimento == "" || $txtCPF == "" || $txtTelefone == "" || $txtCelular == "" || $txtEndereco == "" || $txtEnderecoNumero == "" || $txtCEP == "" || $txtCidade == "" || $txtUF == ""){
			echo "Existem campos em branco!";
		}else{
			verificaExisteEmail();
		}
	}
	
	function verificaExisteEmail(){
		global $txtEmail, $idFuncionario;
		
		$sql = "SELECT * FROM funcionario WHERE email = '$txtEmail' AND idFuncionario <> $idFuncionario";
		
		if (!mysql_query($sql)){
			echo "Houve um erro!<br />Tente novamente mais tarde.";
		}else{
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				alterarNoBanco();
			}else{
				echo "Este email já existe em nosso sistema!<br />Tente novamente.";
			}
		}
	}
	
	function alterarNoBanco(){
		global $txtNome, $txtSexo, $txtEmail, $txtDataNascimento, $txtCPF, $txtTelefone, $txtCelular, $txtEndereco, $txtEnderecoNumero, $txtEnderecoComplemento, $txtCEP, $txtCidade, $txtUF, $idFuncionario;
		
		$sql = "UPDATE funcionario SET nome = '$txtNome', sexo = '$txtSexo', email = '$txtEmail', dataNasc = '$txtDataNascimento', CPF = '$txtCPF', telefone = '$txtTelefone', celular = '$txtCelular', endereco = '$txtEndereco', numero = '$txtEnderecoNumero', complemento = '$txtEnderecoComplemento', CEP = '$txtCEP', cidade = '$txtCidade', UF = '$txtUF' WHERE idFuncionario = $idFuncionario";
		
		if (!mysql_query($sql)){
			echo "Houve um erro e seus dados não puderam ser alterados!<br />Tente novamente mais tarde.";
		}else{
			echo "Dados alterados com sucesso!";
		}
	}
?>