<?PHP
	Require('header.php');
	
	Require('conecta.php');	
?>
<p class="titulo">Meus dados</p>
<?PHP
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno"){
		?>
        	<p>Página restrita a pais e alunos da escola.</p>
            <p>Para acessar o conteúdo faça o login.</p>
            <p>Caso seu filho não esteja cadastrado no sistema, por favor, solicite a secretaria.</p>
		<?PHP
	}else{
		?>
        <p><a href="alterarDados.php">Clique aqui para alterar seus dados</a> | <a href="alterarSenha.php">Clique aqui para alterar sua senha</a></p>
        <?PHP
		$idAluno = $_SESSION['idAluno'];
        $sql = "SELECT * FROM aluno, turma WHERE idAluno = $idAluno AND aluno.idTurma = turma.idTurma";
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
            <td><?PHP echo $registro['turma']; ?></td>
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
            <td><?PHP
            if($registro['responsavel'] == "mae"){
				echo "Mãe";
			}else if($registro['responsavel'] == "pai"){
				echo "Pai";
			}
			?></td>
          </tr>
          <tr>
            <td class="tituloTblDireita">CPF do responsável:</td>
            <td><?PHP echo $registro['CPF']; ?></td>
          </tr>
        </table>
        <?PHP
	}
?>
<?PHP
	Require('footer.php');
?>