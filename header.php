<?PHP session_start(); ?>
<?PHP Require('funcoes.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Escola de Educação Infantil Joaninha</title>
<link rel="shortcut icon" href="_img/favicon.ico" />
<link href="_estilos/estilo.css" rel="stylesheet" type="text/css" />
<script src="_scripts/jquery.js" type="text/javascript"></script>
<script src="_scripts/jquery.corner.js" type="text/javascript"></script>
<script src="_scripts/jquery.tablesorter.js" type="text/javascript"></script>
<script src="_scripts/jquery.metadata.js" type="text/javascript"></script>
<script src="_scripts/jquery.form.js" type="text/javascript"></script>
<script src="_scripts/jquery.validate.js" type="text/javascript"></script>
<script src="_scripts/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="_scripts/swfobject_modified.js" type="text/javascript"></script>
<script src="_scripts/js.js" type="text/javascript"></script>
</head>

<body>
<div id="fundoCaixaMsg"></div>
<div id="caixaMsg">
    <div id="btnCaixaMsgFecharTop">[x]</div>
    <div id="caixaMsgConteudo"></div>
    <div id="btnCaixaMsgFechar">fechar</div>
</div>
<div id="main">
	<div id="header">
    	<div id="logotipo"><a href="index.php"><img src="_img/logotipo.gif" border="0" /></a></div>
        <div id="menusup">
        	<div id="contato"><a href="contato.php" class="linkmenusup">Contato</a></div>
        	<div id="localizacao"><a href="localizacao.php" class="linkmenusup">Localização</a></div>
            <?PHP
			if($_SESSION['login'] == session_id() && $_SESSION['tipoUsuario'] == "aluno"){
				
				Require('conecta.php');
				
				#pega as informações do aluno (que está logado)
				$sql = "SELECT * FROM aluno INNER JOIN turma ON aluno.idTurma = turma.idTurma WHERE idAluno = " . $_SESSION['idAluno'];
				
				if (!mysql_query($sql)){
					$msg = "Houve um erro";
				}else{
					$selecao = mysql_query($sql);
					$linhas = mysql_num_rows($selecao);
					$registro = mysql_fetch_assoc($selecao);
					
					if($linhas == 1){
						$nome =  $registro['nome'];
						$idTurma = $registro['idTurma'];
						$nomeTurma = $registro['turma'];
						
						$msg = "Nome: " . $nome . "<br />Turma: " . $nomeTurma;
					}else{
						$msg = "Houve um erro";
					}
				}
			?>
			<div id="areamenulogin">
				 <div id="linkMenu"><?PHP echo $msg; ?></div>
				 <div id="linkSair"><a href="sair.php">Sair</a></div>
			</div>
			<div id="areaagendaonline">
				<label id="agendaonline"><a href="agendaOnline.php">Agenda OnLine</a> | <a href="lista.php">Lista de Materiais</a> | <a href="meusPedidos.php">Pedidos</a> | <a href="carrinho.php">Carrinho</a></label>
				<label id="meusdados"><a href="meusDados.php">Meus dados</a></label>
			</div>
			<?PHP
			}else{
			?>
            <div id="arealogin">
                <form action="login.php" method="post" name="frmLogin" onsubmit="return validaSubmitLogin()">
                Usuário <input type="text" name="txtUsuario" id="txtUsuario" size="12" />
                Senha <input type="password" name="txtSenha" id="txtSenha" size="12" />
                <input type="submit" name="btnSubmitLogin" id="btnSubmitLogin" value="OK" />
                </form>
            </div>
            <div id="areaagendaonline">
                <label id="agendaonline">Agenda OnLine</label>
                <label id="esqueceusenha">Clique <a href="esqueceuSenha.php" class="linkmenusup"><strong>aqui</strong></a> se esqueceu a sua senha</label>
            </div>
            <?PHP
			};
			?>
        </div>
        <div id="data"><?PHP echo formatarDataExtenso(time()); ?></div>
    </div>
    <div id="barraazul"><div id="bannerbordavazio"></div><div id="bannerbordasuperior"></div></div>
    <div id="content">
        <div id="banner">
        	<?PHP Require('banner.php'); ?>
            <div id="bannerbordainferiorfundo"><div id="bannerbordainferior"></div></div>
        </div>
        <div id="conteudofundo">
            <div id="conteudobordas">
                <div id="conteudo">