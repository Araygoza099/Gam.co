<?php
function consultarProductos() {
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $bd = "proyecto";

    $con = new mysqli($host, $username, $password, $bd);

    if ($con->connect_error) {
        die("Error de conexión a la base de datos: " . $con->connect_error);
    }

    $consulta = $con->prepare("SELECT * FROM productos");

    if ($consulta === false) {
        die("Error al preparar la consulta: " . $con->error);
    }

    $resultado = $consulta->execute();

    if ($resultado === false) {
        die("Error al ejecutar la consulta: " . $consulta->error);
    }

    $productos = array();

    $consulta->bind_result($id, $nombre, $descuento, $precio, $urlImagen, $tipo);

    while ($consulta->fetch()) {
        $producto = array(
            'id' => $id,
            'nombre' => $nombre,
            'descuento' => $descuento,
            'precio' => $precio,
            'urlImagen' => $urlImagen,
            'tipo' => $tipo
        );
        $productos[] = $producto;
    }

    $consulta->close();
    $con->close();

    return $productos;
}

$productosRegistrados = consultarProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        .btn-primary {
            background-color: #fcb900;
            border-color: #fcb900;
        }

        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .form-control {
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #fcb900;
        }

        .form-control:focus {
            background-color: #333;
            color: #fff;
            border: 1px solid #fcb900;
        }

        .producto-container {
            margin-top: 30px;
        }

        .producto {
            border: 1px solid #fcb900;
            padding: 15px;
            margin-bottom: 20px;
        }

        .producto img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Consulta de Productos</h2>

            <?php
            foreach ($productosRegistrados as $producto) {
                echo '<div class="producto">';
                echo '<img src="' . $producto['urlImagen'] . '" alt="' . $producto['nombre'] . '">';
                echo '<h3>' . $producto['nombre'] . '</h3>';
                echo '<p>ID: ' . $producto['id'] . '</p>';
                echo '<p>Precio: $' . $producto['precio'] . '</p>';
                echo '<p>Descuento: ' . $producto['descuento'] . '%</p>';
                echo '<p>URL de la Imagen: ' . $producto['urlImagen'] . '</p>';
                echo '<p>Tipo: ' . $producto['tipo'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
