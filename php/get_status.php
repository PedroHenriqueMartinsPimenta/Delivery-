<?php 
		include_once('conexao.php');
		$codigo = $_POST['codigo'];
		$sql = "SELECT * FROM COMPRAS WHERE CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		echo json_encode($row['STATUS']);
?>