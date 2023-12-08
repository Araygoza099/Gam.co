<?php
    include('header.php'); 
    require("cartSQL.php");

    // Obtener datos del producto seleccionado
    function obtenerDatosProducto($proc_id) {
        global $con;

        $query = "SELECT * FROM productos WHERE proc_id = $proc_id";
        $result = $con->query($query);

        if ($result === false) {
            die("Error al obtener datos del producto: " . $con->error);
        }

        $producto = $result->fetch_assoc();

        return $producto;
    }

    // Borra producto por ID
    function borrarProducto($proc_id) {
        global $con;

        $con->begin_transaction();

        try {
            // Elimina registros de la tabla det_pedido
            $sql_det_pedido = "DELETE FROM det_pedido WHERE proc_id = $proc_id";
            $con->query($sql_det_pedido);

            // Elimina registros de la tabla productos
            $sql_productos = "DELETE FROM productos WHERE proc_id = $proc_id";
            $con->query($sql_productos);

            // Confirma la transacción
            $con->commit();
            echo "Producto eliminado con éxito.";
        } catch (Exception $e) {
            // Revierte la transacción en caso de error
            $con->rollback();
            echo "Error al eliminar el producto: " . $e->getMessage();
        }
    }

    function obtenerListaProductos() {
        global $con;

        $query = "SELECT proc_id, proc_name FROM productos";
        $result = $con->query($query);

        if ($result === false) {
            die("Error al ejecutar la consulta: " . $con->error);
        }

        $listaProductos = [];
        while ($row = $result->fetch_assoc()) {
            $listaProductos[] = $row;
        }

        return $listaProductos;
    }

    $listaProductos = obtenerListaProductos();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["producto_seleccionado"])) {
            $producto_id_a_borrar = $_POST["producto_seleccionado"];
            $producto_seleccionado = obtenerDatosProducto($producto_id_a_borrar);
        } elseif (isset($_POST["producto_seleccionado_confirmado"])) {
            // Confirmar la baja del producto
            $producto_id_confirmado = $_POST["producto_seleccionado_confirmado"];
            borrarProducto($producto_id_confirmado);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
            <?php if (!isset($producto_seleccionado) && (!isset($_POST["producto_seleccionado"]) || isset($_POST["producto_seleccionado_confirmado"]))) : ?>
                <!-- Formulario para seleccionar y mostrar detalles del producto -->
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
                        <button type="submit" class="btn btn-danger btn-block">Mostrar Detalles</button>
                    </div>
                </form>
            <?php endif; ?>

            <?php if (isset($producto_seleccionado)) : ?>
                <!-- Mostrar detalles del producto -->
                <h2>Datos del Producto Seleccionado</h2>
                <p>ID: <?php echo $producto_seleccionado['proc_id']; ?></p>
                <p>Nombre: <?php echo $producto_seleccionado['proc_name']; ?></p>
                
                <?php if (isset($producto_seleccionado['proc_descrip'])) : ?>
                    <p>Descripcion: <?php echo $producto_seleccionado['proc_descrip']; ?></p>
                <?php endif; ?>

                <?php if (isset($producto_seleccionado['proc_price'])) : ?>
                    <p>Precio: $<?php echo $producto_seleccionado['proc_price']; ?></p>
                <?php endif; ?>

                <?php if (isset($producto_seleccionado['proc_desc'])) : ?>
                    <p>Descuento: <?php echo $producto_seleccionado['proc_desc']; ?>%</p>
                <?php endif; ?>

                <?php if (isset($producto_seleccionado['cantidad'])) : ?>
                    <p>Cantidad: <?php echo $producto_seleccionado['cantidad']; ?></p>
                <?php endif; ?>

                <?php if (isset($producto_seleccionado['proc_urlimg'])) : ?>
                    <p>URL de la Imagen: <?php echo $producto_seleccionado['proc_urlimg']; ?></p>
                    <img src='img/base/<?php echo $producto_seleccionado['proc_urlimg']; ?>' alt='Imagen del Producto'>
                <?php endif; ?>

                <?php if (isset($producto_seleccionado['type'])) : ?>
                    <p>Tipo: <?php echo $producto_seleccionado['type']; ?></p>
                <?php endif; ?>

                <!-- Confirmar la baja -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="producto_seleccionado_confirmado" value="<?php echo $producto_seleccionado['proc_id']; ?>">
                    <button type="submit" class="btn btn-danger">Confirmar Baja</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>