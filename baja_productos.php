<?php
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $bd = "proyecto";

    $con = new mysqli($host, $username, $password, $bd);

    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }

    //borra producto por ID
    function borrarProducto($proc_id) {
        global $con;

        $con->begin_transaction();

        try {
            //elimina registros de la tabla det_pedido
            $sql_det_pedido = "DELETE FROM det_pedido WHERE proc_id = $proc_id";
            $con->query($sql_det_pedido);

            //elimina registros de la tabla productos
            $sql_productos = "DELETE FROM productos WHERE proc_id = $proc_id";
            $con->query($sql_productos);

            //confirma la transacción
            $con->commit();
            echo "Producto eliminado con éxito.";
        } catch (Exception $e) {
            //revierte la transacción en caso de error
            $con->rollback();
            echo "Error al eliminar el producto: " . $e->getMessage();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["producto_seleccionado"])) {
            $producto_id_a_borrar = $_POST["producto_seleccionado"];
            borrarProducto($producto_id_a_borrar);
        }
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
    
        $query = "SELECT proc_id, proc_name FROM productos";
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

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar y Modificar Producto</title>
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

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
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
            <!-- Formulario para eliminar producto -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2 class="text-center mb-4">Eliminar Producto</h2>

                <div class="form-group">
                    <label for="producto_seleccionado">Selecciona el Producto a Eliminar:</label>
                    <select class="form-control" name="producto_seleccionado" required>
                        <?php foreach ($listaProductos as $producto) : ?>
                            <option value="<?php echo $producto['proc_id']; ?>"><?php echo $producto['proc_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger btn-block">Eliminar Producto</button>
                </div>
            </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
