<?php
include "utils.php";
include('conexion.php');

//mensajes de alerta
$alertClass = '';
$alertMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proc_id = $_POST['proc_id'];
    $nombre = $_POST['nombre'];
    $proc_desc = $_POST['proc_desc'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];

    //verifica si el ID del producto ya existe
    $check_query = "SELECT * FROM productos WHERE proc_id = '$proc_id'";
    $result = $con->query($check_query);

    if ($result->num_rows > 0) {
        $alertClass = 'alert-danger';
        $alertMessage = 'Error: El ID del producto ya existe. Por favor, elige un ID único.';
    } else {
        //insertar datos en la tabla de productos
        $insert_query = "INSERT INTO productos (proc_id, proc_name, proc_desc, proc_price, type) VALUES ('$proc_id', '$nombre', '$proc_desc', $precio, '$tipo')";
        
        if ($con->query($insert_query) === TRUE) {
            $alertClass = 'alert-success';
            $alertMessage = 'Producto registrado exitosamente.';
        } else {
            $alertClass = 'alert-danger';
            $alertMessage = 'Error: ' . $insert_query . '<br>' . $con->error;
        }
    }

    $con->close(); 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 text-center">
    <h2 class="mb-4">Registro de Productos</h2>

    <?php if (!empty($alertMessage)) : ?>
        <div class="alert <?php echo $alertClass; ?>" role="alert">
            <?php echo $alertMessage; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="proc_id">ID del Producto:</label>
            <input type="number" class="form-control" name="proc_id" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="proc_desc">Descuento del Producto:</label>
            <input type="number" class="form-control" name="proc_desc" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" class="form-control" name="precio" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <input type="text" class="form-control" name="tipo" required>
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Registrar Producto</button>
        </div>
    </form>
</div>
<div class="d-flex justify-content-center align-items-center">
    <?php mostrarBotonInicio(); ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
