// JavaScript Document
$('#conteudobordas').corner();
$('#bannerbordasuperior').corner("top");
$('#bannerbordainferior').corner("bottom");

$('#caixaMsg').corner();
$('#btnCaixaMsgFechar').corner();

$(document).ready(function(){
	$('#btnCaixaMsgFecharTop').click(function(){
		fecharMsg();
	});
	$('#btnCaixaMsgFechar').click(function(){
		fecharMsg();
	});
	
	$('#fundoCaixaMsg').click(function(){fecharMsg();}); //fechar a msg quando clicar fora
	$(window).keydown(function(event){ //fechar a msg quando apertar esc
		if(event.keyCode==27)fecharMsg();
	});
});

function abrirMsg(){
	var altura = $('html')[0].scrollHeight < $(window).height() ? $(window).height() : $('html')[0].scrollHeight;
	$('#fundoCaixaMsg').width($('html')[0].scrollWidth).height(altura);
	
	$('#fundoCaixaMsg').fadeTo('slow', 0.5);
	$('#caixaMsg').fadeIn('slow');
}
function fecharMsg(){
	$('#fundoCaixaMsg').fadeOut('slow');
	$('#caixaMsg').fadeOut('slow');
	if(acaoDepoisMsgFechar == "sim"){
		acaoDepoisMsg();
		acaoDepoisMsgFechar = "nao";
	}
}

function validaCampoVazio(){
	for(i=0;i<campoForm.length;i++){
		var txtCampo = document.getElementById('txt' + campoForm[i]);
		var lblErro = document.getElementById('lblErro' + campoForm[i]);
		
		if(txtCampo.value == ""){
			lblErro.style.display = 'block';
			campoVazio++;
		}else{
			lblErro.style.display = 'none';
		}
	}
	
	for(i=0;i<campoForm.length;i++){
		var txtCampo = document.getElementById('txt' + campoForm[i]);
		
		if(txtCampo.value == ""){
			txtCampo.focus();
			return false;
		}
	}
}
function validaEmail(){
	var txtEmail = document.getElementById('txtEmail');
	var lblErroEmailInvalido = document.getElementById('lblErroEmailInvalido');
	if(txtEmail.value != ""){
		if(txtEmail.value.length < 7 || txtEmail.value.indexOf("@") < 1 || txtEmail.value.indexOf(".",txtEmail.value.indexOf("@") + 2) == -1){
			lblErroEmailInvalido.style.display = 'block';
			txtEmail.focus();
			campoVazio++;
		}else{
			lblErroEmailInvalido.style.display = 'none';
		}
	}
}
function SomenteNumero(e){
	var tecla=(window.event)?event.keyCode:e.which;
	if((tecla > 47 && tecla < 58)) return true;
	else{
	if (tecla != 8 && tecla != 13 && tecla != 45) return false;
	else return true;
	}
}

var foco;
function acaoDepoisMsg(){
	document.getElementById(foco).focus();
}
function validaSubmitLogin(){
	var txtUsuario = document.getElementById('txtUsuario');
	var txtSenha = document.getElementById('txtSenha');
	var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
	
	if(txtUsuario.value == ""){
		caixaMsgConteudo.innerHTML = "Campo usuário em branco";
		abrirMsg();
		acaoDepoisMsgFechar = "sim";
		foco = "txtUsuario";
		return false;
	}else if(txtSenha.value == ""){
		caixaMsgConteudo.innerHTML = "Campo senha em branco";
		abrirMsg();
		acaoDepoisMsgFechar = "sim";
		foco = "txtSenha";
		return false;
	}else{
		jQuery.ajax({
		type: 'POST',
		url: 'login.php',
		data: jQuery('form').serialize(),
		success: function(msg){
			if(msg == 'Usuário e/ou Senha incorretos<br />Tente novamente'){
				caixaMsgConteudo.innerHTML = msg;
				abrirMsg();
				acaoDepoisMsgFechar = "sim";
				foco = "txtUsuario";
			}else{
				document.location.reload(true); //atualizar a página para carregar o menu da área restrita.
			}
		}
		});
		return false;
	}
}
function imprimirPedido(id){
	window.open('imprimirPedido.php?idPedido='+id,'','width=620,toolbar=yes,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no');
}