<?php
	session_start();
	include_once('conexao.php');
	$momento = $_GET['momento'];
	$email = $_SESSION['EMAIL'];
	$mostrar = false;
	$email_empresa = array();
	$i = 0;
	foreach ($_SESSION['CARRINHO'] as $A => $V) {
		if(isset($email_empresa[$i])){
	if ($V[2] != $email_empresa[$i]) {
		echo "foi";
		$email_empresa[$i+1] = $V[2];
		$i++;
	}
}else{
	$email_empresa[$i] = $V[2];
}
}

foreach ($email_empresa as $index => $valor) {
	$sql = "INSERT INTO COMPRAS(MOMENTO, CLIENTES_EMAIL) VALUES('$momento','$email')";
	$query = mysqli_query($con, $sql);
	if ($query) {

		$sql = "SELECT * FROM COMPRAS WHERE MOMENTO = '$momento' AND CLIENTES_EMAIL = '$email' ORDER BY CODIGO DESC";
		$query1  = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query1);
		$codigo = $row['CODIGO'];
		foreach ($_SESSION['CARRINHO'] as $key => $value) {
			if ($value[2] == $email_empresa[$index]) {
				$produto = $value[0];
				$sql = "SELECT * FROM PRODUTOS WHERE CODIGO = $produto";
				$query3 = mysqli_query($con, $sql);
				$row3 = mysqli_fetch_array($query3);
				if ($row3['QUANTIDADE'] - $value[1] >= 0 ) {
				
				$sql = "INSERT INTO ITENS(PRODUTOS_CODIGO, COMPRAS_CODIGO, QUANTIDADE, OBS) VALUES($produto, $codigo, $value[1], '$value[3]')";
				$query2 = mysqli_query($con, $sql);
				if ($query2) {
					$sql = "UPDATE PRODUTOS SET QUANTIDADE = QUANTIDADE - $value[1] WHERE CODIGO = $produto";
					$query3 = mysqli_query($con, $sql);
					if ($query3) {
							
					}
				}
			}else{
				$mostrar = true;
			}
		}
	}
}

}
	echo mysqli_error($con);
	$_SESSION['CARRINHO'] = array();
	if ($mostrar) {
		?>
			<script type="text/javascript">
				alert("Produtos com estoque insuficiente!");
				window.location.href = '../clientes/minhas_compras.php';
			</script>
		<?php
	}else{
		header('location: ../clientes/minhas_compras.php');
	}
?>