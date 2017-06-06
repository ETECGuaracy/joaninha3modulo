<?PHP
	Require('header.php');
?>
<script>
$('#caixaMsg').css({'position':'absolute', 'width':'830px', 'height':'690px', 'margin-left':'-415px', 'margin-top':'-345px'});
$('#caixaMsgConteudo').css({'width':'830px', 'height':'630px'});

document.getElementById('caixaMsgConteudo').innerHTML = '<iframe src="pageflip/default.php" height="630" width="830" frameborder="0"></iframe>';

acaoDepoisMsgFechar = "nao";
abrirMsg();
</script>
<p class="titulo">Álbum de Fotos</p>
<p><a href="javascript:void(0);" onclick="abrirMsg();">Clique aqui para abrir o álbum de fotos</a></p>
<?PHP
	Require('footer.php');
?>