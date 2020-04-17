<?php 
	include_once('conexao.php');
	session_start();
	$senhaAntiga = base64_encode($_POST['senha_antiga']);
	$nova = base64_encode($_POST['senha_nova']);
	$email = $_SESSION['EMAIL'];

	
	
	if($senhaAntiga == $_SESSION['SENHA']){
	if ($_SESSION['PERMISSAO'] == 0) {
		$sql = "UPDATE CLIENTES SET PASSWORD = '$nova' WHERE EMAIL = '$email'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			$_SESSION['SENHA'] = $nova;
			?>
				<script type="text/javascript">
					alert("Dados atualizados com sucesso!");
					window.location.href = '../clientes/minha_conta.php';
				</script>
			<?php
		}
	}else{
		$sql = "UPDATE EMPRESAS SET PASSWORD = '$nova' WHERE EMAIL = '$email'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			$_SESSION['SENHA'] = $nova;
			?>
				<script type="text/javascript">
					alert("Dados atualizados com sucesso!");
					window.location.href = '../empresas/minha_conta.php';
				</script>
			<?php
		}
	}
}else{
	if ($_SESSION['PERMISSAO'] == 0) {
		?>
				<script type="text/javascript">
					alert("Senha incorreta");
					window.location.href = '../clientes/minha_conta.php';
				</script>
			<?php
		
	}else{
		?>
				<script type="text/javascript">
					alert("Senha incorreta");
					window.location.href = '../empresas/minha_conta.php';
				</script>
			<?php
		
	}
}
echo mysqli_error($con);
?>