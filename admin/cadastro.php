<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginSecretaria.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
<?PHP
	$idCadastro = $_GET['idCadastro'];
	$tipo = $_GET['tipo'];
	
	$sql = "SELECT * FROM tipofuncionario";
	$selecao = mysql_query($sql);
	
	while($registro = mysql_fetch_assoc($selecao)){
		$tipoFuncionarioCompleto[$registro['idTipo']] = $registro['tipo'];
		if(strtolower($registro['tipo']) == "administrador"){
			$idDeAdministrador = $registro['idTipo'];
		}
	}
	
	$sql = "SELECT * FROM turma";
	$selecao = mysql_query($sql);
	
	while($registro = mysql_fetch_assoc($selecao)){
		$turma[$registro['idTurma']] = $registro['turma'];
	}
?>
    <p class="titulo">Cadastros</p>
    <?PHP
    if($idCadastro == "" || $tipo == ""){
		?>
        <script>
		$(document).ready(function(){
			$("#tblCadastroAluno").tablesorter();
			$("#tblCadastroFuncionario").tablesorter();
			
			jQuery('#lblLinkAlunos').click(function() {
				document.getElementById('divCadastroAluno').style.display = 'block';
				document.getElementById('divCadastroFuncionario').style.display = 'none';
				document.getElementById('lblLinkAlunos').style.fontWeight = 'bold';
				document.getElementById('lblLinkFuncionarios').style.fontWeight = 'normal';
			});
			jQuery('#lblLinkFuncionarios').click(function() {
				document.getElementById('divCadastroAluno').style.display = 'none';
				document.getElementById('divCadastroFuncionario').style.display = 'block';
				document.getElementById('lblLinkAlunos').style.fontWeight = 'normal';
				document.getElementById('lblLinkFuncionarios').style.fontWeight = 'bold';
			});
			
			document.getElementById('divCadastroAluno').style.display = 'block';
			document.getElementById('divCadastroFuncionario').style.display = 'none';
			document.getElementById('lblLinkAlunos').style.fontWeight = 'bold';
		});
		</script>
        <p><a href="inserirCadastro.php">Inserir um novo cadastro</a></p>
        <p><label id="lblLinkAlunos" class="cursorPointer">Alunos</label> | <label id="lblLinkFuncionarios" class="cursorPointer">Funcionários</label></p>
        <div id="divCadastroAluno">
		<table border="1" id="tblCadastroAluno" class="paddingTbl">
        	<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Turma</th>
                <th>Telefone</th>
                <th>Ocultar</th>
			</tr>
            </thead>
		<?PHP
			$sql = "SELECT * FROM aluno ORDER BY idAluno DESC";
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
				?>
				<tr onclick="window.location = '?tipo=aluno&idCadastro=<?PHP echo $registro['idAluno']; ?>';" class="cursorPointer">
					<td>
						<?PHP echo $registro['nome']; ?>
					</td>
					<td>
						<?PHP echo $registro['email']; ?>
					</td>
					<td>
						<?PHP echo $turma[$registro['idTurma']]; ?>
					</td>
					<td>
						<?PHP echo $registro['telefone']; ?>
					</td>
                    <td>
						<?PHP echo $registro['ocultar']; ?>
                    </td>
				</tr>
				<?PHP
			}
		?>
		</table>
        </div>
        <div id="divCadastroFuncionario">
        <table border="1" id="tblCadastroFuncionario" class="paddingTbl">
        	<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Tipo de Funcionário</th>
                <th>Telefone</th>
                <th>Ocultar</th>
			</tr>
            </thead>
		<?PHP
			if($_SESSION['tipoFuncionario'] == "admin"){
				$sql = "SELECT * FROM funcionario ORDER BY idFuncionario DESC";
			}else{
				$sql = "SELECT * FROM funcionario WHERE idTipo <> '$idDeAdministrador' ORDER BY idFuncionario DESC";
			}
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
				?>
				<tr onclick="window.location = '?tipo=funcionario&idCadastro=<?PHP echo $registro['idFuncionario']; ?>';" class="cursorPointer">
					<td>
						<?PHP echo $registro['nome']; ?>
					</td>
					<td>
						<?PHP echo $registro['email']; ?>
					</td>
					<td>
						<?PHP echo $tipoFuncionarioCompleto[$registro['idTipo']]; ?>
					</td>
					<td>
						<?PHP echo $registro['telefone']; ?>
					</td>
                    <td>
						<?PHP echo $registro['ocultar']; ?>
                    </td>
				</tr>
				<?PHP
			}
		?>
		</table>
        </div>
		<?PHP
	}else{
		?>
		<script>
		function ocultarCadastro(acao,tipo,id){
			if(confirm('Tem certeza de que deseja ' + acao + ' este cadastro?')){
				//window.location = 'editarCadastro.php?acao=' + acao + '&tipo=' + tipo + '&idCadastro=' + id;
				
				var caixaMsgConteudo = document.getElementById('caixaMsgConteudo');
				
				jQuery.ajax({
				url: 'editarCadastro.php?acao=' + acao + '&tipo=' + tipo + '&idCadastro=' + id,
				success: function(msg){
					caixaMsgConteudo.innerHTML = msg;
					abrirMsg();
					acaoDepoisMsgFechar = "sim";
				}
				});
			}
		}
		function acaoDepoisMsg(){
			window.location = 'cadastro.php';
		}
		</script>
		<?PHP
		if($tipo == "aluno"){
			$sql = "SELECT * FROM aluno WHERE idAluno = $idCadastro";
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			?>
			<table width="500" border="0">
			  <tr>
				<td class="tituloTblDireita" width="160">Nome de Usuário:</td>
				<td><?PHP echo $registro['usuario']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Turma:</td>
				<td><?PHP echo $turma[$registro['idTurma']]; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Nome:</td>
				<td><?PHP echo $registro['nome']; ?></td>
			  </tr>
              <tr>
				<td class="tituloTblDireita">Sexo:</td>
				<td><?PHP echo sexocompleto($registro['sexo']); ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Email:</td>
				<td><?PHP echo $registro['email']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Data de Nascimento:</td>
				<td><?PHP echo $registro['dataNasc']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Telefone:</td>
				<td><?PHP echo $registro['telefone']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Celular:</td>
				<td><?PHP echo $registro['celular']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Endereço:</td>
				<td><?PHP echo $registro['endereco']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Número:</td>
				<td><?PHP echo $registro['numero']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Complemento:</td>
				<td><?PHP echo $registro['complemento']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">CEP:</td>
				<td><?PHP echo $registro['CEP']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Cidade:</td>
				<td><?PHP echo $registro['cidade']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">UF:</td>
				<td><?PHP echo $registro['UF']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Nome da Mãe:</td>
				<td><?PHP echo $registro['nomeMae']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Nome do Pai:</td>
				<td><?PHP echo $registro['nomePai']; ?></td>
			  </tr>
              <tr>
				<td class="tituloTblDireita">Responsável:</td>
				<td><?PHP echo $registro['responsavel']; ?></td>
			  </tr>
              <tr>
				<td class="tituloTblDireita">CPF do responsável:</td>
				<td><?PHP echo $registro['CPF']; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Desativar cadastro:</td>
				<?PHP
					if($registro['ocultar'] == "sim"){
						?><td class="cursorPointer" onClick="ocultarCadastro('exibir','aluno','<?PHP echo $registro['idAluno']; ?>');">Exibir</td><?PHP
					}else{
						?><td class="cursorPointer" onClick="ocultarCadastro('ocultar','aluno','<?PHP echo $registro['idAluno']; ?>');">Ocultar</td><?PHP
					}
				?>
			  </tr>
			</table>
			<?PHP
		}else if($tipo == "funcionario"){
			$sql = "SELECT * FROM funcionario WHERE idFuncionario = $idCadastro";
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			
			if($_SESSION['tipoFuncionario'] != "admin" && $registro['idTipo'] == $idDeAdministrador){
				?><script>window.location = 'cadastro.php';</script><?PHP
			}else{
				?>
				<table width="500" border="0">
				  <tr>
					<td class="tituloTblDireita" width="160">Nome de Usuário:</td>
					<td><?PHP echo $registro['usuario']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Tipo de Funcionário:</td>
					<td><?PHP echo $tipoFuncionarioCompleto[$registro['idTipo']]; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Nome:</td>
					<td><?PHP echo $registro['nome']; ?></td>
				  </tr>
                  <tr>
					<td class="tituloTblDireita">Sexo:</td>
					<td><?PHP echo sexocompleto($registro['sexo']); ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Email:</td>
					<td><?PHP echo $registro['email']; ?></td>
				  </tr>
                  <tr>
					<td class="tituloTblDireita">CPF:</td>
					<td><?PHP echo $registro['CPF']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Data de Nascimento:</td>
					<td><?PHP echo $registro['dataNasc']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Telefone:</td>
					<td><?PHP echo $registro['telefone']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Celular:</td>
					<td><?PHP echo $registro['celular']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Endereço:</td>
					<td><?PHP echo $registro['endereco']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Número:</td>
					<td><?PHP echo $registro['numero']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Complemento:</td>
					<td><?PHP echo $registro['complemento']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">CEP:</td>
					<td><?PHP echo $registro['CEP']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Cidade:</td>
					<td><?PHP echo $registro['cidade']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">UF:</td>
					<td><?PHP echo $registro['UF']; ?></td>
				  </tr>
				  <tr>
					<td class="tituloTblDireita">Desativar cadastro:</td>
					<?PHP
						if($registro['ocultar'] == "sim"){
							?><td class="cursorPointer" onClick="ocultarCadastro('exibir','funcionario','<?PHP echo $registro['idFuncionario']; ?>');">Exibir</td><?PHP
						}else{
							?><td class="cursorPointer" onClick="ocultarCadastro('ocultar','funcionario','<?PHP echo $registro['idFuncionario']; ?>');">Ocultar</td><?PHP
						}
					?>
				  </tr>
				</table>
				<?PHP
			}
		}
	}
	?>
<?PHP
	Require('footer.php');
?>