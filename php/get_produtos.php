<?php 
		include_once('conexao.php');
		if(!isset($_SESSION['DOLAR'])){
			$url_dolar = 'http://cotacoes.economia.uol.com.br/cambioJSONChart.html';

			$curl = curl_init();
			curl_setopt( $curl, CURLOPT_URL, $url_dolar);
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

			$reply = curl_exec( $curl );
			$data = json_decode( $reply );
			$_SESSION['DOLAR'] = $data[2]->ask;
		}
		session_start();
		$qtd = $_POST['qtd'];
		$where = "";
		if (isset($_POST['where'])) {
			$where = "AND ".$_POST['where'];
		}
			if (isset($_SESSION['EMAIL'])) {
				$cidade = $_SESSION['CIDADE'];
				$sql = "SELECT  PRODUTOS.ICON, PRODUTOS.NOME, PRODUTOS.PRECO, PRODUTOS.CODIGO, EMPRESAS.NOME AS EMPRESA, CATEGORIAS.NOME AS CATEGORIA, CATEGORIAS.CODIGO AS CATEGORIA_CODIGO, PRODUTOS.DOLAR FROM PRODUTOS INNER JOIN EMPRESAS ON PRODUTOS.EMPRESAS_EMAIL = EMPRESAS.EMAIL INNER JOIN CATEGORIAS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO WHERE PRODUTOS.DISPONIVEL = 1 AND PRODUTOS.QUANTIDADE > 0 AND EMPRESAS.CIDADE = '$cidade' $where GROUP BY PRODUTOS.CODIGO  ORDER BY PRODUTOS.CODIGO DESC LIMIT $qtd";
			}else{
				$sql = "SELECT  PRODUTOS.ICON, PRODUTOS.NOME, PRODUTOS.PRECO, PRODUTOS.CODIGO, EMPRESAS.NOME AS EMPRESA, CATEGORIAS.NOME AS CATEGORIA, CATEGORIAS.CODIGO AS CATEGORIA_CODIGO, PRODUTOS.DOLAR FROM PRODUTOS INNER JOIN EMPRESAS ON PRODUTOS.EMPRESAS_EMAIL = EMPRESAS.EMAIL INNER JOIN CATEGORIAS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO WHERE PRODUTOS.DISPONIVEL = 1 AND PRODUTOS.QUANTIDADE > 0 $where GROUP BY PRODUTOS.CODIGO  ORDER BY PRODUTOS.CODIGO DESC LIMIT $qtd";
			}
				$query = mysqli_query($con, $sql);
				echo mysqli_error($con);
				while($row = mysqli_fetch_array($query)){
			?>
			<div class="content-produto">
				<div class="img" style="background-image: url('<?php echo $row['ICON']?>');">
				
				</div>
				<div class="description">
					<div class="product-categories"><a href="" rel="tag"><?php echo $row['CATEGORIA']?></a></div><a href="" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h4 class="woocommerce-loop-product__title"><?php echo $row['NOME']?></h4>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span>
<?php 
		if($row['DOLAR']){
			echo round($row['PRECO'] * $_SESSION['DOLAR'], 2);
		}else{
			echo $row['PRECO'];
		}
	?>
</span></span><br>
</a><a href="produto.php?codigo=<?php echo $row['CODIGO']?>" data-quantity="1" class="button product_type_simple  ajax_add_to_cart" data-product_id="10" data-product_sku="" aria-label="Adicionar “Frist product” no seu carrinho">Comprar</a>
				</div>
				<div  class="nome-empresa">
					<?php echo $row['EMPRESA']?>
				</div>
			</div>
			<?php 
				}
			?>