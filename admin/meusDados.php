<?PHP
	Require('verificaLogin.php');
	
	Require('header.php');
	
	Require('conecta.php');	
?>
<p class="titulo">Meus dados</p>
<p><a href="alterarDados.php">Clique aqui para alterar seus dados</a> | <a href="alterarSenha.php">Clique aqui para alterar sua senha</a></p>
<?PHP
$idFuncionario = $_SESSION['idFuncionario'];
$sql = "SELECT * FROM funcionario, tipofuncionario WHERE funcionario.idTipo = tipofuncionario.idTipo AND idFuncionario = $idFuncionario";
$selecao = mysql_query($sql);
$registro = mysql_fetch_assoc($selecao);
?>
<table width="500" border="0">
  <tr>
    <td class="tituloTblDireita" width="160">Nome de Usuário:</td>
    <td><?PHP echo $registro['usuario']; ?></td>
  </tr>
  <tr>
    <td class="tituloTblDireita">Tipo de Funcionário:</td>
    <td><?PHP echo $registro['tipo']; ?></td>
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
    <td class="tituloTblDireita">CPF:</td>
    <td><?PHP echo $registro['CPF']; ?></td>
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
</table>
<?PHP
	Require('footer.php');
?>