<?php
		include_once('conexao.php');
		$email = $_POST['email'];
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$telefone = $_POST['telefone'];
		$rua = $_POST['rua'];
		$complemento = $_POST['complemento'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];
		$senha = base64_encode($_POST['senha']);

		$sql = "INSERT INTO CLIENTES(EMAIL, NOME, SOBRENOME, RUA, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, TELEFONE, PASSWORD) VALUES('$email', '$nome','$sobrenome','$rua','$complemento', '$bairro', '$cidade', '$estado', '$telefone', '$senha')";
		$query = mysqli_query($con, $sql);
		if ($query) {
			session_start();
			$_SESSION['NOME'] = $nome;
			$_SESSION['SOBRENOME'] = $sobrenome;
			$_SESSION['EMAIL'] = $email;
			$_SESSION['PERMISSAO'] = 0;
			header('location:../index.php');
		}else{
			echo mysqli_error($con);
		}
?>