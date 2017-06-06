<?PHP session_start(); ?>
<?PHP Require('../funcoes.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Escola de Educação Infantil Joaninha - Administração</title>
<link rel="shortcut icon" href="../_img/favicon.ico" />
<link href="_estilos/estilo.css" rel="stylesheet" type="text/css" />
<script src="../_scripts/jquery.js" type="text/javascript"></script>
<script src="../_scripts/jquery.corner.js" type="text/javascript"></script>
<script src="../_scripts/jquery.tablesorter.js" type="text/javascript"></script>
<script src="../_scripts/jquery.metadata.js" type="text/javascript"></script>
<script src="../_scripts/jquery.form.js" type="text/javascript"></script>
<script src="../_scripts/jquery.validate.js" type="text/javascript"></script>
<script src="../_scripts/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="../_scripts/jquery.maskMoney.0.2.js" type="text/javascript"></script>
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
    	<div id="logotipo"><a href="index.php"><img src="../_img/logotipo.gif" border="0" /></a></div>
        <div id="menusup">Área Administrativa</div>
        <div id="data"><?PHP echo formatarDataExtenso(time()); ?></div>
    </div>
    <div id="barraazul"><div id="menubordavazio"></div><div id="menubordasuperior"></div></div>
    <div id="content">
        <div id="menu">
        	<div>
            <?PHP
			if($_SESSION['login'] == session_id() && $_SESSION['tipoUsuario'] == "funcionario"){
				$tipoFuncionario = $_SESSION['tipoFuncionario'];
				switch($tipoFuncionario){
				case "admin":
					?><a href="contato.php">Contato</a> | <a href="assunto.php">Assunto</a> | <a href="loja.php">Loja</a> | <a href="pedido.php">Pedido</a> | <a href="cadastro.php">Cadastro</a> | <a href="turma.php">Turma</a> | <a href="tipoFuncionario.php">Funcionário</a> | <a href="agenda.php">Agenda OnLine</a> | <a href="lista.php">Lista de Materiais</a><?PHP
					break;
				case "secretaria":
					?><a href="contato.php">Contato</a> | <a href="pedido.php">Pedido</a> | <a href="cadastro.php">Cadastro</a> | <a href="agenda.php">Agenda OnLine</a> | <a href="lista.php">Lista de Materiais</a><?PHP
					break;
				case "professor":
					?><a href="agenda.php">Agenda OnLine</a><?PHP
					break;
				default:
					?><a href="agenda.php">Agenda OnLine</a><?PHP
				}
				?> | <a href="meusDados.php">Meus dados</a> | <a href="sair.php">Sair</a><?PHP
			}else{
				?>Faça o login<?PHP
			}
			?>
            </div>
            <div id="menubordainferiorfundo"><div id="menubordainferior"></div></div>
        </div>
        <div id="conteudofundo">
            <div id="conteudobordas">
                <div id="conteudo">