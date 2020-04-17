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
		if (sizeof($_SESSION['CARRINHO']) <= 0) {
			?>
				<h2>
					Não tem nenhum produto no carrinho ainda : (
				</h2>
			<?php
		}else{
		?>
			<div class="order_details_inner">
				<h3 id="order_review_heading">Seu pedido</h3>

				
				<div id="order_review" class="woocommerce-checkout-review-order">
					<table class="shop_table woocommerce-checkout-review-order-table">
	<thead>
		<tr>
			<th class="product-name">Produto</th>
			<th class="product-total">Subtotal</th>
		</tr>
	</thead>
	<tbody>
						
						<?php 
							foreach ($arrayProdutos as $key => $value) {
							
						?>
						<tr class="cart_item">
					<td class="product-name">

						<?php echo $value[1]. " " . $value[4]?>&nbsp;						 <strong class="product-quantity">×&nbsp;<?php echo $value[3]?></strong>	
															</td>
					<td class="product-total">
						<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span><?php echo $value[2] * $value[3]?></span>					</td>
				</tr>	
						<?php } ?>
					</tbody>
	<tfoot>

		<tr class="cart-subtotal">
			<th>Subtotal</th>
			<td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span><?php echo $preco?></span></td>
		</tr>

		
		
		
		
		
		<tr class="order-total">
			<th>Total</th>
			<td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span><?php echo $preco?></span></strong> </td>
		</tr>

		
	</tfoot>
</table>

<div id="payment" class="woocommerce-checkout-payment">
			<ul class="wc_payment_methods payment_methods methods">
			<li class="wc_payment_method payment_method_cod">
	<input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" checked="checked" data-order_button_text="" style="display: none;">

	<label for="payment_method_cod">
		Pagamento ao receber 	</label>
			<div class="payment_box payment_method_cod">
			<p>Pagar em dinheiro quando receber o produto ou busca-lo.</p>
		</div>
	</li>
		</ul>
		<div class="form-row place-order">
		<noscript>
			Seu navegador não suporta JavaScript ou ele está desativado. Certifique-se de clicar no botão <em>Atualizar totais</em> antes de finalizar o seu pedido. Você poderá ser cobrado mais do que a quantidade indicada acima, se não fizer isso.			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Atualizar">Atualizar</button>
		</noscript>

			<div class="woocommerce-terms-and-conditions-wrapper">
		<div class="woocommerce-privacy-policy-text"><p>Seus dados pessoais serão usados ​​para processar seu pedido, dar suporte à sua experiência em todo este site e para outros fins descritos em nossa <a href="http://localhost/loja%20mauriti/?page_id=3" class="woocommerce-privacy-policy-link" target="_blank">política de privacidade</a>.</p>
</div>
			</div>
	
		
		<a id="link"><button type="button" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Finalizar compra" data-value="Finalizar compra">Finalizar compra</button></a>
		
		<input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="b1b74da494"><input type="hidden" name="_wp_http_referer" value="/loja%20mauriti/?wc-ajax=update_order_review">	</div>
</div>

				</div>

							</div>
			<script type="text/javascript">
				$("#link").click(function(){
					date = new Date();
					var momento = (date.getYear()+1900)+"-"+(date.getMonth()+1)+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
					window.location.href='../php/comprar.php?momento='+momento;
				});
			</script>
		<?php
	}
		include_once('../content/footer.php');
?>