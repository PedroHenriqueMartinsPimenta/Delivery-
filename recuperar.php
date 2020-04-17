<?php 
		include_once('content/config.php');
		include_once('php/conexao.php');
		include_once('content/header.php');
		?>
				<h2>Login - CLIENTE</h2>
				<form action="<?php echo $url?>php/recuperar_senha.php" method="post">
					<label>E-mail:</label>
					<input type="email" name="email">

					<input type="checkbox" name="cliente" value="1"> Recuperar a de cliente<br>
					<input type="checkbox" name="empresa" value="1"> Recuperar a de minha empresa<br>
					<input type="submit" value="Recuperar" style="margin-top: 10px">
				</form>
				
			<?php 
		include_once('content/footer.php');
		?>