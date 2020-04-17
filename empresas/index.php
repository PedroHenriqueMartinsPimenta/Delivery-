<?php 
	include_once('../content/config.php');
	include_once('../php/conexao.php');
	include_once('../content/header.php');
	if(isset($_SESSION['EMAIL']) && $_SESSION['PERMISSAO'] == 1){
		$email = $_SESSION['EMAIL'];
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
<p>Sua loja: <a target="_blank" href="<?php echo $url?>pesquisa.php?tipo=1&pesquisa=<?php echo $_SESSION['NOME']?>"><?php echo $url?>pesquisa.php?tipo=1&pesquisa=<?php echo $_SESSION['NOME']?></a></p>
<h2>Pedidos desse mês</h2>
		<div class="page-content" style="overflow: auto">
			<table border="1px">
				<thead>
					<tr>
						<td>Cliente</td>
						<td>Produtos</td>
						<td>Valor total</td>
						<td>Numero do cliente</td>
						<td>Localização</td>
						<td>Dia da compra</td>
						<td>Status</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$mes = date('m');
					$ano = date('Y');
						$sql = "SELECT COMPRAS.MOMENTO, COMPRAS.CODIGO, COMPRAS.STATUS AS STATUS_CODIGO, STATUS.NOME AS STATUS_NOME, DATE_FORMAT(COMPRAS.MOMENTO, '%d/%m/%Y %H:%i:%s') AS DIA, CLIENTES.NOME AS CLIENTE_NOME, CLIENTES.SOBRENOME AS CLIENTE_SOBRENOME, CLIENTES.RUA, CLIENTES.COMPLEMENTO, CLIENTES.BAIRRO, CLIENTES.CIDADE, CLIENTES.CIDADE, CLIENTES.ESTADO, CLIENTES.TELEFONE AS NUMERO FROM COMPRAS INNER JOIN ITENS ON COMPRAS.CODIGO = ITENS.COMPRAS_CODIGO INNER JOIN STATUS ON COMPRAS.STATUS = STATUS.CODIGO INNER JOIN CLIENTES ON COMPRAS.CLIENTES_EMAIL = CLIENTES.EMAIL INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO WHERE PRODUTOS.EMPRESAS_EMAIL = '$email' AND YEAR(COMPRAS.MOMENTO) = $ano AND MONTH(COMPRAS.MOMENTO) = $mes  GROUP BY COMPRAS.CODIGO ORDER BY COMPRAS.MOMENTO DESC";
						$query = mysqli_query($con, $sql);
						echo mysqli_error($con);
						while ($row = mysqli_fetch_array($query)) {
						$precoTotal = 0;
						
					?>
					<div class="modal <?php echo $row['CODIGO']?>" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <p class="modal-title" id="TituloModalLongoExemplo">Produtos</p>
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
					        <p>Valor total de R$ <?php echo $precoTotal?></h3>
					      </div>
					    </div>
					  </div>
					</div>
					<tr>
						<td><?php echo $row['CLIENTE_NOME']. " ". $row['CLIENTE_SOBRENOME']?></td>
						<td><span class="link" onclick="show(<?php echo $row['CODIGO']?>)">Ver produtos</span></td>
						<td>R$ <?php echo $precoTotal?></td>
						<td><a href="https://api.whatsapp.com/send?phone=+55<?php echo $row['NUMERO']?>&text="><?php echo $row['NUMERO']?></a></td>
						<td><?php echo $row['RUA'].", ".$row['COMPLEMENTO'].", ".$row['BAIRRO'].", ".$row['CIDADE']."-".$row['ESTADO']?></td>
						<td><?php echo $row['DIA']?></td>
						<td>
							<select name="<?php echo $row['CODIGO']?>">
								<option value="<?php echo $row['STATUS_CODIGO']?>"><?php echo $row['STATUS_NOME']?></option>
								<?php
									$sql = "SELECT * FROM STATUS WHERE CODIGO != ".$row['STATUS_CODIGO'];
									$query1 = mysqli_query($con, $sql);
									while ($row1 = mysqli_fetch_array($query1)) {
										?>
										<option value="<?php echo $row1['CODIGO']?>"><?php echo $row1['NOME']?></option>
										<?php
									}
								?>
							</select>
							<img src="../img/loader.gif" id="loader<?php echo $row['CODIGO']?>" width="30px" style="margin-top: 10px; display: none" >
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
				$('select').change(function(){
					var status = $(this).val();
					var codigo = $(this).attr('name');
					$('#loader'+codigo).fadeIn('slow');
					$.post(
						'../php/update_status_compras.php',
						{codigo: codigo,status: status},
						function(result){
							console.log(result);
							if (result == 1) {
								$('#loader'+codigo).fadeOut('slow');
							}
						},
						'JSON'
						);
				});
				$('.close').click(function(){
					$('.modal').hide('slow');
				});
			});
			function show(codigo){
				$('.'+codigo).fadeIn('slow');
			}
			setInterval(function(){
				$.post(
					"../php/get_pedidos.php",
					null,
					function(result){
							$('tbody').html(result);
						
					}
					);
			}, 100000);
		</script>
<?php
}else{
		include_once('../content/404.php');
	}
	include_once('../content/footer.php');
?>