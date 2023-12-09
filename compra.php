<?php
session_start();
require("bdSQL.php");

if(isset($_SESSION['usuario'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $card_number = $_POST['card_number'];
      $card_date = $_POST['card_date'];
      $card_name = $_POST['card_name'];
      
      $envioOK = isset($_GET['envio']) ? intval($_GET['envio']) : 0;
      $dir_idOK = isset($_GET['dir_id']) ? $_GET['dir_id'] : '';
      $preciototalOK = isset($_GET['preciototal']) ? $_GET['preciototal'] : '';
        

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


        $query_pedido_id = "SELECT pedido_id FROM pedidos WHERE usr_id = $usr_id";
        $result_pedido_id = $conn->query($query_pedido_id);

        if ($result_pedido_id) {
            if ($result_pedido_id->num_rows > 0) {
                while ($row_pedido_id = $result_pedido_id->fetch_assoc()) {
                    $pedido_id = $row_pedido_id['pedido_id'];

                    // Consulta para obtener detpedido_id, proc_id y cantidad asociados al pedido_id
        $query_detpedido = "SELECT detpedido_id, proc_id, detpedido_cantidad FROM det_pedido WHERE pedido_id = $pedido_id";
        $result_detpedido = $conn->query($query_detpedido);
        
        if ($result_detpedido) {
            if ($result_detpedido->num_rows > 0) {
                while ($row_detpedido = $result_detpedido->fetch_assoc()) {
                    $detpedido_id = $row_detpedido['detpedido_id'];
                    $proc_id = $row_detpedido['proc_id'];
                    $cantidad_detpedido = $row_detpedido['detpedido_cantidad'];
        
                    // Obtener la cantidad actual del producto
                    $query_producto = "SELECT cantidad FROM productos WHERE proc_id = $proc_id";
                    $result_producto = $conn->query($query_producto);
        
                    if ($result_producto && $result_producto->num_rows > 0) {
                        $row_producto = $result_producto->fetch_assoc();
                        $cantidad_actual = $row_producto['cantidad'];
        
                        // Calcular nueva cantidad
                        $nueva_cantidad = $cantidad_actual - $cantidad_detpedido;
                        if ($nueva_cantidad < 0) {
                            $nueva_cantidad = 0; // Asegurar que la cantidad no sea negativa
                        }
        
                        // Actualizar la cantidad en la tabla productos
                        $update_query = "UPDATE productos SET cantidad = $nueva_cantidad WHERE proc_id = $proc_id";
                        if ($conn->query($update_query)) {
                             
                        } else {
                            echo "Error al actualizar la cantidad para proc_id: $proc_id - " . $conn->error;
                        }
                    } else {
                        echo "No se encontró el producto con proc_id: $proc_id";
                    }
                }
            } else {
                echo "No se encontraron detalles de pedidos para el pedido con pedido_id: $pedido_id";
            }
        } else {
            echo "Error al obtener detalles de pedidos - " . $conn->error;
        }
                }
            } else {
                echo "No se encontró ningún pedido para el usuario con usr_id: $usr_id";
            }
        } else {
            echo "Error al obtener el pedido para el usuario con usr_id: $usr_id - " . $conn->error;
        }

        $sql = "INSERT INTO pagados (pagado_id, usr_id, pago_id, total)
        SELECT pedido_id, usr_id, ?, total
        FROM pedidos";

        // Preparar la consulta
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetro
            $stmt->bind_param("i", $pago_id); // "i" indica que es un entero

            // Ejecutar la consulta
            $stmt->execute();

            // Verificar si se realizó la inserción
            if ($stmt->affected_rows > 0) {
                
            } else {
                echo "No se realizaron cambios o la inserción falló.";
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }

        // Desvinculamos los det_pedido asociados a los pedido_id obtenidos
        if (!empty($pedido_ids)) {
          // Actualizar det_pedido para establecer pagado_id igual a pedido_id
          $update_pagado_query = "UPDATE det_pedido SET pagado_id = pedido_id WHERE pedido_id IN (" . implode(',', $pedido_ids) . ")";
          
          if ($conn->query($update_pagado_query)) {
              $affected_rows = $conn->affected_rows;
               
          } else {
              echo "Error al actualizar 'pagado_id' en 'det_pedido': " . $conn->error;
          }

          // Ahora, anulamos los vínculos de pedido_id en det_pedido
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
        
        
    } else {
      $card_number = "0000000000000000";
      $card_date = "00/00";
      $card_name = "OXXO";
        

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


        $query_pedido_id = "SELECT pedido_id FROM pedidos WHERE usr_id = $usr_id";
        $result_pedido_id = $conn->query($query_pedido_id);

        if ($result_pedido_id) {
            if ($result_pedido_id->num_rows > 0) {
                while ($row_pedido_id = $result_pedido_id->fetch_assoc()) {
                    $pedido_id = $row_pedido_id['pedido_id'];

                    // Consulta para obtener detpedido_id, proc_id y cantidad asociados al pedido_id
        $query_detpedido = "SELECT detpedido_id, proc_id, detpedido_cantidad FROM det_pedido WHERE pedido_id = $pedido_id";
        $result_detpedido = $conn->query($query_detpedido);
        
        if ($result_detpedido) {
            if ($result_detpedido->num_rows > 0) {
                while ($row_detpedido = $result_detpedido->fetch_assoc()) {
                    $detpedido_id = $row_detpedido['detpedido_id'];
                    $proc_id = $row_detpedido['proc_id'];
                    $cantidad_detpedido = $row_detpedido['detpedido_cantidad'];
        
                    // Obtener la cantidad actual del producto
                    $query_producto = "SELECT cantidad FROM productos WHERE proc_id = $proc_id";
                    $result_producto = $conn->query($query_producto);
        
                    if ($result_producto && $result_producto->num_rows > 0) {
                        $row_producto = $result_producto->fetch_assoc();
                        $cantidad_actual = $row_producto['cantidad'];
        
                        // Calcular nueva cantidad
                        $nueva_cantidad = $cantidad_actual - $cantidad_detpedido;
                        if ($nueva_cantidad < 0) {
                            $nueva_cantidad = 0; // Asegurar que la cantidad no sea negativa
                        }
        
                        // Actualizar la cantidad en la tabla productos
                        $update_query = "UPDATE productos SET cantidad = $nueva_cantidad WHERE proc_id = $proc_id";
                        if ($conn->query($update_query)) {
                             
                        } else {
                            echo "Error al actualizar la cantidad para proc_id: $proc_id - " . $conn->error;
                        }
                    } else {
                        echo "No se encontró el producto con proc_id: $proc_id";
                    }
                }
            } else {
                echo "No se encontraron detalles de pedidos para el pedido con pedido_id: $pedido_id";
            }
        } else {
            echo "Error al obtener detalles de pedidos - " . $conn->error;
        }
                }
            } else {
                echo "No se encontró ningún pedido para el usuario con usr_id: $usr_id";
            }
        } else {
            echo "Error al obtener el pedido para el usuario con usr_id: $usr_id - " . $conn->error;
        }

        $sql3 = "SELECT MAX(pagado_id) AS ultimo_id FROM pagados";
      $resultado3 = $conn->query($sql3);

      if ($resultado3) {
          // Verifica si hay al menos una fila en el resultado
          if ($resultado3->num_rows > 0) {
              $fila3 = $resultado3->fetch_assoc();
              $ultimo_id = $fila3['ultimo_id'];
              $pagado_id = $ultimo_id + 1;
          } else {
              // La tabla está vacía, puedes asignar el primer ID que desees
              $pagado_id= 1;
          }
      } 
    

        $stmt = $conn->prepare("INSERT INTO pagados (pagado_id, usr_id, pago_id, dir_id, envio, total) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiii", $pagado_id, $usr_id, $pago_id, $dir_idOK, $envioOK, $preciototalOK);
        $stmt->execute(); 

        // Desvinculamos los det_pedido asociados a los pedido_id obtenidos
        if (!empty($pedido_ids)) {
          // Actualizar det_pedido para establecer pagado_id igual a pedido_id
          $update_pagado_query = "UPDATE det_pedido SET pagado_id = pedido_id WHERE pedido_id IN (" . implode(',', $pedido_ids) . ")";
          
          if ($conn->query($update_pagado_query)) {
              $affected_rows = $conn->affected_rows;
               
          } else {
              echo "Error al actualizar 'pagado_id' en 'det_pedido': " . $conn->error;
          }

          // Ahora, anulamos los vínculos de pedido_id en det_pedido
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
      <a href="comprobante.php" class="button">Comprobante</a>
    </div>
  </div>
</body>
</html>

