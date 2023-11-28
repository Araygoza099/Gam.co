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
    $userid=2;
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $intentos = 0;

    // Generar el hash Bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insertar usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO users (usr_id, username, email, password, intentos) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $userid, $username, $email, $hashed_password, $intentos);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        echo "Error en el registro: " . $stmt->error;
    }

    $stmt->close();
}
else{
    echo "no hice ni madres";
}

$conn->close();
?>
