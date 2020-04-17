<?php 
	include_once('conexao.php');
	$codigo = $_POST['codigo'];
	$status = $_POST['status'];

	$sql = "UPDATE COMPRAS SET STATUS = $status WHERE CODIGO = $codigo";

	$query = mysqli_query($con, $sql);
	if ($query) {
		echo json_encode(1);
	}else{
		echo json_encode(mysqli_error($con));
	}
?>