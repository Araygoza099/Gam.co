<?php
include('header.php'); 
function modificarProducto($id, $nombre, $descripcion, $descuento, $precio, $cantidad, $nombreImagen, $tipo) {
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $bd = "proyecto";

    $con = new mysqli($host, $username, $password, $bd);

    if ($con->connect_error) {
        die("Error de conexión a la base de datos: " . $con->connect_error);
    }

    $consulta = $con->prepare("UPDATE productos SET proc_name=?, proc_descrip=?, proc_desc=?, proc_price=?, cantidad=?, proc_urlimg=?, type=? WHERE proc_id=?");

    if ($consulta === false) {
        die("Error al preparar la consulta: " . $con->error);
    }

    //verifica si se ha subido un nuevo archivo de imagen
    if ($_FILES["file"]["size"] > 0) {
        $targetDir = "img/base/";
        $uploadedFileName = basename($_FILES["file"]["name"]);
        $targetFile = $targetDir . $uploadedFileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $nombreImagen = $uploadedFileName;
            echo "La imagen se ha subido correctamente.";
        } else {
            // echo "Hubo un problema al subir el archivo. Detalles: " . $_FILES["file"]["error"];
        }
    }

    $consulta->bind_param("ssdiissi", $nombre, $descripcion, $descuento, $precio, $cantidad, $nombreImagen, $tipo, $id);

    $resultado = $consulta->execute();

    if ($resultado === false) {
        die("Error al ejecutar la consulta: " . $consulta->error);
    }

    $consulta->close();
    $con->close();

    return $resultado;
}

function obtenerListaProductos() {
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $bd = "proyecto";

    $con = new mysqli($host, $username, $password, $bd);

    if ($con->connect_error) {
        die("Error de conexión a la base de datos: " . $con->connect_error);
    }

    $query = "SELECT proc_id, proc_name, proc_desc FROM productos";
    $result = $con->query($query);

    if ($result === false) {
        die("Error al ejecutar la consulta: " . $con->error);
    }

    $listaProductos = [];
    while ($row = $result->fetch_assoc()) {
        $listaProductos[] = $row;
    }

    $con->close();

    return $listaProductos;
}

$listaProductos = obtenerListaProductos();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["producto_seleccionado"])) {
    $idProducto = $_POST["producto_seleccionado"];
    $nuevoNombre = $_POST["nombre"];
    $nuevoDescripcion = $_POST["descripcion"];
    $nuevoDescuento = $_POST["descuento"];
    $nuevoPrecio = $_POST["precio"];
    $nuevaCantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : 0;
    $nombreImagen = ""; 
    if ($_FILES["file"]["size"] > 0) {
        $targetDir = "img/base/";
        $uploadedFileName = basename($_FILES["file"]["name"]);
        $targetFile = $targetDir . $uploadedFileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            $nombreImagen = $uploadedFileName;
        } else {
            echo "Hubo un problema al subir el archivo.";
        }
    }

    $nuevoTipo = $_POST["tipo"];

    $resultado_modificacion = modificarProducto($idProducto, $nuevoNombre, $nuevoDescripcion, $nuevoDescuento, $nuevoPrecio, $nuevaCantidad, $nombreImagen, $nuevoTipo);

    if ($resultado_modificacion) {
        $mensaje = "Producto modificado correctamente.";
        echo "<script>showSuccessAlert('$mensaje');</script>";
    } else {
        $mensaje = "Error al modificar el producto.";
        echo "<script>showErrorAlert('$mensaje');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <h2 class="text-center mb-4">Modificar Producto</h2>

                <div class="form-group">
                    <label for="producto_seleccionado">Selecciona el Producto:</label>
                    <select class="form-control" name="producto_seleccionado" required>
                        <?php foreach ($listaProductos as $producto) : ?>
                            <option value="<?php echo $producto['proc_id']; ?>"><?php echo $producto['proc_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre">Nuevo Nombre del Producto:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Nueva Descripción del Producto:</label>
                    <input type="text" class="form-control" name="descripcion" required>
                </div>

                <div class="form-group">
                    <label for="descuento">Nuevo Descuento (%):</label>
                    <input type="number" class="form-control" name="descuento" step="0.01" min="0" max="100" required>
                </div>

                <div class="form-group">
                    <label for="precio">Nuevo Precio:</label>
                    <input type="number" class="form-control" name="precio" step="0.01" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="cantidad">Nueva Cantidad:</label>
                    <input type="number" class="form-control" name="cantidad" required>
                </div>

                <div class="form-group">
                    <label for="file">Seleccionar Nueva Imagen:</label>
                    <input type="file" class="form-control-file" name="file" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="tipo">Nuevo Tipo:</label>
                    <input type="text" class="form-control" name="tipo" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Modificar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert" style="display: none;">
    <strong>Éxito:</strong> <span id="success-message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert" style="display: none;">
    <strong>Error:</strong> <span id="error-message"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
