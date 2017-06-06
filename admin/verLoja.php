<?PHP
	session_start();
	
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "funcionario" || $_SESSION['tipoFuncionario'] != "admin"){
		header('location: index.php');
	}else{
		Require('conecta.php');
		
		Require('../funcoes.php');
		
		$idProduto = $_GET['idProduto'];
		
		$sql = "SELECT * FROM lojaproduto WHERE idProduto = $idProduto";
		if (!mysql_query($sql)){
			$mensagem = "Produto não localizado.";
		}else{
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			?>
			<style>
			#divLoja{
				text-align:left;
				color:#000;
			}
			</style>
			<div id="divLoja">
            <table border="1">
           		<tr>
                    <td rowspan="9" valign="top">
                        <a href="javascript:void(0);" onclick="window.open('../loja/imgGrd/<?PHP echo $registro['img']; ?>','','width=500,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no');"><img src="../loja/imgPeq/<?PHP echo $registro['img']; ?>" border="0" /></a>
                    </td>
                </tr>
                <tr>
                	<td width="200"><strong>Nome do produto:</strong></td>
                </tr>
                <tr>
                    <td><?PHP echo $registro['nome']; ?></td>
                </tr>
                <tr>
                	<td><strong>Descrição:</strong></td>
                </tr>
                <tr>
                    <td><?PHP echo str_replace(chr(10), "<br />", $registro['descricao']); ?></td>
                </tr>
                <tr>
                	<td><strong>Valor / Preço:</strong></td>
                </tr>
                <tr>
                    <td>R$: <?PHP echo $registro['valor']; ?></td>
                </tr>
                <tr>
                	<td><strong>Data inserido:</strong></td>
                </tr>
                <tr>
                    <td valign="top"><?PHP echo formatarData($registro['dataInserido']); ?></td>
                </tr>
            </table>
			</div>
			<?PHP
		}
	}
?>