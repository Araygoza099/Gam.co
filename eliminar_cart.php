<?php
require("bdSQL.php");

$usuario_id = $_SESSION['usr_id'];

if (isset($_GET['detpedido_id'])) {
    $detpedido_id = $_GET['detpedido_id'];
    
    // Consulta para obtener proc_id y detpedido_cantidad de det_pedido
    $query = "SELECT proc_id, detpedido_cantidad FROM det_pedido WHERE detpedido_id = ?";
    
    // Preparar la consulta
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $detpedido_id);
    
    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener resultados
        $result = $stmt->get_result();
        
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_producto = $row['proc_id'];
            $quantity = $row['detpedido_cantidad'];
            
            // Actualizar la cantidad en la tabla productos
            $update_query = "UPDATE productos SET cantidad = cantidad + ? WHERE proc_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ii", $quantity, $id_producto);
            
            if ($update_stmt->execute()) {
                echo "Se actualizó la cantidad del producto correctamente.";
            } else {
                echo "Error al actualizar la cantidad del producto: " . $conn->error;
            }
            
            $update_stmt->close();
        } else {
            echo "No se encontraron resultados para ese det_pedido ID.";
        }
        
        $result->close();
        
        // Desvincular el det_pedido estableciendo pedido_id a NULL
        $nullify_query = "UPDATE det_pedido SET pedido_id = NULL WHERE detpedido_id = ?";
        $nullify_stmt = $conn->prepare($nullify_query);
        $nullify_stmt->bind_param("i", $detpedido_id);
        
        if ($nullify_stmt->execute()) {
            echo "El det_pedido se ha desvinculado correctamente del pedido.";
        } else {
            echo "Error al desvincular el det_pedido del pedido: " . $conn->error;
        }
        
        $nullify_stmt->close();
    } else {
        echo "Error al obtener datos del det_pedido: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    
    // Redireccionar de vuelta a la página de origen
    header('Location: cart.php');
    exit(); // Asegúrate de detener la ejecución del script después de la redirección
} else {
    echo "Error: No se proporcionó el ID del det_pedido.";
}
?>
