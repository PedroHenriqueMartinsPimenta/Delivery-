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

		$sql = "UPDATE CLIENTES SET NOME = '$nome', SOBRENOME = '$sobrenome', TELEFONE = '$telefone', RUA = '$rua', COMPLEMENTO = '$complemento', BAIRRO = '$bairro', CIDADE = '$cidade', ESTADO = '$estado' WHERE EMAIL = '$email'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			?>
				<script type="text/javascript">
					alert("Dados atualizados com sucesso!");
					window.location.href= '../clientes/minha_conta.php';
				</script>
			<?php
		}else{
			echo mysqli_error($con);
		}
?>