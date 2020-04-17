<?php 
		include_once('conexao.php');
		$email = $_POST['email'];
		if (isset($_POST['cliente'])) {
			$sql = "SELECT * FROM CLIENTES WHERE EMAIL = '$email'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			mail($email, "Recuperação de senha", "Caro cliente, a recuperação de senha foi solicitada ao senhor, em virtude disto estamos lhe enviando este E-mail com sua atual senha! senha: ".base64_decode($row['PASSWORD']));
		}

		if (isset($_POST['empresa'])) {
			$sql = "SELECT * FROM EMPRESAS WHERE EMAIL = '$email'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			mail($email, "Recuperação de senha", "Caro cliente, a recuperação de senha foi solicitada ao senhor, em virtude disto estamos lhe enviando este E-mail com sua atual senha! senha: ".base64_decode($row['PASSWORD']));
		}

	?>
	<script type="text/javascript">
		alert('E-mail enviado!');
		window.location.href = '../login.php';
	</script>
