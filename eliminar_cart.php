<?php

require("bdSQL.php");

$usuario_id = $_SESSION['usr_id'];

if (isset($_GET['detpedido_id'])) {
    $detpedido_id = $_GET['detpedido_id'];
    
    // Consulta con sentencia preparada para desvincular el det_pedido de la tabla pedidos
    $sql = "UPDATE det_pedido SET pedido_id = NULL WHERE detpedido_id = ?";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    
    // Vincular el parámetro
    $stmt->bind_param("i", $detpedido_id); // "i" indica un valor entero (si el ID es un entero)
    
    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        echo "El det_pedido se ha desvinculado correctamente del pedido.";
    } else {
        echo "Error al desvincular el det_pedido del pedido: " . $conn->error;
    }
    
    // Cerrar la declaración preparada y la conexión
    $stmt->close();
    $conn->close();
    
    // Redireccionar de vuelta a la página de origen
    header('Location: cart.php');
    exit(); // Asegúrate de detener la ejecución del script después de la redirección
} else {
    echo "Error: No se proporcionó el ID del det_pedido.";
}

?>
