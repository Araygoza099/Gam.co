<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $db = "proyecto";

    $con = new mysqli($servername, $username, $password, $db);

    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }

    //consulta para obtener datos de productos
    $queryProductos = "SELECT dp.detpedido_id, p.proc_name, dp.detpedido_cantidad FROM det_pedido dp
                   JOIN productos p ON dp.proc_id = p.proc_id
                   WHERE dp.pagado_id IS NOT NULL";
    $resultProductos = $con->query($queryProductos);

    //crea un array asociativo con los datos de productos
    $dataProductos = array();
    while ($rowProductos = $resultProductos->fetch_assoc()) {
        $dataProductos[] = $rowProductos;
    }

    //convierte el array de productos a formato JSON
    $jsonDataProductos = json_encode($dataProductos, JSON_NUMERIC_CHECK);

    //consulta para obtener datos de métodos de pago
    $queryPagos = "SELECT card_name, COUNT(*) as cantidad FROM pagos WHERE card_name != 'Pagar con OXXO' GROUP BY card_name";
    $resultPagos = $con->query($queryPagos);

    //crea un array asociativo con los datos de métodos de pago
    $dataPagos = array();
    while ($rowPagos = $resultPagos->fetch_assoc()) {
        $dataPagos[] = $rowPagos;
    }

    //convierte el array de métodos de pago a formato JSON
    $jsonDataPagos = json_encode($dataPagos);

    $con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas de Ventas</title>
    <!-- Incluir la librería de Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background-color: #1a1a1a;  
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        .flex {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        #charts-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #chart_div1, #chart_div2 {
            position: relative;
            width: 800px;
            height: 400px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #nota {
            position: absolute;
            bottom: -450px;
            right: 320px;
            font-size: 12px;
            color: black;
            margin: 0;
            padding: 5px;
            z-index: 9999; 
        }
    </style>
</head>
<?php include('header.php'); ?>
<body>
    <div class="flex">
        <div id="charts-container">
            <div id="chart_div1"></div>
            <div id="chart_div2"></div>
            <p id="nota">NOTA: Si aparece un nombre de persona en esta gráfica <br> significa que el método de págo es con tarjeta. </p>
        </div>
    </div>

    <script>
        google.charts.load('current', {'packages':['corechart']});

        //llama a la función para dibujar las gráficas después de cargar la librería
        google.charts.setOnLoadCallback(drawCharts);

        //función para dibujar las gráficas
        function drawCharts() {
            //obtiene datos de PHP para productos usando AJAX
            var jsonDataProductos = <?php echo $jsonDataProductos; ?>;
            console.log(jsonDataProductos);

            //filtra los productos que tienen ventas (cantidad > 0) y pagado_id no es NULL
            var productosConVentas = jsonDataProductos.filter(function(producto) {
                return parseInt(producto.detpedido_cantidad) > 0 && producto.pagado_id !== null;
            });

            console.log(productosConVentas);

            //convierte datos de productos a formato compatible con Google Charts
            var chartDataProductos = [['Producto', 'Ventas']];
            for (var i = 0; i < productosConVentas.length; i++) {
                chartDataProductos.push([productosConVentas[i].proc_name, parseInt(productosConVentas[i].detpedido_cantidad)]);
            }

            //crea el objeto de datos para la gráfica de barras
            var data1 = google.visualization.arrayToDataTable(chartDataProductos);

            //configura opciones para la gráfica de barras
            var options1 = {
                title: 'Ventas por Producto',
                is3D: true,
                colors: ['#ff8c00'],
                hAxis: {
                    showTextEvery: 1
                },
                // Añade la opción de tooltip para mostrar el nombre del producto
                tooltip: { trigger: 'selection' } 
            };

            //crea la gráfica de barras
            var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
            chart1.draw(data1, options1);

            //obtiene datos de PHP para métodos de pago usando AJAX
            var jsonDataPagos = <?php echo $jsonDataPagos; ?>;

            //convierte datos de métodos de pago a formato compatible con Google Charts
            var chartDataPagos = [['Método de Pago', 'Cantidad']];
            for (var j = 0; j < jsonDataPagos.length; j++) {
                chartDataPagos.push([jsonDataPagos[j].card_name, parseInt(jsonDataPagos[j].cantidad)]);
            }

            //crea el objeto de datos para la gráfica circular (gráfico de pastel)
            var data2 = google.visualization.arrayToDataTable(chartDataPagos);

            //configura opciones para la gráfica circular
            var options2 = {
                title: 'Porcentaje de Uso de Métodos de Pago',
                is3D: true
            };

            //crea la gráfica circular (gráfico de pastel)
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
        }
    </script>
</body>
</html>