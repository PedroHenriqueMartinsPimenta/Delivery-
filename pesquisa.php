<?php 
			include_once('content/config.php');
		    include_once('php/conexao.php');
			include_once('content/header.php');
			if(!isset($_SESSION['DOLAR'])){
				$url_dolar = 'http://cotacoes.economia.uol.com.br/cambioJSONChart.html';

				$curl = curl_init();
				curl_setopt( $curl, CURLOPT_URL, $url_dolar);
				curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

				$reply = curl_exec( $curl );
				$data = json_decode( $reply );
				$_SESSION['DOLAR'] = $data[2]->ask;
			}
			$where = "";
			if (isset($_GET['tipo']) && isset($_GET['pesquisa'])) {
				$pesquisa = $_GET['pesquisa'];
				$recado = "Resultados para";
				if ($_GET['tipo'] == 0) {
					$modelPesquisa = str_replace(" ", "+", $pesquisa . " ");
					$key = 0;
					$palavra ="";
					$where = "";
					for ($i=0; $i < strlen($modelPesquisa); $i++) { 
						
						if (substr($modelPesquisa, $i, 1) == '+') {
							if ($key == 0) {
								$where .= "CONCAT(PRODUTOS.NOME, PRODUTOS.DESCRICAO) LIKE '%$palavra%'";
							}else{
								$where .= " AND CONCAT(PRODUTOS.NOME, PRODUTOS.DESCRICAO) LIKE '%$palavra%'";
							}
							$palavra = "";
							$key++;
						}else{
							$palavra .= substr($modelPesquisa, $i, 1);
						}
					}
					$recado .= ": <b>".$pesquisa."</b>";
				}else if ($_GET['tipo'] == 1) {
					$where = "EMPRESAS.NOME LIKE '%$pesquisa%'";
					$recado = "";
				}
		?>
				<link rel="stylesheet" type="text/css" href="style/produto.css">
				<h2><?php echo $recado?></h2>
			<div id="produtos">
			<?php
			if (isset($_SESSION['EMAIL'])) {
				$sql = "SELECT  PRODUTOS.ICON, PRODUTOS.NOME, PRODUTOS.PRECO, PRODUTOS.CODIGO, EMPRESAS.NOME AS EMPRESA, CATEGORIAS.NOME AS CATEGORIA, CATEGORIAS.CODIGO AS CATEGORIA_CODIGO, PRODUTOS.AFILIACAO, PRODUTOS.URL, PRODUTOS.DOLAR FROM PRODUTOS INNER JOIN EMPRESAS ON PRODUTOS.EMPRESAS_EMAIL = EMPRESAS.EMAIL INNER JOIN CATEGORIAS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO  WHERE PRODUTOS.DISPONIVEL = 1 AND PRODUTOS.QUANTIDADE > 0 AND $where AND EMPRESAS.CIDADE = '$cidade' GROUP BY PRODUTOS.CODIGO  ORDER BY PRODUTOS.CODIGO DESC LIMIT 10";
			}else{
				$sql = "SELECT  PRODUTOS.ICON, PRODUTOS.NOME, PRODUTOS.PRECO, PRODUTOS.CODIGO, EMPRESAS.NOME AS EMPRESA, CATEGORIAS.NOME AS CATEGORIA, CATEGORIAS.CODIGO AS CATEGORIA_CODIGO, PRODUTOS.AFILIACAO, PRODUTOS.URL, PRODUTOS.DOLAR FROM PRODUTOS INNER JOIN EMPRESAS ON PRODUTOS.EMPRESAS_EMAIL = EMPRESAS.EMAIL INNER JOIN CATEGORIAS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO WHERE PRODUTOS.DISPONIVEL = 1 AND PRODUTOS.QUANTIDADE > 0 AND $where GROUP BY PRODUTOS.CODIGO  ORDER BY PRODUTOS.CODIGO DESC LIMIT 10";
			}
				$query = mysqli_query($con, $sql);

				if (mysqli_num_rows($query) == 0) {
					?>
						<h2><b>Nada encontrado : (</b></h2>
					<?php
				}
				while($row = mysqli_fetch_array($query)){
			?>
			<script type="text/javascript">
				$('a[rel="home"]').html("<?php echo $row['EMPRESA']?>");
			</script>
			<div class="content-produto">
				<div class="img" style="background-image: url('<?php echo $row['ICON']?>');">
					
				</div>
				<div class="description">
					<div class="product-categories"><a href="categorias.php?id=<?php echo $row['CATEGORIA_CODIGO']?>" rel="tag"><?php echo $row['CATEGORIA']?></a></div><a href="produto.php?codigo=<?php echo $row['CODIGO']?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h4 class="woocommerce-loop-product__title"><?php echo $row['NOME']?></h4>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span>
	<?php 
		if($row['DOLAR']){
			echo round($row['PRECO'] * $_SESSION['DOLAR'], 2);
		}else{
			echo $row['PRECO'];
		}
	?>
</span></span><br>
</a>

	<?php
		if ($row['AFILIACAO']) {
			?>
			<a href="<?php echo $row['URL']?>" target="_blank" data-quantity="1" class="button product_type_simple  ajax_add_to_cart" data-product_id="10" data-product_sku="" aria-label="Adicionar “Frist product” no seu carrinho" >Comprar</a>
			<?php
		}else{
	?>
	<a href="produto.php?codigo=<?php echo $row['CODIGO']?>" data-quantity="1" class="button product_type_simple  ajax_add_to_cart" data-product_id="10" data-product_sku="" aria-label="Adicionar “Frist product” no seu carrinho">Comprar</a>
	<?php
		}
	?>
				</div>
				<div  class="nome-empresa">
					<?php echo $row['EMPRESA']?>
				</div>
			</div>
			<?php 
				}
			?>
			</div>
			<div  class="col-10" style="cursor: pointer;" align="center">
				<div class="btn btn-dark" align="center" onclick="mais()">Carregar mais</div>
			</div>
			<script type="text/javascript">
				var init = 10;
				var where = "<?php echo $where?>";
				function mais(){
					init += 10;
					$.post(
						"php/get_produtos.php",
						{qtd: init, where: where},
						function (result){
							console.log(result);
							$('#produtos').html(result);
						}
						);
				}
			</script>
		<?php 
	}else{
		include_once('content/404.php');
	}
			include_once('content/footer.php');
		?>