<?php
	include_once('../content/config.php');
	include_once('../php/conexao.php');
	include_once('../content/header.php');
	$email = $_SESSION['EMAIL'];
	if(isset($_SESSION['EMAIL']) && $_SESSION['PERMISSAO'] == 1){
?>
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
<div class="col-12" style="overflow: auto">
	
	<script type="text/javascript">

		// Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        <?php 
          $sql = "";
        ?>
        data.addRows(<?php
        	$ano = date('Y');
        	$arrayMeses = array("Janeiro","Fervereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
				$sql = "SELECT MONTH(COMPRAS.MOMENTO) AS MES, SUM(PRODUTOS.PRECO * ITENS.QUANTIDADE) AS VALOR FROM COMPRAS INNER JOIN ITENS ON COMPRAS.CODIGO = ITENS.COMPRAS_CODIGO INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO WHERE PRODUTOS.EMPRESAS_EMAIL = '$email' AND YEAR(COMPRAS.MOMENTO) = $ano GROUP BY MONTH(COMPRAS.MOMENTO) ORDER BY VALOR DESC";
				$query = mysqli_query($con, $sql);
				$array = array();
				$i = 0;
				while ($row = mysqli_fetch_array($query)) {
					$array[$i] = array($arrayMeses[$row['MES'] - 1]."- R$ ".$row['VALOR'], intval($row['VALOR']));
					$i++;
				}
				echo json_encode($array);
			?>);

        // Set chart options
        var options = {'title':'Vendas nos meses deste ano',
                       'width':700,
                       'height':700};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('graficoMes'));
        chart.draw(data, options);


        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        <?php 
          $sql = "";
        ?>
        data.addRows(<?php
       			$mes = date('m');
       			$arraySemana = array("Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado");
				$sql = "SELECT DATE_FORMAT(COMPRAS.MOMENTO,'%w') AS MES, SUM(PRODUTOS.PRECO * ITENS.QUANTIDADE) AS VALOR FROM COMPRAS INNER JOIN ITENS ON COMPRAS.CODIGO = ITENS.COMPRAS_CODIGO INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO WHERE PRODUTOS.EMPRESAS_EMAIL = '$email' AND MONTH(COMPRAS.MOMENTO) = $mes AND YEAR(COMPRAS.MOMENTO) = $ano  GROUP BY DATE_FORMAT(COMPRAS.MOMENTO, '%w') ORDER BY VALOR DESC";
				$query = mysqli_query($con, $sql);
				$array = array();
				$i = 0;
				while ($row = mysqli_fetch_array($query)) {
					$array[$i] = array($arraySemana[$row['MES']]."- R$ ".$row['VALOR'], intval($row['VALOR']));
					$i++;
				}
				echo json_encode($array);
			?>);
        // Set chart options
        var options = {'title':'Vendas nos dias da semana desse mes',
                       'width':700,
                       'height':700};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('graficoDiasSemana'));
        chart.draw(data, options);


         // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        <?php 
          $sql = "";
        ?>
        data.addRows(<?php

				$sql = "SELECT PRODUTOS.NOME, SUM(ITENS.QUANTIDADE) AS TOTAL, PRODUTOS.PRECO FROM COMPRAS INNER JOIN ITENS ON COMPRAS.CODIGO = ITENS.COMPRAS_CODIGO INNER JOIN PRODUTOS ON ITENS.PRODUTOS_CODIGO = PRODUTOS.CODIGO WHERE PRODUTOS.EMPRESAS_EMAIL = '$email' AND YEAR(COMPRAS.MOMENTO) = $ano GROUP BY PRODUTOS.CODIGO ORDER BY TOTAL DESC";
				$query = mysqli_query($con, $sql);
				echo(mysqli_error($con));
				$array = array();
				$i = 0;
				while ($row = mysqli_fetch_array($query)) {
					$array[$i] = array($row['NOME']." - ".$row['TOTAL']." unidades", intval($row['TOTAL']));
					$i++;
				}
				echo json_encode($array);
			?>);
        // Set chart options
        var options = {'title':'Vendas de produtos neste ano',
                       'width':700,
                       'height':700};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('graficoProdutos'));
        chart.draw(data, options);
    }

	</script>
	<div id="graficoMes">
		
	</div>

	<div id="graficoDiasSemana"></div>

	<div id="graficoProdutos"></div>
</div>
<?php
	}else{
		include_once('../content/404.php');
	}
	include_once('../content/footer.php');
?>