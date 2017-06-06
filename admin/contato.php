<?PHP
	Require('verificaLogin.php');
	
	Require('verificaLoginSecretaria.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
<?PHP
	$idMensagem = $_GET['idMensagem'];
	
	$sql = "SELECT * FROM assunto";
	$selecao = mysql_query($sql);
	
	while($registro = mysql_fetch_assoc($selecao)){
		$assunto[$registro['idAssunto']] = $registro['assunto'];
	}
?>
	
    <p class="titulo">Contatos</p>
    <?PHP
    if($idMensagem == ""){
		?>
		<script>
		$(document).ready(function(){
			$("#tblContato").tablesorter();
		});
		</script>
		<table border="1" id="tblContato" class="paddingTbl">
        	<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Assunto</th>
                <th>Data Envio</th>
                <?PHP
                if($_SESSION['tipoFuncionario'] == "admin"){
					?><th>Resolvido</th><?PHP
				}
				?>
			</tr>
            </thead>
		<?PHP
			if($_SESSION['tipoFuncionario'] == "admin"){
				$sql = "SELECT * FROM contato ORDER BY idMensagem DESC";
			}else{
				$sql = "SELECT * FROM contato WHERE resolvido = 'nao' ORDER BY idMensagem DESC";
			}
			$selecao = mysql_query($sql);
			
			while($registro = mysql_fetch_assoc($selecao)){
				?>
				<tr onclick="window.location = '?idMensagem=<?PHP echo $registro['idMensagem']; ?>';"<?PHP
				if($registro['dataLeitura'] == 0){
					echo " class='contatoNaoLido'";
				}else{
					echo " class='contatoLido'";
				}
				?>>
					<td>
						<?PHP echo $registro['nome']; ?>
					</td>
					<td>
						<?PHP echo $registro['email']; ?>
					</td>
					<td>
						<?PHP echo $assunto[$registro['idAssunto']]; ?>
					</td>
					<td>
						<?PHP echo formatarData($registro['dataEnvio']); ?>
					</td>
                    <?PHP
					if($_SESSION['tipoFuncionario'] == "admin"){
						?><td>
							<?PHP echo $registro['resolvido']; ?>
                        </td><?PHP
					}
					?>
				</tr>
				<?PHP
			}
		?>
		</table>
		<?PHP
	}else{
		$acao = $_GET['acao'];
		
		if($acao == "resolvido"){
			$sql = "UPDATE contato SET resolvido = 'sim' WHERE idMensagem = $idMensagem";
			mysql_query($sql);
			
			?><script>window.location = 'contato.php';</script>;<?PHP
		}else{
			$sql = "SELECT * FROM contato WHERE idMensagem = $idMensagem";
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			
			if($registro['dataLeitura'] == 0){
				$data = time();
				$sql = "UPDATE contato SET dataLeitura = '$data' WHERE idMensagem = $idMensagem";
				mysql_query($sql);
			}else{
				$data = $registro['dataLeitura'];
			}
			?>
			<table>
			  <tr>
				<td class="tituloTblDireita" width="150">Nome:</td>
				<td><?PHP echo $registro['nome']; ?></td>
			  </tr>
              <tr>
				<td class="tituloTblDireita">E-mail:</td>
				<td><?PHP echo $registro['email']; ?></td>
			  </tr>
              <tr>
				<td class="tituloTblDireita">Telefone:</td>
				<td><?PHP echo $registro['telefone']; ?></td>
			  </tr>
              <tr>
				<td class="tituloTblDireita">Assunto:</td>
				<td><?PHP echo $assunto[$registro['idAssunto']]; ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Mensagem:</td>
				<td><?PHP echo str_replace(chr(10), "<br />", $registro['mensagem']); ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Enviado em:</td>
				<td><?PHP echo formatarDataExtenso($registro['dataEnvio']); ?></td>
			  </tr>
			  <tr>
				<td class="tituloTblDireita">Primeira vez lido em:</td>
				<td><?PHP echo formatarDataExtenso($data); ?></td>
			  </tr>
			</table>
			<?PHP
				if($registro['resolvido'] == "nao"){
					?><p><a href="?acao=resolvido&idMensagem=<?PHP echo $idMensagem; ?>">Clique aqui se esta mensagem já foi respondida / resolvida</a></p><?PHP
				}else{
					?><p>Este contato já foi respondido / resolvido</p><?PHP
				}
		}
	}
	?>
<?PHP
	Require('footer.php');
?>