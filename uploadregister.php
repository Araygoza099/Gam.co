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

    $sql = "SELECT MAX(usr_id) AS ultimo_id FROM users";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $ultimo_id = $fila['ultimo_id'];
        $nuevo_id = $ultimo_id + 1;
    }

    $userid=$nuevo_id;
    $username = $_POST["username"];
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
        $stmt->close();
        header('Refresh: 1.5; URL=alertas/registerOk.html');
        exit; 
    } else {
        $stmt->close();
        header('Refresh: 1.5; URL=alertas/registerError.html');
        exit; 
    }

    $stmt->close();
}
else{
    echo "no hice ni madres";
}

$conn->close();
?>
