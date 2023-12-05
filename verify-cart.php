<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if(isset($_SESSION['usuario'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica si el carrito de compras ya existe en la sesión, si no, créalo
        // if (!isset($_SESSION['cart'])) {
        //     $_SESSION['cart'] = array();
        // }
        // Agrega el producto al carrito
        // $item = array(
        //     'id' => $productId,
        //     'name' => $productName,
        //     'quantity' => $quantity,
        //     'price' => $price
        // );
    
        // $_SESSION['cart'][] = $item;
        // $productName = $_POST['productName'];

        // Recibe los datos del producto desde el formulario
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];


// Suponiendo que ya tienes la conexión a la base de datos establecida

        $usr_id = $_SESSION['usr_id'];

        // Realizas la consulta para obtener el recuento de pedidos del usuario
        $query = "SELECT COUNT(*) as count_pedidos FROM pedidos WHERE usr_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $usr_id);
        $stmt->execute();
        $stmt->bind_result($count_pedidos);
        $stmt->fetch();
        $stmt->close();

        // Verificas si el usuario tiene pedidos o no
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
            $stmt->bind_param("iiiii", $pedido_id, $usr_id, $pagoid, $total, $pagado);
            $stmt->execute();   
        }
        //pedido_id, usr_id, pago_id, pedido_date, edo_pedido

        // detpedido_id, proc_id, pedido_id, detpedido_cantidad, prec_unitario	
        $sql_pedido_existente = "SELECT COUNT(*) as count_pedidos FROM pedidos WHERE pedido_id = ?";
        $stmt_pedido_existente = $conn->prepare($sql_pedido_existente);
        $stmt_pedido_existente->bind_param("i", $pedido_id);
        $stmt_pedido_existente->execute();
        $stmt_pedido_existente->bind_result($count_pedidos_existente);
        $stmt_pedido_existente->fetch();
        $stmt_pedido_existente->close();

        if ($count_pedidos_existente == 0) {
            // Manejar el caso en que pedido_id no existe en la tabla pedidos
            echo "El pedido con el ID $pedido_id no existe en la tabla pedidos.";
            exit();
        }

        $sql = "SELECT MAX(detpedido_id) AS ultimo_id FROM det_pedido";
        $resultado = $conn->query($sql);

        if ($resultado) {
            // Verifica si hay al menos una fila en el resultado
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $ultimo_id = $fila['ultimo_id'];
                $detpedido_id = $ultimo_id + 1;
            } else {
                // La tabla está vacía, puedes asignar el primer ID que desees
                $detpedido_id= 1;
                $stmt = $conn->prepare("INSERT INTO det_pedido (detpedido_id, proc_id, pedido_id, detpedido_cantidad, prec_unitario	) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiii", $detpedido_id, $productId, $pedido_id, $quantity, $price);
                $stmt->execute();
            }
        } else {
            // Maneja el caso en que la consulta no fue exitosa
            echo "Error en la consulta: " . $conn->error;
        }


        $proc_id = $productId;
        $stmt = $conn->prepare("SELECT detpedido_id, detpedido_cantidad FROM det_pedido WHERE pedido_id = ? AND proc_id = ?");
        $stmt->bind_param("ii", $pedido_id, $proc_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Si existe, incrementar detpedido_cantidad en 1
            $stmt->bind_result($detpedido_id, $cantidad_actual);
            $stmt->fetch();

            $stmt = $conn->prepare("UPDATE det_pedido SET detpedido_cantidad = ? WHERE detpedido_id = ?");
            $stmt->bind_param("ii", $cantidad_actual + 1, $detpedido_id);
            $stmt->execute();
        } else {
            // Si no existe, insertar un nuevo registro
            $stmt = $conn->prepare("INSERT INTO det_pedido (proc_id, pedido_id, detpedido_cantidad, prec_unitario) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiii", $productId, $pedido_id, $quantity, $price);
            $stmt->execute();
        }

        $stmt->close();
        header('location: tienda.php');
    } else {
        // Maneja el caso en que la solicitud no sea POST
        header('location: alertas/cartError.html');
        $stmt->close();
    }
}else{
    header('location: alertas/cartError.html');
    $stmt->close();
}

?>
