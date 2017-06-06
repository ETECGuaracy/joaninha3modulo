<?PHP session_start(); ?>
<?PHP
	Require('funcoes.php');
	
	Require('conecta.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Escola de Educação Infantil Joaninha</title>
<link href="_estilos/estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?PHP
	if($_SESSION['login'] != session_id() || $_SESSION['tipoUsuario'] != "aluno"){
		?>
        	<p>Página restrita a pais e alunos da escola.</p>
            <p>Para acessar o conteúdo faça o login.</p>
            <p>Caso seu filho não esteja cadastrado no sistema, por favor, solicite a secretaria.</p>
		<?PHP
	}else{
		$idAluno = $_SESSION['idAluno'];
		$idPedido = $_GET['idPedido'];
		
		$sql = "SELECT * FROM aluno WHERE idAluno = '$idAluno'";
		if(!mysql_query($sql)){
			?><p>Aluno não encontrado.</p><?PHP
		}else{
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			$alunoNome = $registro['nome'];
			$alunoIdTurma = $registro['idTurma'];
			
			$sql = "SELECT * FROM turma WHERE idTurma = '$alunoIdTurma'";
			if(!mysql_query($sql)){
				?><p>Turma não encontrada.</p><?PHP
			}else{
				$selecao = mysql_query($sql);
				$registro = mysql_fetch_assoc($selecao);
				$alunoTurma = $registro['turma'];
			}
		}
		
		$sql = "SELECT * FROM lojapedido WHERE idPedido = $idPedido AND idAluno = '$idAluno'";
		if(!mysql_query($sql)){
			?><p>Pedido não encontrado.</p><?PHP
		}else{
			$selecao = mysql_query($sql);
			$registro = mysql_fetch_assoc($selecao);
			$linhas = mysql_num_rows($selecao);
			if($linhas == 0){
				?><p>Pedido não encontrado.</p><?PHP
			}else{
				?>
                <style>
				.paddingTbl th{
					padding-left:5px;
					padding-right:5px;
				}
				#divPrincipal{
					margin:auto;
					width:600px;
				}
				#btnImprimir{
					float:right;
				}
				</style>
                <div id="divPrincipal">
                <p><label class="titulo">Pedido da Loja Virtual</label> <label id="btnImprimir"><a href="javascript:print();">Imprimir</a></label></p>
                <table>
                  <tr>
                    <td class="tituloTblDireita">Nome do Aluno(a):</td>
                    <td><?PHP echo $alunoNome; ?></td>
                  </tr>
                  <tr>
                    <td class="tituloTblDireita">Turma:</td>
                    <td><?PHP echo $alunoTurma; ?></td>
                  </tr>
                  <tr>
                    <td class="tituloTblDireita">Data do pedido:</td>
                    <td><?PHP echo formatarDataExtenso($registro['dataInicio']); ?></td>
                  </tr>
                  <tr>
                    <td class="tituloTblDireita">Status:</td>
                    <td><?PHP echo ucwords($registro['status']); ?></td>
                  </tr>
                  <tr>
                    <td class="tituloTblDireita">Pagamento:</td>
                    <td><?PHP
                    	if($registro['formaPgm'] == "cartao"){
							#faz a soma total do pedido e salva na variável $valorTotal
							$sql2 = "SELECT * FROM lojaitem i, lojaproduto p WHERE i.idProduto = p.idProduto AND i.idPedido = $idPedido";
							$selecao2 = mysql_query($sql2);
							$valorTotal = 0;
							$contador = 0;
							while($registro2 = mysql_fetch_assoc($selecao2)){
								$contador++;
								$valorTotalProduto = str_replace(",",".",$registro2['valor']) * $registro2['qtd'];
								$valorTotal = $valorTotal + $valorTotalProduto;
							}
							?>Cartão (<?PHP echo ucwords($registro['cartaoTipo']); ?>) - <?PHP echo $registro['cartaoParcelas'] ; ?> x R$: <?PHP echo number_format($valorTotal/$registro['cartaoParcelas'], 2, ',', ''); ?><?PHP
						}else if($registro['formaPgm'] == "dinheiro"){
							?>Dinheiro<?PHP
						}else{
							?>Não foi efetuado um pagamento<?PHP
						}
					?></td>
                  </tr>
                </table>
                <p></p>
                <table border="1" class="paddingTbl">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Nome do produto</th>
                        <th>Valor unitário</th>
                        <th>Quantidade</th>
                        <th>Valor total</th>
                    </tr>
                    </thead>
                    <?PHP
                    $sql = "SELECT * FROM lojaitem i, lojaproduto p WHERE i.idProduto = p.idProduto AND i.idPedido = $idPedido ORDER BY i.idItem";
                    $selecao = mysql_query($sql);
                    $contador = 0;
                    while($registro = mysql_fetch_assoc($selecao)){
                        $contador++;
                        $valorTotalProduto = str_replace(",",".",$registro['valor']) * $registro['qtd'];
                        ?>
                        <tr>
                            <td><?PHP echo $contador; ?></td>
                            <td><?PHP echo $registro['nome']; ?></td>
                            <td>R$: <?PHP echo $registro['valor']; ?></td>
                            <td align="center"><?PHP echo $registro['qtd']; ?></td>
                            <td>R$: <?PHP echo number_format($valorTotalProduto, 2, ',', ''); ?></td>
                        </tr>
                        <?PHP
                        $total = $total + $valorTotalProduto;
                    }
                    ?>
                    <tfoot>
                    <tr>
                        <td colspan="4" class="tituloTblDireita">Total:</td>
                        <td>R$: <?PHP echo number_format($total, 2, ',', ''); ?></td>
                    </tr>
                    </tfoot>
                </table>
                <p><strong>Impresso em: </strong><?PHP echo formatarDataExtenso(time()); ?></p>
                </div>
                <?PHP
			}
		}
	}
?>
</body>
</html>