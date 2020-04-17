	</main><!-- #main -->
			<aside id="secondary" class="sidebar-widget-area widget-area woocommerce-widget-area order-first">
	<div id="woocommerce_product_categories-3" class="woocommerce-widget sidebar-widget widget open woocommerce widget_product_categories"><div class="widget-heading"><h3 class="widget-title">Categorias de produto</h3><div class="wc-sidebar-toggle"><img src="<?php echo $url?>/img/seta.png"></div></div><ul class="product-categories">
		<?php 
			$sql = "SELECT CATEGORIAS.CODIGO, CATEGORIAS.NOME, COUNT(PRODUTOS.CODIGO) AS TOTAL FROM CATEGORIAS INNER JOIN PRODUTOS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO WHERE PRODUTOS.DISPONIVEL = 1 AND PRODUTOS.QUANTIDADE > 0 GROUP BY CATEGORIAS.CODIGO ORDER BY TOTAL DESC";
			$query = mysqli_query($con, $sql);

			while ($row = mysqli_fetch_array($query)) {
				?>
					<li ><a href="<?php echo $url?>categorias.php?id=<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?> </a></li>
				<?php
			}
		?>
</ul></div>

</aside><!-- #secondary -->
		</div><!-- #primary -->
	</div>
</div>

	</div><!-- #content -->
	

	<footer id="colophon" class="site-footer footer">
				<div class="footer-site-info site-info text-center">
			<div class="container">
				<span class="copy-text">
				Copyright © <?php echo date('Y')?> <?php echo $siteName?> Todos os direitos reservados.				</span>
							</div>
		</div><!-- .site-info -->
		<a href="http://localhost/loja%20mauriti/#" id="scroll-top" style="display: none;"><img src="<?php echo $url?>img/seta.png" style="width: 30px"></a>
	</footer><!-- #colophon -->
</div><!-- #page -->


<script type="text/javascript" src="./LM – Lojas Mauriti – Só mais um site WordPress_files/mailchimp-woocommerce-public.min.js.download"></script>
<script type="text/javascript" src="./LM – Lojas Mauriti – Só mais um site WordPress_files/wp-embed.min.js.download"></script>



</body></html>	