<?php 
		include_once('content/config.php');
		include_once('php/conexao.php');
		include_once('content/header.php');
		?>
				<a href="cadastrar.php" style="float: right;">Ainda não sou cadastrado!</a>
				<h2>Login - CLIENTE</h2>
				<form action="<?php echo $url?>php/entrar.php?id=0" method="post">
					<label>E-mail:</label>
					<input type="email" name="email">

					<label>Senha:</label>
					<input type="password" name="senha">
					<a href="recuperar.php" style="float: right; margin-top: 5px">Esqueci minha senha</a><br>
					<input type="submit" value="Entrar" style="margin-top: 10px">
				</form>
				<hr>
				<h2>Login - EMPRESA</h2>
				<form action="<?php echo $url?>php/entrar.php?id=1" method="post">
					<label>E-mail:</label>
					<input type="email" name="email">

					<label>Senha:</label>
					<input type="password" name="senha">
					<a href="recuperar.php" style="float: right; margin-top: 5px">Esqueci minha senha</a><br>
					<input type="submit" value="Entrar" style="margin-top: 10px">
				</form>
			<?php 
		include_once('content/footer.php');
		?>