<?php
	include_once('../content/config.php');
	include_once('../php/conexao.php');
	include_once('../content/header.php');
	if(isset($_SESSION['EMAIL']) && $_SESSION['PERMISSAO'] == 1){
?>

<style type="text/css">
	.img{
		width: 200px;
		height: 200px;
		background-image: url(../img/seta.png);
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
		
	}
</style>

<div  class="col-12" style="text-align: right; padding: 20px; border:1px solid rgba(20,20,20,0.5)">
	<a href="view_produtos.php"><div class="btn btn-success col-12" style="padding: 20px; cursor: pointer;">Visualizar produtos</div></a>
</div>
<h2 style="padding: 10px">Cadastrar produto</h2>
<div style="margin-top: 10px">
	<form action="../php/add produto.php" method="post" enctype="multipart/form-data">
		<label class="btn btn-info" for="img" style="cursor: pointer;">Escolha um icone</label>
		<div class="img"></div>
		<input type="file" required name="img" id="img" style="display: none" accept="image/*"><br>
		<label>Nome do produto:</label>
		<input type="text" required name="nome" placeholder="Nome do produto" maxlength="45">
		<label>Descrição do produto:</label>
		<textarea name="descricao" required placeholder="Descrição do produto"></textarea>
		<label>Preço (R$ ou USD):</label>
		<input type="number" required name="preco" placeholder="00.00" step="any">
		<input type="checkbox" name="dolar" value="1"> <label>Valor em dolar</label><br>
		<label>Quantidade:</label>
		<input type="number" required name="quantidade" placeholder="0">
		<label>Observação(<span style="color: red">Opcional</span>):</label>
		<input type="text" name="obs" placeholder="EX.: Qual numeração de sapato desejada?">
		<label>Categoria:</label>
		<select name="categoria" required>
			<?php
				$sql = "SELECT * FROM CATEGORIAS ORDER BY NOME ASC";
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_array($query)) {
					?>
						<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
					<?php
				}
				echo(mysqli_error($con));
			?>
		</select>
		<input type="checkbox" name="afiliado" value="1"> <label>Afiliado</label><br>
		<label>URL(<span style="color: red">Caso seja afiliado</span>):</label>
		<input type="url" name="url">
		<input type="submit" value="Cadastrar" style="margin-top: 10px">
	</form>	
</div>

<script type="text/javascript">
	$(function(){
	 $('#img').change(function(){
	 	console.log(this);
	 	readURL(this);
	 	$('label[for="img"]').text("Foto selecionada");
	 });
	 function readURL(input) {        

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.img').show();
                $('.img').css('background-image','url('+e.target.result+')');
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