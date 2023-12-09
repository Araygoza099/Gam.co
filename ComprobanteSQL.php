<?php
require ("bdSQL.php");
session_start();
$usr_id = $_SESSION['usr_id'];
// Consulta SQL
$sql = "SELECT users.usr_id, users.username, users.email,
           pagados.pagado_id, pagados.pago_id, pagados.dir_id, pagados.total,
           direccion.calle, direccion.fracc, direccion.zipcode, direccion.estado, direccion.ciudad, direccion.pais, direccion.num_tel,
           det_pedido.detpedido_id, det_pedido.proc_id, det_pedido.pedido_id, det_pedido.pagado_id, det_pedido.detpedido_cantidad, det_pedido.prec_unitario,
           productos.proc_id, productos.proc_name, productos.proc_descrip, productos.proc_desc, productos.proc_price, productos.cantidad, productos.proc_urlimg, productos.type,
           pagos.pago_id, pagos.card_name, pagos.card_number
        FROM users
        JOIN pagados ON users.usr_id = pagados.usr_id
        JOIN direccion ON pagados.dir_id = direccion.dir_id
        JOIN det_pedido ON pagados.pagado_id = det_pedido.pagado_id
        JOIN productos ON det_pedido.proc_id = productos.proc_id
        JOIN pagos ON pagados.pago_id = pagos.pago_id
        WHERE users.usr_id = $usr_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Asignar los valores a variables específicas
        $usr_id = $row["usr_id"];
        $username = $row["username"];
        $email = $row["email"];
        $pagado_id = $row["pagado_id"];
        $pago_id = $row["pago_id"];
        $dir_id = $row["dir_id"];
        $total = $row["total"];
        $calle = $row["calle"];
        $fracc = $row["fracc"];
        $zipcode = $row["zipcode"];
        $estado = $row["estado"];
        $ciudad = $row["ciudad"];
        $pais = $row["pais"];
        $num_tel = $row["num_tel"];
        $detpedido_id = $row["detpedido_id"];
        $proc_id = $row["proc_id"];
        $pedido_id = $row["pedido_id"];
        $detpedido_cantidad = $row["detpedido_cantidad"];
        $prec_unitario = $row["prec_unitario"];
        $proc_name = $row["proc_name"];
        $proc_descrip = $row["proc_descrip"];
        $proc_desc = $row["proc_desc"];
        $proc_price = $row["proc_price"];
        $cantidad = $row["cantidad"];
        $proc_urlimg = $row["proc_urlimg"];
        $type = $row["type"];
        $card_name = $row["card_name"];
        $card_number = $row["card_number"];

        // Ejemplo: Imprimir los datos
        echo "User ID: $usr_id, Username: $username, Email: $email, Pagado ID: $pagado_id, Pago ID: $pago_id<br>";
        echo "Dirección: $calle, $fracc, $ciudad, $estado, $zipcode, $pais, Teléfono: $num_tel<br>";
        echo "Detalles del Pedido - ID: $detpedido_id, Producto ID: $proc_id, Cantidad: $detpedido_cantidad, Precio Unitario: $prec_unitario<br>";
        echo "Producto - Nombre: $proc_name, Descripción: $proc_descrip, Precio: $proc_price<br>";
        echo "Pago - ID: $pago_id, Nombre Tarjeta: $card_name, Número Tarjeta: $card_number<br>";
        echo "<hr>"; // Separador entre cada conjunto de datos
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();

?>
