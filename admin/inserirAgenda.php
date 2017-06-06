<?PHP
	Require('verificaLogin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
<?PHP
	$sql = "SELECT * FROM turma";
	$selecao = mysql_query($sql);
	
	while($registro = mysql_fetch_assoc($selecao)){
		$turmaCompleto[$registro['idTurma']] = $registro['turma'];
	}
?>
	<script>
	function validaSubmitAgenda(){
		erro = 0;
		
		//a validação está ocorrendo ao contrário por causa do foco dos campos
		validaCampoVazio('Texto');
		validaCampoVazio('Titulo');
		if(tipoDestinatario == ""){
			document.getElementById('lblErroDestinatario').style.display = 'block';
		}else if(tipoDestinatario == "turma"){
			document.getElementById('lblErroDestinatario').style.display = 'none';
			validaCampoVazio('Turma');
		}else if(tipoDestinatario == "aluno"){
			document.getElementById('lblErroDestinatario').style.display = 'none';
			validaCampoVazio('Aluno');
		}
		
		if(erro == 0){
			jQuery.ajax({
			type: 'POST',
			url: 'inserirAgendaConfirma.php',
			data: jQuery('form').serialize(),
			success: function(msg){
				if(msg == "Evento adicionado com sucesso!"){
					acaoDepoisMsgFechar = "sim";
				}
				document.getElementById('caixaMsgConteudo').innerHTML = msg;
				abrirMsg();
			}
			});
			return false;
		}else{
			return false;
		}
	}
	function acaoDepoisMsg(){
		window.location = 'agenda.php';
	}
	function validaCampoVazio(campo){
		var txtCampo = document.getElementById('txt' + campo);
		var erroCampo = document.getElementById('lblErro' + campo);
		if(txtCampo.value == ""){
			erroCampo.style.display = 'block';
			txtCampo.focus();
			erro++;
		}else{
			erroCampo.style.display = 'none';
		}
	}
	var tipoDestinatario = "";
	$(document).ready(function(){
		jQuery('#lblParaAlunoClick').click(function() {
			tipoDestinatario = "aluno";
			document.getElementById('divAlunoLista').style.display = 'block';
			document.getElementById('divTurmaLista').style.display = 'none';
			document.getElementById('lblParaEscolhaOpcao').style.display = 'none';
		});
		jQuery('#lblParaTurmaClick').click(function() {
			tipoDestinatario = "turma";
			document.getElementById('divAlunoLista').style.display = 'none';
			document.getElementById('divTurmaLista').style.display = 'block';
			document.getElementById('lblParaEscolhaOpcao').style.display = 'none';
		});
		
		document.getElementById('divAlunoLista').style.display = 'none';
		document.getElementById('divTurmaLista').style.display = 'none';
	});
	</script>
	<style>
	#txtTexto{
		height:200px;
		width:400px;
	}
	#txtTitulo{
		width:400px;
	}
	</style>
    <p class="titulo">Inserir novo evento da Agenda OnLine</p>
    <p>Preencha este formulário para enviar uma mensagem aos pais do aluno ou da turma</p>
    <form action="inserirAgendaConfirma.php" method="post" name="frmAgenda" id="frmAgenda" onSubmit="return validaSubmitAgenda()">
    	<table>
            <tr>
                <td class="tituloTblDireita" width="170">Para:</td>
                <td>
                    <div id="lblParaEscolhaOpcao">
                    	<label id="lblParaAlunoClick" class="cursorPointer"><strong>1 aluno</strong></label> | <label id="lblParaTurmaClick" class="cursorPointer"><strong>Uma Turma (todos os alunos da turma)</strong></label>
                        <div id="lblErroDestinatario" class="msgErro">escolha um destinatário</div>
                    </div>
                    <div id="divAlunoLista">
                    	<select name="txtAluno" id="txtAluno">
                        <option value="" selected="selected">Aluno</option>
                        <?PHP
                            $sql = "SELECT * FROM aluno WHERE ocultar = 'nao' ORDER BY nome";
                            $selecao = mysql_query($sql);
                            
                            while($registro = mysql_fetch_assoc($selecao)){
                                ?>
                                <option value="<?PHP echo $registro['idAluno']; ?>"><?PHP echo $registro['nome']; ?> (<?PHP echo $turmaCompleto[$registro['idTurma']]; ?>)</option>
                                <?PHP
                            }
                        ?>
                        </select>
                        <div id="lblErroAluno" class="msgErro">o campo aluno não está selecionado</div>
                    </div>
                    <div id="divTurmaLista">
                        <select name="txtTurma" id="txtTurma">
                        <option value="" selected="selected">Turma</option>
                        <?PHP
                            $sql = "SELECT * FROM turma WHERE ocultar = 'nao' ORDER BY turma";
                            $selecao = mysql_query($sql);
                            
                            while($registro = mysql_fetch_assoc($selecao)){
                                ?>
                                <option value="<?PHP echo $registro['idTurma']; ?>"><?PHP echo $registro['turma']; ?></option>
                                <?PHP
                            }
                        ?>
                        </select>
                        <div id="lblErroTurma" class="msgErro">o campo turma não está selecionado</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tituloTblDireita">Título / Assunto:</td>
                <td>
                	<input type="text" name="txtTitulo" id="txtTitulo" maxlength="50" />
                    <div id="lblErroTitulo" class="msgErro">o campo título / assunto está em branco</div>
                </td>
            </tr>
            <tr>
                <td class="tituloTblDireita">Conteúdo / Mensagem:</td>
                <td>
                	<textarea name="txtTexto" id="txtTexto"></textarea>
                    <div id="lblErroTexto" class="msgErro">o campo conteúdo / mensagem está em branco</div>
                </td>
            </tr>
            <tr>
                <td class="tituloTblDireita">&nbsp;</td>
                <td><input type="submit" name="btnSubmit" value="Enviar" /></td>
            </tr>
        </table>
    </form>
<?PHP
	Require('footer.php');
?>