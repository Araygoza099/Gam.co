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
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
        echo '<meta http-equiv="refresh" content="3;url=register.php">';
    } else {
        // Si no existe, procede con el registro del usuario

        $sql = "SELECT MAX(usr_id) AS ultimo_id FROM users";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $ultimo_id = $fila['ultimo_id'];
            $nuevo_id = $ultimo_id + 1;
        }

        $userid=$nuevo_id;
        $password = $_POST["password"];
        $email = $_POST["email"];
        $pregunta=$_POST["security-question"];
        $respuesta=$_POST["respuesta"];
        $intentos = 0;

        // Generar el hash Bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insertar usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO users (usr_id, username, email, password, intentos, pregunta, respuesta) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $userid, $username, $email, $hashed_password, $intentos, $pregunta, $respuesta);

        if ($stmt->execute()) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
            header("Refresh: 1.5; URL=login.php");
        } else {
            echo "Error en el registro: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmtCheck->close();
}
else{
    echo "Algo no funciona";
}

$conn->close();
?>
