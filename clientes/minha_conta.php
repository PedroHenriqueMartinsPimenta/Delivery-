<?php 
		include_once('../content/config.php');
		include_once('../php/conexao.php');
		include_once('../content/header.php');
		if(isset($_SESSION['EMAIL']) && $_SESSION['PERMISSAO'] == 0){
?>
<h2>Meus dados</h2>
	<?php 
		$email = $_SESSION['EMAIL'];
		$sql = "SELECT * FROM CLIENTES WHERE EMAIL = '$email'";
		$query = mysqli_query($con, $sql);
		while ($row = mysqli_fetch_array($query)) {
			?>

			<form action="../php/update_clientes.php" method="post">
				<label>Nome:</label>
					<input type="text" required name="nome" value="<?php echo $row['NOME']?>">
					<label>Sobrenome:</label>
					<input type="text" required name="sobrenome" value="<?php echo $row['SOBRENOME']?>">
					<label>E-mail:</label>
					<input type="text" required name="email" readonly value="<?php echo $row['EMAIL']?>">

					<label>Rua:</label>
					<input type="text" required name="rua" value="<?php echo $row['RUA']?>">

					<label>Complemento:</label>
					<input type="text" required name="complemento" value="<?php echo $row['COMPLEMENTO']?>">

					<label for="bairro">Bairro:</label>
					<input type="text" name="bairro" id="bairro" placeholder="Bairro" value="<?php echo $row['BAIRRO']?>">

					<label>Cidade:</label>
					<input type="text" required name="cidade" value="<?php echo $row['CIDADE']?>">

					<label>Estado:</label>
					<input type="text" required name="estado" value="<?php echo $row['ESTADO']?>">

					<label>Telefone:</label>
					<input type="text" required name="telefone" value="<?php echo $row['TELEFONE']?>">


					<input type="submit" value="Atualizar" style="margin-top: 10px">
				</form>
					<hr>
				<h2>Senha</h2>
				<form action="../php/atualizar_senha.php" method="post">
					<label>Informe sua atual senha</label>
					<input type="password" name="senha_antiga">
					<label>Informe sua nova senha</label>
					<input type="password" name="senha_nova">
					<input type="submit" value="Atualizar" style="margin-top: 10px">
				</form>
			<?php
		}
	?>

<?php
		}else{
			include_once('../content/404.php');
		}
		include_once('../content/footer.php');
	
?>