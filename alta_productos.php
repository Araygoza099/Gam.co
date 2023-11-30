<?php

function registrarProducto($id, $nombre, $descuento, $precio, $urlImagen, $tipo) {
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $bd = "proyecto";

    $con = new mysqli($host, $username, $password, $bd);

    if ($con->connect_error) {
        die("Error de conexión a la base de datos: " . $con->connect_error);
    }

    $consulta = $con->prepare("INSERT INTO productos (proc_id, proc_name, proc_desc, proc_price, proc_urlimg, type) VALUES (?, ?, ?, ?, ?, ?)");

    if ($consulta === false) {
        die("Error al preparar la consulta: " . $con->error);
    }

    $consulta->bind_param("isiiss", $id, $nombre, $descuento, $precio, $urlImagen, $tipo);

    $resultado = $consulta->execute();

    if ($resultado === false) {
        die("Error al ejecutar la consulta: " . $consulta->error);
    }

    $consulta->close();
    $con->close();

    return $resultado;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["nombre"])) {
    $idProducto = $_POST["id"];
    $nombreProducto = $_POST["nombre"];
    $descuentoProducto = $_POST["descuento"];
    $precioProducto = $_POST["precio"];
    $urlImagenProducto = $_POST["urlImagen"];
    $tipoProducto = $_POST["tipo"];

    $resultadoInsercion = registrarProducto($idProducto, $nombreProducto, $descuentoProducto, $precioProducto, $urlImagenProducto, $tipoProducto);

    if ($resultadoInsercion) {
        echo "<script>alert('Producto registrado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al registrar el producto.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
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
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2 class="text-center mb-4">Registrar Producto</h2>

                <div class="form-group">
                    <label for="id">ID del Producto:</label>
                    <input type="number" class="form-control" name="id" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="descuento">Descuento (%):</label>
                    <input type="number" class="form-control" name="descuento" step="0.01" min="0" max="100" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" class="form-control" name="precio" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="urlImagen">URL de la Imagen:</label>
                    <input type="text" class="form-control" name="urlImagen" required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" class="form-control" name="tipo" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Registrar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
