<?php
	session_start();
	$codigo = $_GET['codigo'];
	$qtd = $_POST['quantidade'];
	if (isset($_POST['obs'])) {
		$obs = $_POST['obs'];
	}else{
		$obs = null;
	}
	$email = $_GET['email'];
	$add = true;
	foreach ($_SESSION['CARRINHO'] as $key => $value) {
		if($value[0] == $codigo){
			$_SESSION['CARRINHO'][$key][1] += $qtd;
			$add = false;
			break;
		}
	}
	if($add){
		$_SESSION['CARRINHO'][sizeof($_SESSION['CARRINHO'])] = array($codigo, $qtd,$email, $obs);
	}
	header('location:../produto.php?codigo='.$codigo);
?>