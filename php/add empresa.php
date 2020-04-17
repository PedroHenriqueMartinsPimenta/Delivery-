<?php
		include_once('conexao.php');
		$email = $_POST['email'];
		$nome = $_POST['nome'];
		$telefone = $_POST['telefone'];
		$rua = $_POST['rua'];
		$complemento = $_POST['complemento'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];
		$senha = base64_encode($_POST['senha']);
		$envia = $_POST['envia'];
		$taxa = $_POST['taxa'];
		$momento = date('Y-m-d H:i:s');
		if ($envia == null) {
			$envia = 0;
		}
		echo $envia;
		$sql = "INSERT INTO EMPRESAS(EMAIL, NOME, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, TELEFONE, PASSWORD, ENVIA, TAXA, COMECOU) VALUES('$email','$nome','$rua','$complemento', '$bairro','$cidade','$estado','$telefone','$senha', $envia,$taxa, '$momento')";
		$query = mysqli_query($con, $sql);
		if ($query) {
			session_start();
			$_SESSION['EMAIL'] = $email;
			$_SESSION['SENHA'] = $senha;
			$_SESSION['PERMISSAO'] = 1;
			header('location:../empresas/index.php');
		}else{
			echo mysqli_error($con);
		}
?>