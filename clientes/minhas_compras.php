<?php
	include_once('../content/config.php');
	include_once('../php/conexao.php');
	include_once('../content/header.php');
	if (!isset($_SESSION['EMAIL'])) {
		?>
		<script type="text/javascript">
			window.location.href='../login.php';
		</script>
		<?php
	}
	?>
	<style type="text/css">
	table{
		margin-top: 20px
	}
	tr th,td{
		min-width: 100px;
		text-align: center;
		font-size: 17px;
	}
	td{
		padding: 5px;
	}
	tbody td{
		font-size: 14px;
	}
	thead{
		background-color: rgba(20,20,20,0.9);
		color: white
	}
	.link{
		color: rgba(238, 173, 45, 1);
		cursor: pointer;
		font-size: 15px; 
		transition: 0.25s;

	}
	.link:hover{
		color: rgba(248, 173, 45, 0.7);

	}
	.preco{
			position: absolute;
			right: 0px;
			top: -3px;
	}
</style>
<h2>Compras desse mês</h2>
		<div class="page-content" style="overflow: auto">
			<table border="1px">
				<thead>
					<tr>
						<td>Loja</td>
						<td>Produtos</td>
						<td>Valor total</td>
						<td>Numero da empresa</td>
						<td>Localização</td>
						<td>Dia da compra</td>
						<td>Status</td>
						<td>Cancelar</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$mes = date('m');
					$ano = date('Y');
						$sql = "SELECT COMPRAS.MOMENTO, COMPRAS.CODIGO, COMPRAS.STATUS AS STATUS_CODIGO, STATUS.NOME AS STATUS_NOME, DATE_FORMAT(COMPRAS.MOMENTO, '%d/%m/%Y %H:%i:%s') AS DIA, EMPRESAS.NOME AS EMPRESA_NOME,  EMPRESAS.RUA, EMPRESAS.COMPLEMENTO, EMPRESAS.BAIRRO, EMPRESAS.CIDADE, EMPRESAS.ESTADO, EMPRESAS.TELEFONE AS NUMERO FROM COMPRAS INNER JOIN ITENS ON COMPRAS.CODIGO = ITENS.COMPRAS_CODIGO INNER JOIN STATUS ON COMPRAS.STATUS = STATUS.CODIGO  INNER JOIN CLIENTES ON COMPRAS.CLIENTES_EMAIL = CLIENTES.EMAIL INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO INNER JOIN EMPRESAS ON PRODUTOS.EMPRESAS_EMAIL = EMPRESAS.EMAIL WHERE COMPRAS.CLIENTES_EMAIL = '$email' AND YEAR(COMPRAS.MOMENTO) = $ano AND MONTH(COMPRAS.MOMENTO) = $mes  GROUP BY CONCAT(COMPRAS.CODIGO, PRODUTOS.EMPRESAS_EMAIL) ORDER BY COMPRAS.MOMENTO DESC";
						$query = mysqli_query($con, $sql);
						echo mysqli_error($con);
						while ($row = mysqli_fetch_array($query)) {
						$precoTotal = 0;
						
					?>
					<div class="modal <?php echo $row['CODIGO']?>" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="TituloModalLongoExemplo">Produtos</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <?php
					        	$sql = "SELECT PRODUTOS.ICON, PRODUTOS.NOME, PRODUTOS.PRECO, ITENS.QUANTIDADE AS ITENS_QUANTIDADE, ITENS.OBS FROM ITENS INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO WHERE ITENS.COMPRAS_CODIGO = ".$row['CODIGO'];
					        	$queryProdutos = mysqli_query($con, $sql);

					        	while ($rowProdutos = mysqli_fetch_array($queryProdutos)) {
					        			$precoTotal += $rowProdutos['PRECO'] * $rowProdutos['ITENS_QUANTIDADE'];
					        		?>

					        			<div class="col-12">
					        				<img src="<?php echo $rowProdutos['ICON']?>" width="50px"> 
					        				<?php echo $rowProdutos['NOME'] . " " . $rowProdutos['OBS']?> - <b><?php echo $rowProdutos['ITENS_QUANTIDADE']?> UNIDADES / R$ <?php echo $rowProdutos['PRECO']?></b>
					        				<span class="preco"><b>R$ <?php echo $rowProdutos['PRECO'] * $rowProdutos['ITENS_QUANTIDADE'] ?></b></span>

					        			</div>
					        			<hr>
					        		<?php
					        	}
					        ?>
					      </div>
					      <div class="modal-footer">
					        <h5>Valor total de R$ <?php echo $precoTotal?></h3>
					      </div>
					    </div>
					  </div>
					</div>
					<tr>
						<td><?php echo $row['EMPRESA_NOME']?></td>
						<td><span class="link" onclick="show(<?php echo $row['CODIGO']?>)">Ver produtos</span></td>
						<td>R$ <?php echo $precoTotal?></td>
						<td><a href="https://api.whatsapp.com/send?phone=+55<?php echo $row['NUMERO']?>&text="><?php echo $row['NUMERO']?></a></td>
						<td><?php echo $row['RUA'].", ".$row['COMPLEMENTO'].", ".$row['BAIRRO'].", ".$row['CIDADE']."-".$row['ESTADO']?></td>
						<td><?php echo $row['DIA']?></td>
						<td><b><?php echo $row['STATUS_NOME']?></b></td>
						<td>
							<?php 
								if ($row['STATUS_CODIGO'] == 1) {
									?>
										<a href="../php/cancelar_compra.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-danger">X</a>
									<?php
								}else{
									?>
										<b class="btn btn-info" style="cursor: pointer">Não pode ser mais cancelado</b>
									<?php
								}
							?>
						</td>
					</tr>
					<?php 
						}
					?>
				</tbody>
			</table>
		</div>
		<script type="text/javascript">
			$(function(){
				
				$('.close').click(function(){
					$('.modal').hide('slow');
				});
			});
			function show(codigo){
				$('.'+codigo).fadeIn('slow');
			}
			
		</script>
	<?php
	include_once('../content/footer.php');
?>