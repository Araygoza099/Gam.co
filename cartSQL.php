<?php
    require("bdSQL.php");

    $usuario_id = $_SESSION['usr_id'];

    $sql = "SELECT *
            FROM users u
            JOIN pedidos p ON u.usr_id = p.usr_id
            JOIN det_pedido dp ON p.pedido_id = dp.pedido_id
            JOIN productos pr ON dp.proc_id = pr.proc_id
            WHERE u.usr_id = '$usuario_id' AND p.pagado = 0";

    $result = $conn->query($sql);
    $cantidad=0;
    $precioFinal=0;
    $_SESSION['num_productos'] = $result->num_rows;

    $sql2 = "SELECT calle FROM direccion WHERE usr_id = $usuario_id";
    $result2 = $conn->query($sql2);
?>