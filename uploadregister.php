<?php
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

// Registro de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener el nombre de usuario del formulario
    $username = $_POST["username"];

    // Verificar si el nombre de usuario ya existe
    $checkUsernameQuery = "SELECT COUNT(*) as count FROM users WHERE username = ?";
    $stmtCheck = $conn->prepare($checkUsernameQuery);
    $stmtCheck->bind_param("s", $username);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $rowCheck = $resultCheck->fetch_assoc();

    // Si count es mayor que 0, significa que el nombre de usuario ya existe
    if ($rowCheck['count'] > 0) {
        $mensaje= "El nombre de usuario ya está en uso. Por favor, elige otro.";
        header("Location: alertas/registroError.php?variable=$mensaje"); 
        // echo '<meta http-equiv="refresh" content="3;url=register.php">';
    } else {
        // Si no existe, procede con el registro del usuario

        $sql = "SELECT MAX(usr_id) AS ultimo_id FROM users";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $ultimo_id = $fila['ultimo_id'];
            $nuevo_id = $ultimo_id + 1;
        }

        $sql2 = "SELECT MAX(dir_id) AS last_id FROM direccion";
        $resultado2 = $conn->query($sql2);

        if ($resultado2->num_rows > 0) {
            $fila2 = $resultado2->fetch_assoc();
            $ultimo_id2 = $fila2['last_id'];
            $nuevo_id2 = $ultimo_id2 + 1;
        }

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

        

        $userid=$nuevo_id;
        $password = $_POST["password"];
        $email = $_POST["email"];
        $pregunta=$_POST["security-question"];
        $respuesta=$_POST["respuesta"];
        $intentos = 0;

        $calle=$_POST['calle'];
        $frac=$_POST['frac'];
        $cp=$_POST['cp'];
        $edo=$_POST['edo'];
        $cd=$_POST['cd'];
        $tel=$_POST['tel'];

        // Generar el hash Bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insertar usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO users (usr_id, username, email, password, intentos, pregunta, respuesta) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $userid, $username, $email, $hashed_password, $intentos, $pregunta, $respuesta);

        $stmt2 = $conn->prepare("INSERT INTO direccion (dir_id, usr_id,	calle, fracc, zipcode, estado, ciudad, num_tel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("iississi", $nuevo_id2,  $nuevo_id, $calle, $frac, $cp, $edo, $cd, $tel);

        $total=0;
        $pagoid=0;
        $pagado=0;
        $stmt3 = $conn->prepare("INSERT INTO pedidos (pedido_id, usr_id, pago_id, total, pagado) VALUES (?, ?, ?, ?, ?)");
        $stmt3->bind_param("iiiii", $pedido_id, $nuevo_id, $pagoid, $total, $pagado);


        if ($stmt->execute()) {
            header("Location: alertas/registroOk.php"); 
        } else {
            $mensaje= "Algo no funciona";
            header("Location: alertas/registroError.php?variable=$mensaje"); 
        }

        if ($stmt2->execute()) {
            header("Location: alertas/registroOk.php"); 
        } else {
            $mensaje= "Algo no funciona";
            header("Location: alertas/registroError.php?variable=$mensaje"); 
        }

        if ($stmt3->execute()) {
            header("Location: alertas/registroOk.php"); 
        } else {
            $mensaje= "Algo no funciona";
            header("Location: alertas/registroError.php?variable=$mensaje"); 
        }

        $stmt->close();
        $stmt2->close();
        $stmt3->close();
        $stmtCheck->close();
    }

}
else{
    $mensaje= "Algo no funciona";
    header("Location: alertas/registroError.php?variable=$mensaje"); 
}

$conn->close();
?>
