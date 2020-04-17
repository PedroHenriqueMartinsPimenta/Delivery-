<?php
		include_once('../content/config.php'); 
		include_once('conexao.php');
		
		$img_name = $_FILES['img']['name'];
		$img = $_FILES['img']['tmp_name'];
		$codigo = $_GET['codigo'];
		$momento = date('Y_m_d_H_i_s');
		mkdir('../assert/'.$momento);
		move_uploaded_file($img, '../assert/'.$momento.'/'.basename($img_name));
		$urlUpload = $url.'assert/'.$momento.'/'.basename($img_name);
		
		$sql = "UPDATE PRODUTOS SET ICON = '$urlUpload' WHERE CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		if ($query) {
				?>
					<script type="text/javascript">
						alert('Atualizado com sucesso!');
						window.location.href='../empresas/view_produtos.php';
					</script>
				<?php
		}else{
			echo mysqli_error($con);
		}
	?>