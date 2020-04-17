<?php 
session_start();
if (!isset($_SESSION['ACCESS'])) {
	$_SESSION['CARRINHO'] = array();
	$_SESSION['ACCESS'] = 1;
}
$preco = 0;
$a = 0;
$arrayProdutos = array();
if(sizeof($_SESSION['CARRINHO']) > 0){
	foreach ($_SESSION['CARRINHO'] as $i => $value) {
		if(isset($_SESSION['CARRINHO'][$i])){
		$sql = "SELECT * FROM PRODUTOS WHERE CODIGO = ".$_SESSION['CARRINHO'][$i][0];
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$preco += $row['PRECO'] * $_SESSION['CARRINHO'][$i][1];
		$arrayProdutos[$a] = array($row['ICON'], $row['NOME'], $row['PRECO'], $_SESSION['CARRINHO'][$i][1], $value[3]);
		$a++;
	}
	}
}
		
?>
<!DOCTYPE html>
<!-- saved from url=(0032)<?php echo $url?> -->
<html lang="pt-BR"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script data-ad-client="ca-pub-4138885471652745" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="<?php echo $url?>jquery-ui-1.12.1/jquery-3.3.1.js"></script>
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<title><?php echo $siteName?> – <?php echo $siteFrase?></title>
	
	<meta name="description" content="Go Compras, venha encontrar as melhores lojas perto de você com apenas 1 clique">
	<meta name="keywords" content="delivery, Go Compras - delivery, Go Compras, compras inteligentes, lojas perto, fazer delivery, compras rápidas, preço barato, preço bom, smartphone, tenis, moleca, samsung, iphone, xiaomi, moleca, vizzano">
	<meta name="robots"  content="index, follow">
<link rel="dns-prefetch" href="http://fonts.googleapis.com/">
<link rel="dns-prefetch" href="http://s.w.org/">
<link rel="alternate" type="application/rss+xml" title="Feed para LM - Lojas Mauriti »" href="<?php echo $url?>index.php/feed/">
<link rel="alternate" type="application/rss+xml" title="Feed de comentários para LM - Lojas Mauriti »" href="<?php echo $url?>index.php/comments/feed/">
<link rel="alternate" type="application/rss+xml" title="Feed de LM - Lojas Mauriti » Produtos" href="<?php echo $url?>index.php/shop/feed/">
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/localhost\/loja%20mauriti\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.2.4"}};
			!function(a,b,c){function d(a,b){var c=String.fromCharCode;l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,a),0,0);var d=k.toDataURL();l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,b),0,0);var e=k.toDataURL();return d===e}function e(a){var b;if(!l||!l.fillText)return!1;switch(l.textBaseline="top",l.font="600 32px Arial",a){case"flag":return!(b=d([55356,56826,55356,56819],[55356,56826,8203,55356,56819]))&&(b=d([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]),!b);case"emoji":return b=d([55357,56424,55356,57342,8205,55358,56605,8205,55357,56424,55356,57340],[55357,56424,55356,57342,8203,55358,56605,8203,55357,56424,55356,57340]),!b}return!1}function f(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var g,h,i,j,k=b.createElement("canvas"),l=k.getContext&&k.getContext("2d");for(j=Array("flag","emoji"),c.supports={everything:!0,everythingExceptFlag:!0},i=0;i<j.length;i++)c.supports[j[i]]=e(j[i]),c.supports.everything=c.supports.everything&&c.supports[j[i]],"flag"!==j[i]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[j[i]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(h=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",h,!1),a.addEventListener("load",h,!1)):(a.attachEvent("onload",h),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),g=c.source||{},g.concatemoji?f(g.concatemoji):g.wpemoji&&g.twemoji&&(f(g.twemoji),f(g.wpemoji)))}(window,document,window._wpemojiSettings);
		</script><script src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/wp-emoji-release.min.js.download" type="text/javascript" defer=""></script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;

}
img[alt='www.000webhost.com']{
	display: none;
}
</style>
	<link rel="stylesheet" id="wp-block-library-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/style.min.css" type="text/css" media="all">
<link rel="stylesheet" id="wc-block-style-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/style.css" type="text/css" media="all">
<link rel="stylesheet" id="woocommerce-layout-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/woocommerce-layout.css" type="text/css" media="all">
<link rel="stylesheet" id="woocommerce-smallscreen-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/woocommerce-smallscreen.css" type="text/css" media="only screen and (max-width: 768px)">
<link rel="stylesheet" id="woocommerce-general-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/woocommerce.css" type="text/css" media="all">
<style id="woocommerce-inline-inline-css" type="text/css">
.woocommerce form .form-row .required { visibility: visible; }
</style>
<link rel="stylesheet" id="newstore-google-font-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/css" type="text/css" media="all">
<link rel="stylesheet" id="animate-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/animate.min.css" type="text/css" media="all">
<link rel="stylesheet" id="bootstrap-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/bootstrap.min.css" type="text/css" media="all">
<link rel="stylesheet" id="owl-carousel-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/owl.carousel.min.css" type="text/css" media="all">
<link rel="stylesheet" id="owl-theme-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/owl.theme.default.min.css" type="text/css" media="all">
<link rel="stylesheet" id="simplelightbox-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/simplelightbox.min.css" type="text/css" media="all">
<link rel="stylesheet" id="font-awesome-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/font-awesome.min.css" type="text/css" media="all">
<link rel="stylesheet" id="newstore-main-nav-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/main-nav.css" type="text/css" media="all">
<link rel="stylesheet" id="newstore-google-fonts-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/css(1)" type="text/css" media="all">
<link rel="stylesheet" id="newstore-style-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/style(1).css" type="text/css" media="all">
<link rel="stylesheet" id="newshop-ecommerce-style-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/style(2).css" type="text/css" media="all">
<link rel="stylesheet" id="newstore-media-style-css" href="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/media-style.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/jquery.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/jquery-migrate.min.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/owl.carousel.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/simple-lightbox.min.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/popper.min.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/bootstrap.min.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/jquery.ez-plus-custom.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/jquery.sticky-sidebar.min.js.download"></script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/skip-link-focus-fix.js.download"></script>
<script type="text/javascript">
/* <![CDATA[ */
var newstore_script_obj = {"rtl":"","sticky_header":"1"};
/* ]]> */
</script>
<script type="text/javascript" src="<?php echo $url?>LM – Lojas Mauriti – Só mais um site WordPress_files/custom-script.js.download"></script>
<!--[if lt IE 9]>
<script type='text/javascript' src='<?php echo $url?>wp-content/themes/newstore/js/respond.min.js?ver=5.2.4'></script>
<![endif]-->
<!--[if lt IE 9]>
<script type='text/javascript' src='<?php echo $url?>wp-content/themes/newstore/js/html5shiv.js?ver=5.2.4'></script>
<![endif]-->
<link rel="https://api.w.org/" href="<?php echo $url?>index.php/wp-json/">
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo $url?>xmlrpc.php?rsd">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo $url?>wp-includes/wlwmanifest.xml"> 
<meta name="generator" content="WordPress 5.2.4">
<meta name="generator" content="WooCommerce 3.8.0">
<meta name="referrer" content="always">	<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
	<script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script></head>

<body class="home archive post-type-archive post-type-archive-product theme-newstore woocommerce woocommerce-page woocommerce-js hfeed full woocommerce-active">
<div id="page" class="site">
	

	<header id="masthead" class="site-header">
  	<div class="header-topbar">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-small-center text-left">        </div>
				<div class="col-md-6 text-small-center text-right">
										    <ul class="header-topbar-links">
            </ul>
    				</div>
			</div>
		</div>
	</div>
	<div class="header-middle">
		<div class="container">
		<div class="row align-items-center">
	<div class="header-branding col-md-4 col-sm-12 text-sm-center mx-auto">
		<div class="site-branding">
							<h1 class="site-title"><a href="<?php echo $url?>" rel="home"><?php echo $siteName?></a></h1>
								<p class="site-description"><?php echo $siteFrase?></p>
					</div><!-- .site-branding -->
	</div>
	<div class="header-search-and-cart col-md-8 col-sm-12 sm-text-center mx-auto">
		<div class="row">
			<div class="col header-wcsearch-form-container mx-auto">
				<form role="search" method="get" class="search-form nestore-search-form d-block w-100" autocomplete="off" action="<?php echo $url?>pesquisa.php">
	<div class="w-100 search-form-inner">
		<div class="search-form-cat-container">
		<select name="tipo" id="product_cat" class="search-form-categories">
	<option value="0">Produtos</option>
	<option value="1">Empresas</option>
</select>
		</div>
		<input type="search" class="input-text main-input-search tfwctool-auto-ajaxsearch-input" placeholder="Search " value="" name="pesquisa" title="Search for:" autcomplete="false">
		<span class="search-spinner"><i class="fa fa-refresh fa-spin"></i></span>
		<input type="hidden" name="post_type" value="product">
		<button type="submit" class="main-search-submit"><img src="<?php echo $url?>img/lupa.png" width="20px"></button>
	</div>
</form>			</div>
			<div class="header-cart-withlist-links-container text-right text-md-right text-sm-center mx-auto">
				<div class="header-cart-withlist-links-container-inner">
					<div class="header-wishlist-container">
											</div>
					<div class="header-cart-container">
										<div id="site-header-cart" class="site-header-cart woocommerce">
			<div class="site-header-cart-inner">
						<a class="cart-link-contents" href="<?php echo $url?>carrinho.php">
			<div class="header-cart-top-link-left">
			<span class="icon"><img src="<?php echo $url?>img/carrinho.png"></span>
			<span class="count"><?php echo sizeof($_SESSION['CARRINHO']) ?></span>
			</div>
			<div class="header-cart-top-link-right">
				<div class="label">Total</div>
				<div class="amount"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span><?php echo $preco?></span></div>
			</div>
		</a>
						<div class="header-cart-conetnts">
					<div class="header-cart-top">
										<div class="header-cart-top-left"><?php echo sizeof($_SESSION['CARRINHO']) ?> items</div>
					<div class="header-cart-top-right"><a class="header-cart-top-link" href="<?php echo $url?>carrinho.php">Visualizar carrinho</a></div>
					</div>
					<div class="header-cart-products">
						

	<p class="woocommerce-mini-cart__empty-message">
			<?php
				if(sizeOf($_SESSION['CARRINHO']) > 0){
					foreach ($arrayProdutos as $i => $value) {
					?>
					<div class="col-12">
							<img src="<?php echo $arrayProdutos[$i][0]?>" width="40px">
							<b><?php echo $arrayProdutos[$i][1]?> - <?php echo $arrayProdutos[$i][3]?> unidades</b>
					</div>
					<hr>
					<?php
				}
				}else{
			?>
			Não tem produtos no carrinho
				<?php
					}
				?>
		</p>


					</div>
				</div>
			</div>
		</div>
		
							</div>
				</div>
			</div>
		</div>
	</div>
</div>		</div>
	</div>
	<div class="header-main">
    	<div class="container">
        	<div class="primary-menu-container">
        		<nav id="site-navigation" class="main-navigation navbar navbar-expand-md navbar-light row" role="navigation">					  	
					<div class="navbar-header sm-order-2">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#TF-Navbar" aria-controls="TF-Navbar" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div id="TF-Navbar" class="collapse navbar-collapse col-md-10 mx-auto sm-order-last">
						<?php
							if (!isset($_SESSION['EMAIL'])) {

						?>
						<ul id="primary-menu" class="nav navbar-nav primary-menu">
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-20 nav-item"><a href="<?php echo $url?>" class="nav-link"><span class="menu-text">Início</span></a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21 nav-item"><a href="<?php echo $url?>login.php" class="nav-link"><span class="menu-text">Minha conta</span></a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22 nav-item"><a href="<?php echo $url?>login.php" class="nav-link"><span class="menu-text">Checkout</span></a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>carrinho.php" class="nav-link"><span class="menu-text">Carrinho</span></a></li>
						</ul>
						<?php
							}else if($_SESSION['PERMISSAO'] == 0) {
								$email = $_SESSION['EMAIL'];
								$sql = "SELECT * FROM CLIENTES WHERE EMAIL = '$email'";
								$query = mysqli_query($con, $sql);
								$row = mysqli_fetch_array($query);
								$cidade = $row['CIDADE'];
								$_SESSION['CIDADE'] = $cidade;
								?>

								<ul id="primary-menu" class="nav navbar-nav primary-menu">
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-20 nav-item"><a href="<?php echo $url?>" class="nav-link"><span class="menu-text">Início</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21 nav-item"><a href="<?php echo $url?>clientes/minha_conta.php" class="nav-link"><span class="menu-text">Minha conta</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22 nav-item"><a href="<?php echo $url?>clientes/checkout.php" class="nav-link"><span class="menu-text">Checkout</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item current_page_item active menu-item-23 nav-item"><a href="<?php echo $url?>clientes/minhas_compras.php" class="nav-link"><span class="menu-text">Minhas compras</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>carrinho.php" class="nav-link"><span class="menu-text">Carrinho</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>php/sair.php" class="nav-link"><span class="menu-text">Sair</span></a></li>
								</ul>
								<?php
							}else if ($_SESSION['PERMISSAO'] == 1) {
								$email = $_SESSION['EMAIL'];
								$sql = "SELECT * FROM EMPRESAS WHERE EMAIL = '$email'";
								$query = mysqli_query($con, $sql);
								$row = mysqli_fetch_array($query);
								$cidade = $row['CIDADE'];
								$_SESSION['NOME'] = $row['NOME'];
								$_SESSION['CIDADE'] = $cidade;
								?>
									<ul id="primary-menu" class="nav navbar-nav primary-menu">
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-20 nav-item"><a href="<?php echo $url?>empresas/index.php" class="nav-link"><span class="menu-text">Pedidos</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21 nav-item"><a href="<?php echo $url?>empresas/minha_conta.php" class="nav-link"><span class="menu-text">Minha conta</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22 nav-item"><a href="<?php echo $url?>empresas/produtos.php" class="nav-link"><span class="menu-text">Produtos</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item current_page_item active menu-item-23 nav-item"><a href="<?php echo $url?>empresas/estatisticas.php" class="nav-link"><span class="menu-text">Estatísticas</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>php/sair.php" class="nav-link"><span class="menu-text">Sair</span></a></li>
									</ul>
								<?php
							}
						?>
</div>					<div class="header-my-account-btn col-4 col-md-2 col-sm-4 text-right sm-order-first">
						<?php
							if (!isset($_SESSION['EMAIL'])) {
							
						?>
						<div class="newstore-myaccount-dropdown dropdown">
							<button class="btn btn-menu-myaccount dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Minha conta
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    	<a class="dropdown-item top-bl-login" href="<?php echo $url?>login.php"> <img src="<?php echo $url?>img/login.jpg" width="20px"> Login </a><a class="dropdown-item top-bl-register" href="cadastrar.php"> <img src="<?php echo $url?>img/add user.png" width="20"> Cadastrar-se </a>
							</div>
						</div>	
						<?php
							}
						?>				</div>
				</nav><!-- #site-navigation -->
            </div>
        </div>
    </div>
        <div id="sticky-header-container"><div class="container"><div class="row align-items-center"><div class="col-2"><div class="site-branding">
							<h1 class="site-title"><a href="<?php echo $url?>" ><?php echo $siteName?></a></h1>
								<p class="site-description"><?php echo $siteFrase?></p>
					</div></div><div class="col"><nav id="site-navigation" class="main-navigation navbar navbar-expand-md navbar-light row" role="navigation">					  	
					<div class="navbar-header sm-order-2">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#TF-Navbar" aria-controls="TF-Navbar" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div id="TF-Navbar" class="collapse navbar-collapse col-md-10 mx-auto sm-order-last">
						<?php
							if (!isset($_SESSION['EMAIL'])) {

						?>
						<ul id="primary-menu" class="nav navbar-nav primary-menu">
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-20 nav-item"><a href="<?php echo $url?>" class="nav-link"><span class="menu-text">Início</span></a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21 nav-item"><a href="<?php echo $url?>login.php" class="nav-link"><span class="menu-text">Minha conta</span></a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22 nav-item"><a href="<?php echo $url?>login.php" class="nav-link"><span class="menu-text">Checkout</span></a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>carrinho.php" class="nav-link"><span class="menu-text">Carrinho</span></a></li>
						</ul>
						<?php
							}else if($_SESSION['PERMISSAO'] == 0) {
								$email = $_SESSION['EMAIL'];
								$sql = "SELECT * FROM CLIENTES WHERE EMAIL = '$email'";
								$query = mysqli_query($con, $sql);
								$row = mysqli_fetch_array($query);
								$cidade = $row['CIDADE'];
								$_SESSION['CIDADE'] = $cidade;
								?>

								<ul id="primary-menu" class="nav navbar-nav primary-menu">
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-20 nav-item"><a href="<?php echo $url?>" class="nav-link"><span class="menu-text">Início</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21 nav-item"><a href="<?php echo $url?>clientes/minha_conta.php" class="nav-link"><span class="menu-text">Minha conta</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22 nav-item"><a href="<?php echo $url?>clientes/checkout.php" class="nav-link"><span class="menu-text">Checkout</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item current_page_item active menu-item-23 nav-item"><a href="<?php echo $url?>clientes/minhas_compras.php" class="nav-link"><span class="menu-text">Minhas compras</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>carrinho.php" class="nav-link"><span class="menu-text">Carrinho</span></a></li>
									<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>php/sair.php" class="nav-link"><span class="menu-text">Sair</span></a></li>
								</ul>
								<?php
							}else if ($_SESSION['PERMISSAO'] == 1) {
								$email = $_SESSION['EMAIL'];
								$sql = "SELECT * FROM EMPRESAS WHERE EMAIL = '$email'";
								$query = mysqli_query($con, $sql);
								$row = mysqli_fetch_array($query);
								$cidade = $row['CIDADE'];
								$_SESSION['NOME'] = $row['NOME'];
								$_SESSION['CIDADE'] = $cidade;
								?>
									<ul id="primary-menu" class="nav navbar-nav primary-menu">
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-20 nav-item"><a href="<?php echo $url?>empresas/index.php" class="nav-link"><span class="menu-text">Pedidos</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21 nav-item"><a href="<?php echo $url?>empresas/minha_conta.php" class="nav-link"><span class="menu-text">Minha conta</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22 nav-item"><a href="<?php echo $url?>empresas/produtos.php" class="nav-link"><span class="menu-text">Produtos</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item current_page_item active menu-item-23 nav-item"><a href="<?php echo $url?>empresas/estatisticas.php" class="nav-link"><span class="menu-text">Estatísticas</span></a></li>
										<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24 nav-item"><a href="<?php echo $url?>php/sair.php" class="nav-link"><span class="menu-text">Sair</span></a></li>
									</ul>
								<?php
							}
						?>
					</div>					
				</nav></div><div class="header-cart-withlist-links-container text-right text-md-right text-sm-center mx-auto">
				<div class="header-cart-withlist-links-container-inner">
					<div class="header-wishlist-container">
											</div>
					<div class="header-cart-container">
										<div id="site-header-cart" class="site-header-cart woocommerce">
			<div class="site-header-cart-inner">
						<a class="cart-link-contents" href="<?php echo $url?>carrinho.php">
			<div class="header-cart-top-link-left">
			<span class="icon"><img src="img/carrinho.png"></span>
			<span class="count"><?php echo sizeof($_SESSION['CARRINHO']) ?></span>
			</div>
			<div class="header-cart-top-link-right">
				<div class="label">Total</div>
				<div class="amount"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$</span><?php echo $preco?></span></div>
			</div>
		</a>
						<div class="header-cart-conetnts">
					<div class="header-cart-top">
										<div class="header-cart-top-left"><?php echo sizeof($_SESSION['CARRINHO']) ?> items</div>
					<div class="header-cart-top-right"><a class="header-cart-top-link" href="<?php echo $url?>carrinho.php">Ver carrinho</a></div>
					</div>
					<div class="header-cart-products">
						

	<p class="woocommerce-mini-cart__empty-message">Não possui nenhum item</p>


					</div>
				</div>
			</div>
		</div>
		
							</div>
				</div>
			</div></div></div></div>
	</header><!-- #masthead -->
	<div id="content" class="site-content"><div class="container-full space blog-post-index">
	<div class="container">
		<div id="primary" class="content-area row justify-content-center woocommerce-container">
			<main id="main" class="site-main wc-site-main order-last">
				