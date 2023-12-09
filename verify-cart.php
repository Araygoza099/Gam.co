<?php
session_start();
require("bdSQL.php");

if(isset($_SESSION['usuario'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productId = $_POST['productId'];
        $quantity = $_POST['cantidad'];
        $price = $_POST['precio'];
        
        $usr_id = $_SESSION['usr_id'];
        $sql = "SELECT pago_id FROM pagos WHERE usr_id = $usr_id ORDER BY pago_id ASC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pago_id = $row["pago_id"];
        } else {
            echo "No se encontró ningún pago relacionado con el usr_id $usr_id.";
        }

        $query = "SELECT COUNT(*) as count_pedidos FROM pedidos WHERE usr_id = ? AND pagado = 0";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $usr_id);
        $stmt->execute();
        $stmt->bind_result($count_pedidos);
        $stmt->fetch();
        $stmt->close();

        // Verifica si hay algún pedido pendiente de pago
        if ($count_pedidos > 0) {

            $sql = "SELECT pedido_id FROM pedidos WHERE usr_id = $usr_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $pedido_id = $row['pedido_id'];

        } else {

            $sql = "SELECT MAX(pedido_id) AS ultimo_id FROM pedidos";
            $resultado = $conn->query($sql);

            if ($resultado) {
                // Verifica si hay al menos una fila en el resultado
                if ($resultado->num_rows > 0) {
                    $fila = $resultado->fetch_assoc();
                    $ultimo_id = $fila['ultimo_id'];
                    $pedido_id = $ultimo_id + 1;
                } else {
                    // La tabla está vacía, puedes asignar el primer ID que desees
                    $pedido_id= 1;
                }
            } else {
                // Maneja el caso en que la consulta no fue exitosa
                echo "Error en la consulta: " . $conn->error;
            }

            $total=0;
            $pagoid=0;
            $pagado=0;
            $stmt = $conn->prepare("INSERT INTO pedidos (pedido_id, usr_id, pago_id, total, pagado) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiii", $pedido_id, $usr_id, $pago_id, $total, $pagado);
            $stmt->execute();   
        }
        
        //Detalle Pedido

            //Tenemos Product ID, Pedido ID, Cantidad y Precio
            //Necesitamos detpedido_id, proc_id, pedido_id, detpedido_cantidad, prec_unitario	

        $sql1 = "SELECT MAX(detpedido_id) AS ultimo_id FROM det_pedido";
        $resultado1 = $conn->query($sql1);

        if ($resultado1) {
            // Verifica si hay al menos una fila en el resultado
            if ($resultado1->num_rows > 0) {
                $fila1 = $resultado1->fetch_assoc();
                $ultimo_id1 = $fila1['ultimo_id'];
                $detpedido_id = $ultimo_id1 + 1;
            } else {
                // La tabla está vacía, puedes asignar el primer ID que desees
                $detpedido_id= 1;
            }
        } else {
            // Maneja el caso en que la consulta no fue exitosa
            echo "Error en la consulta: " . $conn->error;
        }

        $id_producto = $productId; 
        $query = "SELECT cantidad FROM productos WHERE proc_id = $id_producto";
        $resultado2 = $conn->query($query);
        
        if ($resultado2) {
            if ($resultado2->num_rows > 0) {
                $fila = $resultado2->fetch_assoc();
                $cantidad_actual = $fila['cantidad'];
        
                if ($cantidad_actual <= 0) {
                    // Manejar caso de cantidad 0 o menor
                    echo "La cantidad actual es 0 o menor.";
                } else {
                    if ($quantity > $cantidad_actual) {
                        $quantity = $cantidad_actual; 
                    } 
                    
                    $pagado_id = NULL;
                    $stmt1 = $conn->prepare("INSERT INTO det_pedido (detpedido_id, proc_id, pedido_id, pagado_id, detpedido_cantidad, prec_unitario) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt1->bind_param("iiiiii", $detpedido_id, $productId, $pedido_id, $pagado_id, $quantity, $price);
                    $stmt1->execute();
                }
            } else {
                echo "No se encontró ningún producto con ese ID.";
            }
        
        } else {
            // Manejar el caso de error en la consulta
            echo "Error al obtener la cantidad del producto";
        }
        

        
 

        $stmt1->close();
        header('location: tienda.php');
    } else {
        // Maneja el caso en que la solicitud no sea POST
        header('location: alertas/cartError.html');
        $stmt->close();
        $stmt1->close();
    }
}else{
    header('location: alertas/cartError.html');
    $stmt->close();
    $stmt1->close();
}


require("cartSQL.php");
?>
