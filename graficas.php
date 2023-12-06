<?php
// Conexión a la base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $db = "proyecto";

    $con = new mysqli($servername, $username, $password, $db);

    // Verificar la conexión
    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }

    // Consulta para obtener datos de ventas
    $query = "SELECT proc_name, cantidad FROM productos";
    $result = $con->query($query);

    // Crear un array asociativo con los datos
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convertir el array a formato JSON y devolverlo
    $jsonData = json_encode($data);

    // Cerrar la conexión
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
        }
        .flex {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #fff;
            display: flex;
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
            height: 100vh; /* 100% del viewport height */
        }

        #charts-container {
            display: flex;
        }

        #chart_div1, #chart_div2 {
            width: 600px;
            height: 400px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #chart_div1 {
            margin-right: 10px;
        }
    </style>
</head>
<?php include('header.php'); ?>
<body>
    <div class="flex">
    <div id="charts-container">
        <div id="chart_div1"></div>
        <div id="chart_div2"></div>
    </div>

    <script>
        google.charts.load('current', {'packages':['corechart']});

        // Llamar a la función para dibujar las gráficas después de cargar la librería
        google.charts.setOnLoadCallback(drawCharts);

        // Función para dibujar las gráficas
        function drawCharts() {
            // Obtener datos de PHP usando AJAX
            var jsonData = <?php echo $jsonData; ?>;

            // Convertir datos a formato compatible con Google Charts
            var chartData = [['Producto', 'Cantidad']];
            for (var i = 0; i < jsonData.length; i++) {
                chartData.push([jsonData[i].proc_name, parseInt(jsonData[i].cantidad)]);
            }

            // Crear el objeto de datos para la primera gráfica (por ejemplo, gráfico de barras)
            var data1 = google.visualization.arrayToDataTable(chartData);

            // Configurar opciones para la primera gráfica
            var options1 = {
                title: 'Ventas por Producto',
                is3D: true,
                colors: ['#ff8c00']
            };

            // Crear la primera gráfica (por ejemplo, gráfico de barras)
            var chart1 = new google.visualization.BarChart(document.getElementById('chart_div1'));
            chart1.draw(data1, options1);

            // Crear el objeto de datos para la segunda gráfica (por ejemplo, gráfico de pastel)
            var data2 = google.visualization.arrayToDataTable(chartData);

            // Configurar opciones para la segunda gráfica
            var options2 = {
                title: 'Porcentaje de Ventas por Producto',
                is3D: true,
                colors: ['#1E4770']
            };

            // Crear la segunda gráfica (por ejemplo, gráfico de pastel)
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
        }
    </script>
    </div>
</body>
</html>
