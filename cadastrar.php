<?php 
		include_once('content/config.php');
		include_once('php/conexao.php');
		include_once('content/header.php');
		?>
				<form action="<?php echo $url?>php/add_cliente.php" method="post">
					<h2 class="page-title">Cadastrar-se como cliente</h2>
					<br>
					<label>Nome:</label>
					<input type="text" required name="nome" placeholder="Nome">
					<label>Sobrenome:</label>
					<input type="text" required name="sobrenome" placeholder="Sobrenome">
					<label>E-mail:</label>
					<input type="text" required name="email" placeholder="E-mail">

					<label>Rua:</label>
					<input type="text" required name="rua" placeholder="Rua">

					<label>Complemento:</label>
					<input type="text" required name="complemento" placeholder="Numero/ proximidade/ referencia">

					<label for="bairro">Bairro:</label>
					<input type="text" name="bairro" id="bairro" placeholder="Bairro">

					<label>Cidade:</label>
					<input type="text" required name="cidade" placeholder="Cidade">

					<label>Estado:</label>
					<input type="text" required name="estado" placeholder="Estado">

					<label>Telefone:</label>
					<input type="text" required name="telefone" placeholder="(99)99999-9999">

					<label>Senha:</label>
					<input type="password" required name="senha" placeholder="Senha">

					<input type="submit" value="Cadastrar-se" style="position: absolute; right: 10px;">
				</form>
				<hr>
				<form action="<?php echo $url?>php/add empresa.php" method="post">
					<h2 class="page-title">Cadastrar-se como empresa</h2>
					<br>
					<label>Nome:</label>
					<input type="text" required name="nome" placeholder="Nome">
					<label>E-mail:</label>
					<input type="text" required name="email" placeholder="E-mail">

					<label>Rua:</label>
					<input type="text" required name="rua" placeholder="Rua">

					<label>Complemento:</label>
					<input type="text" required name="complemento" placeholder="Numero/ proximidade/ referencia">

					<label for="bairro">Bairro:</label>
					<input type="text" name="bairro" id="bairro" placeholder="Bairro">

					<label>Cidade:</label>
					<input type="text" required name="cidade" placeholder="Cidade">

					<label>Estado:</label>
					<input type="text" required name="estado" placeholder="Estado">

					<label>Telefone:</label>
					<input type="text" required name="telefone" placeholder="(99)99999-9999">
					<label>Senha:</label>
					<input type="password" required name="senha" placeholder="Senha">


					<input type="checkbox" name="envia" id="envia" value="1"> <label for="envia">Faço entrega  em casa</label><br>
					<label>Taxa cobrado por Quilometro (<span style="color: red">Caso não faça entrega, mantenha o valor padrão</span>)</label>
					<input type="number" required name="taxa" value="0">
					<input type="submit" value="Cadastrar-se" style="position: absolute; right: 10px;">
				</form>
			<?php 
		include_once('content/footer.php');
		?>