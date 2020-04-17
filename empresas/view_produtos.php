<?php
		include_once('../content/config.php');
		include_once('../php/conexao.php');
		include_once('../content/header.php');
		$email = $_SESSION['EMAIL'];
	if(isset($_SESSION['EMAIL']) && $_SESSION['PERMISSAO'] == 1){
		if(!isset($_SESSION['DOLAR'])){
			$url_dolar = 'http://cotacoes.economia.uol.com.br/cambioJSONChart.html';

			$curl = curl_init();
			curl_setopt( $curl, CURLOPT_URL, $url_dolar);
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

			$reply = curl_exec( $curl );
			$data = json_decode( $reply );
			$_SESSION['DOLAR'] = $data[2]->ask;
		}
		?>
		<style type="text/css">
			td,th{
				padding: 10px;
				min-width: 100px;
				text-align: center
			}
			thead{
				font-size: 18px;
			}
		</style>
		<div style="overflow: auto">
			<table>
				<thead>
					<td>Icone</td>
					<td>Nome</td>
					<td>Preço</td>
					<td>Quantidade</td>
					<td>Categoria</td>
					<td>Editar</td>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT PRODUTOS.ICON,PRODUTOS.DISPONIVEL, PRODUTOS.NOME, PRODUTOS.PRECO, PRODUTOS.QUANTIDADE, PRODUTOS.CODIGO, CATEGORIAS.NOME AS CATEGORIA, PRODUTOS.DOLAR FROM PRODUTOS INNER JOIN CATEGORIAS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO WHERE EMPRESAS_EMAIL = '$email' ORDER BY CODIGO DESC";
						$query = mysqli_query($con, $sql);
						echo mysqli_error($con);
						while ($row = mysqli_fetch_array($query)) {
							if ($row['DISPONIVEL'] == 0) {
								?>
								<tr style="opacity: 0.4">
									<td>
										<img src="<?php echo $row['ICON']?>" width="50">
									</td>
									<td><?php echo $row['NOME']?></td>
									<td>R$ <?php echo $row['PRECO']?></td>
									<td><?php echo $row['QUANTIDADE']?> unidades</td>
									<td><?php echo $row['CATEGORIA']?></td>
									<td><a href="update_produtos.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-outline-danger">Editar</a></td>
								</tr>
								<?php
							}else if($row['DISPONIVEL'] == 1){
								?>
								<tr>
									<td>
										<img src="<?php echo $row['ICON']?>" width="50">
									</td>
									<td><?php echo $row['NOME']?></td>
									<td>R$
										<?php
											if($row['DOLAR']){
												echo round($row['PRECO'] * $_SESSION['DOLAR'], 2);
											}else{
												echo $row['PRECO'];
											}
										?>
									</td>
									<td><?php echo $row['QUANTIDADE']?> unidades</td>
									<td><?php echo $row['CATEGORIA']?></td>
									<td><a href="update_produtos.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-outline-danger">Editar</a></td>
								</tr>
								<?php
							}
						}
					?>
				</tbody>
			</table>
		</div>
		<?php
	}else{
		include_once('../content/404.php');
	}
		include_once('../content/footer.php');
	
?>