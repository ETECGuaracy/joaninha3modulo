<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario"){
		header('location: index.php');
	}else{
		if($_SESSION['tipoFuncionario'] != "admin" && $_SESSION['tipoFuncionario'] != "secretaria"){
			header('location: index.php');
		}else{
			Require('conecta.php');
			
			#Declarando as variáveis
			$txtNomeUsuario = trim($_POST['txtNomeUsuario']);
			$txtSenhaCadastro = trim($_POST['txtSenhaCadastro']);
			$txtSenhaConfirmaCadastro = trim($_POST['txtSenhaConfirmaCadastro']);
			$txtTurma = trim($_POST['txtTurma']);
			$txtTipoFuncionario = trim($_POST['txtTipoFuncionario']);
			$txtNome = trim($_POST['txtNome']);
			$txtSexo = trim($_POST['txtSexo']);
			$txtCPF = trim($_POST['txtCPF']);
			$txtEmail = trim($_POST['txtEmail']);
			$txtDataNascimento = trim($_POST['txtDataNascimento']);
			$txtTelefone = trim($_POST['txtTelefone']);
			$txtCelular = trim($_POST['txtCelular']);
			$txtEndereco = trim($_POST['txtEndereco']);
			$txtEnderecoNumero = trim($_POST['txtEnderecoNumero']);
			$txtEnderecoComplemento = trim($_POST['txtEnderecoComplemento']);
			$txtCEP = trim($_POST['txtCEP']);
			$txtCidade = trim($_POST['txtCidade']);
			$txtUF = trim($_POST['txtUF']);
			$txtNomePai = trim($_POST['txtNomePai']);
			$txtNomeMae = trim($_POST['txtNomeMae']);
			$txtResponsavel = trim($_POST['txtResponsavel']);
			$txtTipoCadastro = trim($_POST['txtTipoCadastro']);
			
			if($txtTipoCadastro == "aluno"){
				if($txtNomeUsuario == "" || $txtSenhaCadastro == "" || $txtSenhaConfirmaCadastro == "" || $txtTurma == "" || $txtNome == "" || $txtSexo == "" || $txtCPF == "" || $txtEmail == "" || $txtDataNascimento == "" || $txtTelefone == "" || $txtEndereco == "" || $txtEnderecoNumero == "" || $txtCEP == "" || $txtCidade == "" || $txtUF == "" || $txtNomeMae == "" || $txtNomePai == "" || $txtResponsavel == ""){
					echo "Existem campos em branco!<br />Tente novamente.";
				}else{
					verificaExisteUsuario();
				}
				
			}else if($txtTipoCadastro == "funcionario"){
				if($txtNomeUsuario == "" || $txtSenhaCadastro == "" || $txtSenhaConfirmaCadastro == "" || $txtTipoFuncionario == "" || $txtNome == "" || $txtSexo == "" || $txtCPF == "" || $txtEmail == "" || $txtDataNascimento == "" || $txtTelefone == "" || $txtEndereco == "" || $txtEnderecoNumero == "" || $txtCEP == "" || $txtCidade == "" || $txtUF == ""){
					echo "Existem campos em branco!<br />Tente novamente.";
				}else{
					verificaExisteUsuario();
				}
			}else{
				echo "O tipo de cadastro não está correto.";
			}
		}
	}
	
	function verificaExisteUsuario(){
		global $txtTipoCadastro, $txtNomeUsuario;
		
		if($txtTipoCadastro == "aluno"){
			$sql = "SELECT * FROM aluno WHERE usuario = '$txtNomeUsuario'";
		}else if($txtTipoCadastro == "funcionario"){
			$sql = "SELECT * FROM funcionario WHERE usuario = '$txtNomeUsuario'";
		}
		
		if (!mysql_query($sql)){
			echo "Houve um erro!<br />Tente novamente mais tarde.";
		}else{
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				verificaExisteEmail();
			}else{
				echo "Este nome de usuário já existe!<br />Tente novamente.";
			}
		}
	}
	
	function verificaExisteEmail(){
		global $txtTipoCadastro, $txtEmail;
		
		if($txtTipoCadastro == "aluno"){
			$sql = "SELECT * FROM aluno WHERE email = '$txtEmail'";
		}else if($txtTipoCadastro == "funcionario"){
			$sql = "SELECT * FROM funcionario WHERE email = '$txtEmail'";
		}
		
		if (!mysql_query($sql)){
			echo "Houve um erro!<br />Tente novamente mais tarde.";
		}else{
			$selecao = mysql_query($sql);
			$linhas = mysql_num_rows($selecao);
			
			if($linhas == 0){
				verificaSenhaIgual();
			}else{
				echo "Este email já existe em nosso cadastro!<br />Tente novamente.";
			}
		}
	}
	
	function verificaSenhaIgual(){
		global $txtSenhaCadastro, $txtSenhaConfirmaCadastro;
		
		if($txtSenhaCadastro == $txtSenhaConfirmaCadastro){
			inserirNoBanco();
		}else{
			echo "O campo senha e campo confirma senha estão diferentes!<br />Tente novamente.";
		}
	}
	
	function inserirNoBanco(){
		global $txtTipoCadastro, $txtNomeUsuario, $txtSenhaCadastro, $txtTurma, $txtTipoFuncionario, $txtNome, $txtSexo, $txtCPF, $txtEmail, $txtDataNascimento, $txtEndereco, $txtEnderecoNumero, $txtEnderecoComplemento, $txtCEP, $txtCidade, $txtUF, $txtTelefone, $txtCelular, $txtNomeMae, $txtNomePai, $txtResponsavel;
		
		if($txtTipoCadastro == "aluno"){
			$sql = "INSERT INTO aluno (usuario, senha, idTurma, nome, sexo, CPF, email, dataNasc, endereco, numero, complemento, CEP, cidade, UF, telefone, celular, nomeMae, nomePai, responsavel, ocultar) VALUES ('$txtNomeUsuario', '$txtSenhaCadastro', '$txtTurma', '$txtNome', '$txtSexo', '$txtCPF', '$txtEmail', '$txtDataNascimento', '$txtEndereco', '$txtEnderecoNumero', '$txtEnderecoComplemento', '$txtCEP', '$txtCidade', '$txtUF', '$txtTelefone', '$txtCelular', '$txtNomeMae', '$txtNomePai', '$txtResponsavel', 'nao')";
		}else if($txtTipoCadastro == "funcionario"){
			$sql = "INSERT INTO funcionario (usuario, senha, idTipo, nome, sexo, CPF, email, dataNasc, endereco, numero, complemento, CEP, cidade, UF, telefone, celular, ocultar) VALUES ('$txtNomeUsuario', '$txtSenhaCadastro', '$txtTipoFuncionario', '$txtNome', '$txtSexo', '$txtCPF', '$txtEmail', '$txtDataNascimento', '$txtEndereco', '$txtEnderecoNumero', '$txtEnderecoComplemento', '$txtCEP', '$txtCidade', '$txtUF', '$txtTelefone', '$txtCelular', 'nao')";
		}
		
		if (!mysql_query($sql)){
			echo "Houve um erro e o cadastro não foi adicionado!<br />Tente novamente mais tarde.";
		}else{
			echo "Cadastro adicionado com sucesso!";
		}
	}
?>