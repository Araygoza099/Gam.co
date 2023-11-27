<?php
include 'utils.php';
include 'conexion.php';

function consultarEnvios() {
    global $con;

    $sql = "SELECT * FROM envios";

    $result = $con->query($sql);

    //verifica si hay resultados
    if ($result->num_rows > 0) {
        //imprime los datos de cada envío
        while ($row = $result->fetch_assoc()) {
            echo "ID de Envío: " . $row["envio_id"] . " - ID de Pedido: " . $row["pedido_id"] . " - Dirección: " . $row["envio_dir"] . " - Estado de Envío: " . $row["edo_envio"] . " - Fecha Final: " . $row["envio_dateginal"] . "<br>";
        }
    } else {
        echo "No se encontraron envíos";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Consulta de Envíos</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Consulta de Envíos</h2>

        <?phpconsultarEnvios();?>

    </div>
    <div class="d-flex justify-content-center align-items-center">
        <?php mostrarBotonInicio(); ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
