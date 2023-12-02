<?php
// Código para procesar la imagen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"]) && !(empty($_FILES["file"]["tmp_name"]))) {
    $targetDir = "img/base/";  // Directorio donde se guardarán las imágenes
    $uploadedFileName = basename($_FILES["file"]["name"]);
    $targetFile = $targetDir . $uploadedFileName;

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) { ?>

            <div class="alert alert-success" role="alert">
                <strong>El archivo </strong> <?php echo htmlspecialchars($uploadedFileName);   ?> se ha subido correctamente.
            </div>

        <?php
        } else {
            echo "Hubo un problema al subir el archivo.";
        }
    } else { ?>

        <div class="alert alert-warning" role="alert">
            <strong>El archivo </strong> no es una imagen válida.
        </div>

    <?php
    }
}


function registrarProducto($id, $nombre, $descripcion, $descuento, $precio, $urlImagen, $tipo, $cantidad) {
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $bd = "proyecto";

    $con = new mysqli($host, $username, $password, $bd);

    if ($con->connect_error) {
        die("Error de conexión a la base de datos: " . $con->connect_error);
    }

    //verifica si el ID ya existe
    $verificarConsulta = $con->prepare("SELECT COUNT(*) FROM productos WHERE proc_id = ?");
    $verificarConsulta->bind_param("i", $id);
    $verificarConsulta->execute();
    $verificarConsulta->bind_result($count);
    $verificarConsulta->fetch();
    $verificarConsulta->close();

    if ($count > 0) {
        $con->close();
        return "El ID del producto ya existe. Por favor, elige otro ID.";
    }

    //inserta el nuevo producto
    $consulta = $con->prepare("INSERT INTO productos (proc_id, proc_name, proc_descrip, proc_desc, proc_price, cantidad, proc_urlimg, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($consulta === false) {
        die("Error al preparar la consulta: " . $con->error);
    }

    $consulta->bind_param("issiiiss", $id, $nombre, $descripcion, $descuento, $precio, $cantidad, $urlImagen, $tipo);

    $resultado = $consulta->execute();

    if ($resultado === false) {
        die("Error al ejecutar la consulta: " . $consulta->error);
    }

    $consulta->close();
    $con->close();

    return "Producto registrado correctamente.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["nombre"])) {
    $idProducto = $_POST["id"];
    $nombreProducto = $_POST["nombre"];
    $descripcionProducto = $_POST["descripcion"];
    $descuentoProducto = $_POST["descuento"];
    $precioProducto = $_POST["precio"];
    $nombreImagenProducto = isset($uploadedFileName) ? $uploadedFileName : ""; // Solo el nombre de la imagen
    $tipoProducto = $_POST["tipo"];
    $cantidadProducto = $_POST["cantidad"];

    $resultadoInsercion = registrarProducto($idProducto, $nombreProducto, $descripcionProducto, $descuentoProducto, $precioProducto, $nombreImagenProducto, $tipoProducto, $cantidadProducto);

    if ($resultadoInsercion === "Producto registrado correctamente.") {
        $mensaje = "Producto registrado correctamente.";
        echo "<script>showSuccessAlert('$mensaje');</script>";
    } else {
        $mensaje = "Error al registrar el producto. $resultadoInsercion";
        echo "<script>showErrorAlert('$mensaje');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
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
                    <label for="descripcion">Descripción del Producto:</label>
                    <input type="text" class="form-control" name="descripcion" required>
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
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" class="form-control" name="cantidad" required>
                </div>

                <div class="form-group">
                    <label for="file">Seleccionar Imagen:</label>
                    <input type="file" class="form-control-file" name="file" accept="image/*" required>
                </div>

                <!-- <div class="form-group">
                    <label for="urlImagen">URL de la Imagen:</label>
                    <input type="text" class="form-control" name="urlImagen" required>
                </div> -->

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

<div class="alert alert-success" id="success-alert" style="display: none;">
    <strong>Éxito:</strong> <span id="success-message"></span>
</div>

<div class="alert alert-danger" id="error-alert" style="display: none;">
    <strong>Error:</strong> <span id="error-message"></span>
</div>

<!-- Script para mostrar alertas de Bootstrap -->
<script>
    function showSuccessAlert(message) {
        $("#success-message").text(message);
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#success-alert").slideUp(500);
        });
    }

    function showErrorAlert(message) {
        $("#error-message").text(message);
        $("#error-alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#error-alert").slideUp(500);
        });
    }
</script>
</body>
</html>