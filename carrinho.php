<?php 
	include_once("content/config.php");
	include_once('php/conexao.php');
	include_once('content/header.php');
	
?>
<style type="text/css">
	td{
		text-align: center;
		padding: 10px;
	}
	thead{
		font-weight: bold;
		font-size: 16px;
	}
</style>
<?php
$total = 0;
	if (sizeof($_SESSION['CARRINHO']) > 0) {
	
?>
<a href="<?php echo $url?>clientes/checkout.php" class="btn btn-success" style="margin-top: 10px">Finalizar compras</a>
<?php
		}else{
			?>
			<a href="<?php echo $url?>" class="btn btn-danger">Carrinho vazio</a>
			<?php
		}
?>
<div style="overflow: auto" style="margin-top: 10px">
<table>
	<thead>
		<tr>
			<td>Foto</td>
			<td>Produto</td>
			<td>Quantidade</td>
			<td>Valor unitario</td>
			<td>Valor total</td>
			<td>Remover</td>
		</tr>
	</thead>
	<tbody>
		<?php
			$array = $_SESSION['CARRINHO'];
			$i = 0;

			foreach ($array as $i => $value) {
				if(isset($array[$i])){
				$codigo = $array[$i][0];
				$sql = "SELECT * FROM PRODUTOS WHERE CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_array($query)) {
					$total += $array[$i][1] * $row['PRECO'];
					?>
						<tr>
							<td><img src="<?php echo $row['ICON']?>" width="50px"></td>
							<td><a href="produto.php?codigo=<?php echo $row['CODIGO']?>"><?php echo $row['NOME'] . " " . $array[$i][3]?></a></td>
							<td><?php echo $array[$i][1]?> unidades</td>
							<td>R$ <?php echo $row['PRECO']?></td>
							<td>R$ <?php echo $array[$i][1] * $row['PRECO']?></td>
							<td><a href="php/remover_carrinho.php?posicao=<?php echo $i?>" class="btn btn-danger"><b>X</b></a></td>
						</tr>
					<?php
				}
			}
		}
		?>
	</tbody>
</table>
<h4 style="float: right;">Valor total de R$ <?php echo $total?></h4>
</div>
<?php
	include_once('content/footer.php');
?>