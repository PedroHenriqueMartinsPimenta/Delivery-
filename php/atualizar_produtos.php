<?php
		include_once('conexao.php');
		$codigo = $_GET['codigo'];
		$nome = $_POST['nome'];
		$descricao = str_replace("\n", "<br>", $_POST['descricao']);
		$preco = $_POST['preco'];
		$quantidade = $_POST['quantidade'];
		$obs = $_POST['obs'];
		$disponivel = $_POST['disponivel'];
		$categoria = $_POST['categoria'];
		$afiliado = $_POST['afiliado'];
		$url = $_POST['url'];
		if (isset($_POST['dolar'])) {
			$dolar = 1;
		}else{
			$dolar = 0;
		}

		$sql = "UPDATE PRODUTOS SET NOME = '$nome', DESCRICAO = '$descricao', PRECO = $preco, QUANTIDADE = $quantidade, CATEGORIAS_CODIGO = $categoria, DISPONIVEL = $disponivel, AFILIACAO = $afiliado, URL = '$url', DOLAR = $dolar, OBS_PRODUTOS = '$obs' WHERE CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		if ($query) {
			?>
				<script type="text/javascript">
					alert("Dados atualizados com sucesso!");
					window.location.href = "../empresas/view_produtos.php";
				</script>
			<?php
		}else{
				echo mysqli_error($con);
		}
?>