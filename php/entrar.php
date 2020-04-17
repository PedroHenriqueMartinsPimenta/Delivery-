<?php
		include_once('conexao.php');
		$email = $_POST['email'];
		$senha = base64_encode($_POST['senha']);
		$id = $_GET['id'];
		if ($id == 0) {
			$sql = "SELECT * FROM CLIENTES WHERE EMAIL = '$email'";
		}else if ($id == 1) {
			$sql = "SELECT * FROM EMPRESAS WHERE EMAIL = '$email'";
		}
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		if ($row['PASSWORD'] == $senha) {
			session_start();
			$_SESSION['EMAIL'] = $email;
			$_SESSION['SENHA'] = $senha;
			$_SESSION['PERMISSAO'] = $id;
			if ($id == 0) {
				header('location:../');
			}else if ($id == 1) {
				header('location:../empresas/index.php');
			}
		}else{
			?>
				<script type="text/javascript">
					alert("Dados incorretos");
					window.location.href= '../login.php';
				</script>
			<?php
		}
	?>