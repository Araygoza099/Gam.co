<?php
    session_start();
    require("bdSQL.php");
    $card_number = $_POST['card_number'];
    $card_date = $_POST['card_date'];
    $card_name = $_POST['card_name'];

    $envioOK = isset($_GET['envio']) ? $_GET['envio'] : '';
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

    header('Location: cart.php'); 
?>