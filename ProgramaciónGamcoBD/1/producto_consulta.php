<?php
include "utils.php";
include('conexion.php');


$sql = "SELECT * FROM productos";
$result = $con->query($sql);

$productosRegistrados = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //se calcula precio con descuento
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Gam.co</title>
</head>
<body>
    <h2>Productos Registrados</h2>
    
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

    <div class="d-flex justify-content-center align-items-center">
        <?php mostrarBotonInicio(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofzTN+9G1kX2n9Uv1/Z9L6a7FqTMPhMM6" crossorigin="anonymous"></script>
</body>
</html>
