<?php
session_start();
require("bdSQL.php");

if(isset($_SESSION['usuario'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $card_number = $_POST['card_number'];
      $card_date = $_POST['card_date'];
      $card_name = $_POST['card_name'];
        

        $usr_id = $_SESSION['usr_id'];


        $sql = "SELECT MAX(pago_id) AS ultimo_id FROM pagos";
        $resultado = $conn->query($sql);

        if ($resultado) {
            // Verifica si hay al menos una fila en el resultado
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $ultimo_id = $fila['ultimo_id'];
                $pago_id = $ultimo_id + 1;
            } else {
                // La tabla está vacía, puedes asignar el primer ID que desees
                $pago_id= 1;
            }
        } 

        $total=0;
        $pagoid=0;
        $pagado=0;
        $stmt = $conn->prepare("INSERT INTO pagos (pago_id, usr_id, card_name, card_number, card_thought) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $pago_id, $usr_id, $card_name, $card_number, $card_date);
        $stmt->execute();  
        
        // Consulta para obtener los pedido_id del usuario dado
        $pedido_ids_query = "SELECT pedido_id FROM pedidos WHERE usr_id = ?";
        $pedido_ids_stmt = $conn->prepare($pedido_ids_query);
        $pedido_ids_stmt->bind_param("i", $usr_id);
        $pedido_ids_stmt->execute();
        $pedido_ids_result = $pedido_ids_stmt->get_result();

        // Array para almacenar los pedido_id del usuario
        $pedido_ids = array();
        while ($row = $pedido_ids_result->fetch_assoc()) {
            $pedido_ids[] = $row['pedido_id'];
        }

        // Desvinculamos los det_pedido asociados a los pedido_id obtenidos
        if (!empty($pedido_ids)) {
            $nullify_query = "UPDATE det_pedido SET pedido_id = NULL WHERE pedido_id IN (" . implode(',', $pedido_ids) . ")";
            if ($conn->query($nullify_query)) {
                $affected_rows = $conn->affected_rows;
            } else {
                echo "Error al desvincular los det_pedidos del usuario: " . $conn->error;
            }
        } else {
            echo "No se encontraron pedidos para el usuario con usr_id " . $usr_id . ".";
        }

        
        $sql = "DELETE FROM pedidos WHERE usr_id = '$usr_id'";
        if ($conn->query($sql) === TRUE) {
          
      } else {
          echo "Error al actualizar los pedidos: " . $conn->error;
      }
        
        
    }
}


require("cartSQL.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación de compra</title>
  <link rel="icon" type="image/x-icon" href="img/gamco_logo.png">
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color:white;
    }
    body {
      overflow-x: hidden; 
      background-image: url(img/fondo2.png);
    }
    #flex {
      text-align: center;
    }
    .face {
      width: 100px;
      height: 100px;
      background-image: url('https://tenor.com/view/osu-owo-compare-epic-compare-success-gif-27278082.gif');
      background-size: cover;
      display: inline-block;
      animation: blink-animation 1s infinite;
    }
    @keyframes blink-animation {
      50% {
        opacity: 0;
      }
    }
    #message {
      margin: 20px 0;
      font-size: 18px;
      font-weight: bold;
    }
    #buttons {
      margin-top: 20px;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      margin: 0 10px;
      text-decoration: none;
      color: #fff;
      background-color: #3498db;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div id="flex">
    <div class="face"></div>
    <div id="message">¡Compra realizada correctamente!</div>
    <div id="buttons">
      <a href="index.php" class="button">Seguir comprando</a>
      <a href="#" class="button">Comprobante</a>
    </div>
  </div>
</body>
</html>

