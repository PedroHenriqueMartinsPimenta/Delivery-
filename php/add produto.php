<?php
		include_once('../content/config.php'); 
		include_once('conexao.php');
		session_start();
		$nome = $_POST['nome'];
		$descricao = str_replace("\n", "<br>", $_POST['descricao']);
		$preco = $_POST['preco'];
		$quantidade = $_POST['quantidade'];
		$obs = $_POST['obs'];
		$categoria = $_POST['categoria'];
		if (isset($_POST['afiliado'])) {
			$afiliado = 1;
		}else{
			$afiliado = 0;
		}
		if (isset($_POST['dolar'])) {
			$dolar = 1;
		}else{
			$dolar = 0;
		}
		$url_afiliacao = $_POST['url'];
		$img_name = $_FILES['img']['name'];
		$img = $_FILES['img']['tmp_name'];
		$email = $_SESSION['EMAIL'];
		$momento = date('Y_m_d_H_i_s');
		mkdir('../assert/'.$momento);
		move_uploaded_file($img, '../assert/'.$momento.'/'.basename($img_name));
		$urlUpload = $url.'assert/'.$momento.'/'.basename($img_name);
		
		$sql = "INSERT INTO PRODUTOS (ICON, NOME, DESCRICAO, PRECO, QUANTIDADE, EMPRESAS_EMAIL, CATEGORIAS_CODIGO, AFILIACAO, URL, DOLAR, OBS_PRODUTOS) VALUES('$urlUpload','$nome','$descricao','$preco','$quantidade','$email','$categoria', $afiliado, '$url_afiliacao', $dolar, '$obs')";
		$query = mysqli_query($con, $sql);
		if ($query) {
				?>
					<script type="text/javascript">
						alert('Cadastrado com sucesso!');
						window.location.href='../empresas/produtos.php';
					</script>
				<?php
		}else{
			echo mysqli_error($con);
		}
	?>