<?php 
		include_once('conexao.php');
		$codigo = $_GET['codigo'];
		$sql = "SELECT * FROM COMPRAS WHERE CODIGO = $codigo AND STATUS = 1";
		$queryS = mysqli_query($con, $sql);
		if(mysqli_num_rows($queryS) > 0){
		$sql = "SELECT * FROM ITENS WHERE COMPRAS_CODIGO = $codigo";
		$query3 = mysqli_query($con, $sql);

		while ($row = mysqli_fetch_array($query3)) {
			$sql = "UPDATE PRODUTOS SET QUANTIDADE = QUANTIDADE + ".$row['QUANTIDADE']." WHERE CODIGO = ".$row['PRODUTOS_CODIGO'];
			$query0 = mysqli_query($con, $sql);
		}
		
		if ($query0) {
			$sql = "DELETE FROM ITENS WHERE COMPRAS_CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "DELETE FROM COMPRAS WHERE CODIGO = $codigo";
				$query1 = mysqli_query($con, $sql);
				if ($query1) {
					header('location:../clientes/minhas_compras.php');
				}
			}
		}
	}else{
		?>
			<script type="text/javascript">
				alert("Não pode ser mais cancelada!");
				window.location.href = '../clientes/minhas_compras.php';
			</script>
		<?php
	}
		echo mysqli_error($con);
	
?>