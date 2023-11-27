<?php
include('conexion.php');
include('utils.php');

//alertas
$alertClass = '';
$alertMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usr_id = $_POST['usr_id'];
    $pedido_id = $_POST['pedido_id'];
    $producto_id = $_POST['producto_id'];
    $card_id = $_POST['card_id'];
    $card_number = $_POST['card_number'];
    $card_thought = $_POST['card_thought'];

    //verifica si el pedido pertenece al usuario
    $check_query = "SELECT * FROM pedidos WHERE pedido_id = '$pedido_id' AND usr_id = '$usr_id'";
    $result = $con->query($check_query);

    if ($result->num_rows > 0) {
        //innserta el pago en la tabla de pagos
        $insert_query = "INSERT INTO pagos (usr_id, pedido_id, card_id, card_number, card_thought) 
                        VALUES ('$usr_id', '$pedido_id', '$card_id', '$card_number', '$card_thought')";

        if ($con->query($insert_query) === TRUE) {
            //actualiza el estado del pedido a 'Pagado'
            $update_query = "UPDATE pedidos SET edo_pedido = 'Pagado' WHERE pedido_id = '$pedido_id'";
            $con->query($update_query);

            //crea el registro en la tabla det_pedido asociado al producto seleccionado
            $insert_det_pedido_query = "INSERT INTO det_pedido (pedido_id, proc_id, detpedido_cantidad, prec_unitario) 
                                        VALUES ('$pedido_id', '$producto_id', 1, (SELECT proc_price FROM productos WHERE proc_id = '$producto_id'))";
            $con->query($insert_det_pedido_query);

            $alertClass = 'alert-success';
            $alertMessage = 'Pago y pedido realizados exitosamente.';
        } else {
            //error en el pago
            $alertClass = 'alert-danger';
            $alertMessage = 'Error al procesar el pago: ' . $con->error;
        }
    } else {
        //pedido no pertenece al usuario
        $alertClass = 'alert-danger';
        $alertMessage = 'Error: El pedido no pertenece al usuario actual.';
    }
}

$sql = "SELECT * FROM productos";
$result = $con->query($sql);

$productosRegistrados = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['precio_con_descuento'] = calcularPrecioConDescuento($row['proc_price'], $row['proc_desc']);
        $productosRegistrados[] = $row;
    }
}

$con->close();

function calcularPrecioConDescuento($precio, $descuento) {
    $precioConDescuento = $precio - ($precio * ($descuento / 100));
    return number_format($precioConDescuento, 2);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Gam.co</title>
</head>
<body>
    <h2>Productos en Existencia</h2>

    <?php if (!empty($alertMessage)) : ?>
        <div class="alert <?php echo $alertClass; ?>" role="alert">
            <?php echo $alertMessage; ?>
        </div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descuento</th>
                <th>Precio</th>
                <th>Precio con Descuento</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($productosRegistrados as $producto): ?>
                <tr>
                    <td><?php echo $producto['proc_id']; ?></td>
                    <td><?php echo $producto['proc_name']; ?></td>
                    <td><?php echo $producto['proc_desc']; ?></td>
                    <td><?php echo $producto['proc_price']; ?></td>
                    <td><?php echo $producto['precio_con_descuento']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- pago -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="usr_id" value="<?php echo $usr_id; ?>">
        <input type="hidden" name="pedido_id" value="<?php echo $pedido_id; ?>">

        <div class="form-group">
            <label for="producto_id">Seleccionar Producto:</label>
            <select class="form-control" name="producto_id" required>
                <?php foreach($productosRegistrados as $producto): ?>
                    <option value="<?php echo $producto['proc_id']; ?>"><?php echo $producto['proc_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="card_id">ID de la tarjeta:</label>
            <input type="text" class="form-control" name="card_id" required>
        </div>
        <div class="form-group">
            <label for="card_number">Número de la tarjeta:</label>
            <input type="text" class="form-control" name="card_number" required>
        </div>
        <div class="form-group">
            <label for="card_thought">Fecha de expiración:</label>
            <input type="date" class="form-control" name="card_thought" required>
        </div>
        
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Realizar Pago</button>
        </div>
    </form>

    <div class="d-flex justify-content-center align-items-center">
        <?php mostrarBotonInicio(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofzTN+9G1kX2n9Uv1/Z9L6a7FqTMPhMM6" crossorigin="anonymous"></script>
</body>
</html>
