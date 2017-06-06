<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginAdmin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
	<script>
	$(document).ready(function(){
		$("#txtValor").maskMoney({symbol:"R$",decimal:",",thousands:"."})
	});
	function validaSubmitLoja(){
		campoForm = new Array();
		campoForm[0] = "NomeProduto";
		campoForm[1] = "Descricao";
		campoForm[2] = "Valor";
		campoForm[3] = "Img";
		
		campoVazio = 0;
		validaCampoVazio();
		
		if(campoVazio == 0){
			return true;
		}else{
			return false;
		}
	}
	</script>
	<style>
	#txtNomeProduto{
		width:400px;
	}
	#txtDescricao{
		height:200px;
		width:400px;
	}
	#txtValor{
		width:100px;
	}
	#txtImg{
		width:400px;
	}
	</style>
    <p class="titulo">Inserir novo produto na Loja Virtual</p>
    <form action="inserirLojaConfirma.php" method="post" enctype="multipart/form-data" name="frmLoja" id="frmLoja" onSubmit="return validaSubmitLoja()">
    	<table>
            <tr>
                <td class="tituloTblDireita">Nome do produto:</td>
                <td>
                	<input type="text" name="txtNomeProduto" id="txtNomeProduto" maxlength="50" />
                    <div id="lblErroNomeProduto" class="msgErro">o campo nome do produto está em branco</div>
                </td>
            </tr>
            <tr>
                <td class="tituloTblDireita">Descrição:</td>
                <td>
                	<textarea name="txtDescricao" id="txtDescricao"></textarea>
                    <div id="lblErroDescricao" class="msgErro">o campo descrição está em branco</div>
                </td>
            </tr>
            <tr>
                <td class="tituloTblDireita">Valor / Preço:</td>
                <td>
                	<input type="text" name="txtValor" id="txtValor" maxlength="10" />
                    <div id="lblErroValor" class="msgErro">o campo valor / preço está em branco</div>
                </td>
            </tr>
            <tr>
                <td class="tituloTblDireita">Imagem / Foto:</td>
                <td>
                	<label for="txtImg"></label>
                    <input type="file" name="txtImg" id="txtImg" />
                    <div id="lblErroImg" class="msgErro">o campo imagem está em branco</div>
                </td>
            </tr>
            <tr>
                <td class="tituloTblDireita">&nbsp;</td>
                <td><input type="submit" name="btnSubmit" value="Inserir" /></td>
            </tr>
        </table>
    </form>
<?PHP
	Require('footer.php');
?>