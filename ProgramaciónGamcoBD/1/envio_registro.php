<?php
include 'utils.php';
include 'conexion.php';

function altaEnvio($pedido_id, $direccion, $estado_envio, $fecha_final)
{
    global $con;

    //verifica si el pedido_id existe en la tabla pedidos
    $verificacion = $con->query("SELECT COUNT(*) FROM pedidos WHERE pedido_id = $pedido_id");

    if ($verificacion->fetch_row()[0] > 0) {
        //el pedido_id, se puede insertar en envios
        $sql = "INSERT INTO envios (pedido_id, envio_dir, edo_envio, envio_dateginal) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        $stmt->bind_param("isss", $pedido_id, $direccion, $estado_envio, $fecha_final);

        if ($stmt->execute()) {
            echo "Envío registrado correctamente";
        } else {
            echo "Error al registrar el envío: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: El pedido con ID $pedido_id no existe en la tabla pedidos.";
    }
}



//obitene los ID de pedidos existentes
$result = $con->query("SELECT pedido_id FROM pedidos");
$pedidos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Formulario de Alta de Envío</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Alta de Envío</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pedido_id = $_POST["pedido_id"];
            $direccion = $_POST["direccion"];
            $estado_envio = $_POST["estado_envio"];
            $fecha_final = $_POST["fecha_final"];

            altaEnvio($pedido_id, $direccion, $estado_envio, $fecha_final);
        }
        ?>

        <form method="post">
            <div class="form-group">
                <label for="pedido_id">ID del Pedido:</label>
                <select class="form-control" id="pedido_id" name="pedido_id" required>
                    <?php foreach ($pedidos as $pedido) : ?>
                        <option value="<?= $pedido['pedido_id'] ?>"><?= $pedido['pedido_id'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección de Envío:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="estado_envio">Estado de Envío:</label>
                <input type="text" class="form-control" id="estado_envio" name="estado_envio" required>
            </div>
            <div class="form-group">
                <label for="fecha_final">Fecha Final:</label>
                <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Envío</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
