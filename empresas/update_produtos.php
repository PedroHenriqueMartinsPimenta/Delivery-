<?php
		include_once('../content/config.php');
		include_once('../php/conexao.php');
		include_once('../content/header.php');
		$codigo = $_GET['codigo'];

	if(isset($_SESSION['EMAIL']) && $_SESSION['PERMISSAO'] == 1){
		?>
		<style type="text/css">
			.preview{
				width: 150px;
				height: 150px;
				background-size: cover;
				background-repeat: no-repeat;
				background-position: center;
			}
		</style>
		<?php
			$sql = "SELECT  PRODUTOS.ICON,PRODUTOS.DISPONIVEL, PRODUTOS.DESCRICAO, PRODUTOS.NOME, PRODUTOS.PRECO, PRODUTOS.QUANTIDADE, PRODUTOS.CODIGO, CATEGORIAS.NOME AS CATEGORIA, CATEGORIAS.CODIGO AS CATEGORIAS_CODIGO, PRODUTOS.URL, PRODUTOS.AFILIACAO, PRODUTOS.DOLAR,  PRODUTOS.OBS_PRODUTOS FROM PRODUTOS INNER JOIN CATEGORIAS ON PRODUTOS.CATEGORIAS_CODIGO = CATEGORIAS.CODIGO WHERE PRODUTOS.CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			echo mysqli_error($con);
			while ($row = mysqli_fetch_array($query)) {
				?>
				<h3><?php echo $row['NOME']?></h3>
				<form action="../php/atualizar_produtos.php?codigo=<?php echo $row['CODIGO']?>" method="post">
					<label>Nome do produto</label>
					<input type="text" value="<?php echo $row['NOME']?>" name="nome">

					<label>Descrição</label>
					<textarea name="descricao"><?php echo str_replace("<br>", "\n", $row['DESCRICAO'])?></textarea>

					<label>Preço(R$ ou USD):</label>
					<input type="number" name="preco" value="<?php echo $row['PRECO']?>" step="any">
					<?php
						if ($row['DOLAR']) {
							?>
							<input type="checkbox" name="dolar" checked="true"> <label>Valor em dolar</label>
							<?php
						}else{
							?>
							<input type="checkbox" name="dolar"> <label>Valor em dolar</label>
							<?php
						}
					?><br>
					<label>Quantidade</label>
					<input type="number" name="quantidade" value="<?php echo $row['QUANTIDADE']?>">

					<label>Observação(<span style="color: red">Opcional</span>):</label>
					<input type="text" name="obs" placeholder="EX.: Qual numeração de sapato desejada?" value="<?php echo $row['OBS_PRODUTOS']?>">

					<label>Disponibilidade:</label>
					<select name="disponivel">
					<?php
						if ($row['DISPONIVEL'] == 0) {
							?>
								<option value="0">Não estar disponivel</option>
								<option value="1">Estar disponivel</option>
							<?php
						}else{
							?>
								<option value="1">Estar disponivel</option>
								<option value="0">Não estar disponivel</option>
							<?php
						}
					?>
				</select>

				<label>Categoria:</label>
				<select name="categoria">
					<option value="<?php echo $row['CATEGORIAS_CODIGO']?>"><?php echo $row['CATEGORIA']?></option>
					<?php
						$sql = "SELECT * FROM CATEGORIAS WHERE CODIGO != ". $row['CATEGORIAS_CODIGO'];
						$query1 = mysqli_query($con, $sql);
						while ($row1 = mysqli_fetch_array($query1)) {
							?>
								<option value="<?php echo $row1['CODIGO']?>"><?php echo $row1['NOME']?></option>
							<?php
						}
					?>
				</select>
				<label>Afiliado</label>
				<select name="afiliado">
					<?php
						if ($row['AFILIACAO']) {
							?>
							<option value="1">Sim</option>
							<option value="0">Não</option>
							<?php
						}else{
							?>
							<option value="0">Não</option>
							<option value="1">Sim</option>
							<?php
						}
					?>
				</select>
				<label>URL(<span style="color:red">Somente caso for afiliação</span>):</label>
				<input type="url" name="url" value="<?php echo $row['URL']?>">
				<input type="submit" value="Atualizar" style="margin-top: 10px">
				</form>
				<hr>
				<h2>Alterar imagem</h2>

					<div class="preview" style="background-image: url('<?php echo $row['ICON']?>');">
						
					</div>
				<form method="post" action="../php/atualizar_produtos_image.php?codigo=<?php echo $row['CODIGO']?>" enctype="multipart/form-data">
					<label class="btn btn-info" for="img" style="margin-top: 20px;padding: 10px; cursor: pointer;">Selecionar nova foto</label>
					<input type="file" name="img" id="img" style="display: none" accept="IMAGE/*"><br>
					<input type="submit" value="Atualizar" disabled id="newImage" style="padding: 20px; display: none">
				</form>
				<?php
			}
		?>
		<script type="text/javascript">
	$(function(){
	 $('#img').change(function(){
	 	console.log(this);
	 	readURL(this);
	 	$('label[for="img"]').text("Foto selecionada");
	 	$('#newImage').removeAttr('disabled');
	 	$('#newImage').fadeIn('slow');
	 });
	 function readURL(input) {        

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.preview').show();
                $('.preview').css('background-image','url('+e.target.result+')');
               }

            reader.readAsDataURL(input.files[0]);
        }
        }
    });
</script>
		<?php
	}else{
		include_once('../content/404.php');
	}
		include_once('../content/footer.php');
?>