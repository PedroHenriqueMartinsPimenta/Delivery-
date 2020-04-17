<?php
	session_start();
	$posicao = $_GET['posicao'];
	unset($_SESSION['CARRINHO'][$posicao]);
	header('location:../carrinho.php');
?>