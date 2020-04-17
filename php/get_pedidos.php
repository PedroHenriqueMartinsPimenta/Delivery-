<?php
session_start();
					include_once('conexao.php');
					$email = $_SESSION['EMAIL'];
					$mes = date('m');
					$ano = date('Y');
						$sql = "SELECT COMPRAS.MOMENTO, COMPRAS.CODIGO, COMPRAS.STATUS AS STATUS_CODIGO, STATUS.NOME AS STATUS_NOME, DATE_FORMAT(COMPRAS.MOMENTO, '%d/%m/%Y %H:%i:%s') AS DIA, CLIENTES.NOME AS CLIENTE_NOME, CLIENTES.SOBRENOME AS CLIENTE_SOBRENOME, CLIENTES.RUA, CLIENTES.COMPLEMENTO, CLIENTES.CIDADE, CLIENTES.CIDADE, CLIENTES.ESTADO, CLIENTES.TELEFONE AS NUMERO FROM COMPRAS INNER JOIN ITENS ON COMPRAS.CODIGO = ITENS.COMPRAS_CODIGO INNER JOIN STATUS ON COMPRAS.STATUS = STATUS.CODIGO INNER JOIN CLIENTES ON COMPRAS.CLIENTES_EMAIL = CLIENTES.EMAIL INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO WHERE PRODUTOS.EMPRESAS_EMAIL = '$email' AND YEAR(COMPRAS.MOMENTO) = $ano AND MONTH(COMPRAS.MOMENTO) = $mes  GROUP BY COMPRAS.CODIGO ORDER BY COMPRAS.MOMENTO DESC";
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
					        	$sql = "SELECT PRODUTOS.ICON, PRODUTOS.NOME, PRODUTOS.PRECO, ITENS.QUANTIDADE AS ITENS_QUANTIDADE FROM ITENS INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO WHERE ITENS.COMPRAS_CODIGO = ".$row['CODIGO'];
					        	$queryProdutos = mysqli_query($con, $sql);

					        	while ($rowProdutos = mysqli_fetch_array($queryProdutos)) {
					        			$precoTotal += $rowProdutos['PRECO'] * $rowProdutos['ITENS_QUANTIDADE'];
					        		?>

					        			<div class="col-12">
					        				<img src="<?php echo $rowProdutos['ICON']?>" width="50px"> 
					        				<?php echo $rowProdutos['NOME']?> - <b><?php echo $rowProdutos['ITENS_QUANTIDADE']?> UNIDADES / R$ <?php echo $rowProdutos['PRECO']?></b>
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
						<td><?php echo $row['CLIENTE_NOME']. " ". $row['CLIENTE_SOBRENOME']?></td>
						<td><span class="link" onclick="show(<?php echo $row['CODIGO']?>)">Ver produtos</span></td>
						<td>R$ <?php echo $precoTotal?></td>
						<td><a href="https://api.whatsapp.com/send?phone=+55<?php echo $row['NUMERO']?>&text="><?php echo $row['NUMERO']?></a></td>
						<td><?php echo $row['RUA'].", ".$row['COMPLEMENTO'].", ".$row['CIDADE']."-".$row['ESTADO']?></td>
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
				