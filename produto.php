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
?>

<?php 
	$codigo = $_GET['codigo'];
	$sql = "SELECT PRODUTOS.ICON, PRODUTOS.NOME, PRODUTOS.DESCRICAO, PRODUTOS.PRECO, PRODUTOS.QUANTIDADE, PRODUTOS.OBS_PRODUTOS, EMPRESAS.NOME AS EMPRESA, EMPRESAS.RUA, EMPRESAS.COMPLEMENTO,EMPRESAS.BAIRRO, EMPRESAS.CIDADE, EMPRESAS.EMAIL AS EMPRESAS_EMAIL, EMPRESAS.ESTADO,EMPRESAS.ENVIA, EMPRESAS.TAXA, CATEGORIAS.CODIGO AS CATEGORIAS_CODIGO, CATEGORIAS.NOME AS CATEGORIA, PRODUTOS.AFILIACAO, PRODUTOS.URL, PRODUTOS.DOLAR  FROM PRODUTOS INNER JOIN EMPRESAS ON PRODUTOS.EMPRESAS_EMAIL = EMPRESAS.EMAIL INNER JOIN CATEGORIAS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO WHERE PRODUTOS.CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	if (mysqli_num_rows($query)>0) {
	$row = mysqli_fetch_array($query);
?>

			<script type="text/javascript">
				$('a[rel="home"]').html("<?php echo $row['EMPRESA']?>");
			</script>
<div class="wc-content">
						                    <div class="woocommerce-notices-wrapper"></div><div id="product-10" class="product type-product post-10 status-publish first instock product_cat-alimento has-post-thumbnail shipping-taxable purchasable product-type-simple">

	<div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4" style="opacity: 1;">
	<figure class="woocommerce-product-gallery__wrapper">
		<div class="woocommerce-single-product-slider owl-carousel owl-loaded owl-drag">
					<div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 738px;"><div class="owl-item active" style="width: 359px; margin-right: 10px;"><div data-thumb="<?php echo $row['ICON']?>" data-thumb-alt="" class="woocommerce-product-gallery__image"><a href="<?php echo $row['ICON']?>"><img width="600" height="338" src="<?php echo $row['ICON']?>" class="wp-post-image" alt="" title="banner-5" data-caption="" data-src="<?php echo $row['ICON']?>" data-large_image="<?php echo $row['ICON']?>" data-large_image_width="1920" data-large_image_height="1080" srcset="<?php echo $row['ICON']?> 1024w" sizes="(max-width: 600px) 100vw, 600px"></a></div></div><div class="owl-item" style="width: 359px; margin-right: 10px;"><div data-thumb="<?php echo $row['ICON']?>" data-thumb-alt="" class="woocommerce-product-gallery__image"></div></div></div></div><div class="owl-nav"></div><div class="owl-dots disabled"></div></div>
	</figure>
	
	
</div>

	<div class="summary entry-summary">
		<h1 class="product_title entry-title"><?php echo $row['NOME']?></h1>
	
<p class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span>
<?php 
		if($row['DOLAR']){
			echo round($row['PRECO'] * $_SESSION['DOLAR'], 2);
		}else{
			echo $row['PRECO'];
		}
	?>
</span></p>

	
	<form class="cart" action="php/add_carrinho.php?codigo=<?php echo $codigo?> &email=<?php echo $row['EMPRESAS_EMAIL']?>" method="post" enctype="multipart/form-data">
		
			<div class="quantity">
		<label class="screen-reader-text" for="quantity_5dce9c1d87d72">Frist product quantity</label>
		<?php
			if ($row['AFILIACAO'] == 0) {
			
		?>
		<button type="button" class="tf-qty-button minus" ><img src="img/seta.png" width="80%" style="transform: rotate(180deg);"></button>
		<input type="number" id="quantity_5dce9c1d87d72" class="input-text qty text" step="1" min="1" max="<?php echo $row['QUANTIDADE']?>" name="quantidade" value="1" title="Qty" size="4" inputmode="numeric">
		<button type="button" class="tf-qty-button plus"><img src="img/seta.png" width="80%"></button>
		<?php
			if (isset($row['OBS_PRODUTOS'])) {
			
		?>
		<input type="text" name="obs" placeholder="<?php echo $row['OBS_PRODUTOS']?>" class="mt-1 mb-1">
		<?php
		}
			}
		?>
	</div>
		<?php
			if ($row['AFILIACAO'] == 1) {
				?>
				<a href="<?php echo $row['URL']?>" target="_blank"><button type="button" name="add-to-cart" value="10" class="button alt">Comprar</button></a>
				<?php
			}else{
		?>
		<button type="submit" name="add-to-cart" value="10" class="button alt">Add carrinho</button>
			<?php } ?>
			</form>

	
<div class="product_meta">

	
	
	<span class="posted_in"><b>Categoria:</b> <a href="categorias.php?id=<?php echo $row['CATEGORIAS_CODIGO']?>" rel="tag"><?php echo $row['CATEGORIA']?></a></span>
	<span class="posted_in"><b>Empresa:</b> <a href="" rel="tag"><?php echo $row['EMPRESA']?></a></span>
	<?php
		if ($row['AFILIACAO'] == 0 && $row['ENVIA'] == 1) {
			?>
	<span class="posted_in"><b>Entrega:</b> <a href="" rel="tag">
			A empresa faz entrega, taxa de <span style="font-weight: bold;">R$ <?php echo $row['TAXA']?>/KM</span>
			<?php
		}else if($row['AFILIACAO'] == 0){
			?>
	<span class="posted_in"><b>Entrega:</b> <a href="" rel="tag">
			A empresa não faz entrega, necessario retirada do produto diretamente na loja
			<?php
		}
	?></a></span>
	<span class="posted_in"><b>Localização:</b> <a href="#" rel="tag"><?php echo $row['RUA']?>, <?php echo $row['COMPLEMENTO']?>, <?php echo $row['BAIRRO']?>, <?php echo $row['CIDADE']?>-<?php echo $row['ESTADO']?></a></span>
	
	
</div>
	</div>

	
	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">
							<li class="description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
					<a>
						Descrição					</a>
				</li>
							
					</ul>
					<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="display: block;">
				
	<h2>Descrição</h2>

<p><?php echo $row['DESCRICAO']?></p>
			</div>
					<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews panel entry-content wc-tab" id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews" style="display: none;">
				<div id="reviews" class="woocommerce-Reviews">
	

		
	
	<div class="clear"></div>
</div>
			</div>
		
			</div>

</div>

	                				</div>
<script type="text/javascript">
</script>
<?php
	}else{
		include_once('content/404.php');
	}
	include_once('content/footer.php');
?>
<script type="text/javascript">
	$('#secondary').hide();

	window.onload= function(){
		$('.owl-next, .owl-prev').hide();
	}
</script>