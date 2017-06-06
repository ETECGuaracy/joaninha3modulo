// JavaScript Document
$('#conteudobordas').corner();
$('#menubordasuperior').corner("top");
$('#menubordainferior').corner("bottom");

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

var acaoDepoisMsgFechar;
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