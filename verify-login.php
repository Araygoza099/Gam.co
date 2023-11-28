<?php
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    $nombre = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    $query = "SELECT password, intentos FROM users WHERE username = '$nombre'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];
        $intentos = $row["intentos"];

        if ($intentos >= 3) {
            header('Refresh: 1.5; URL=recovery.php');
            exit; 
        } else {

            if (password_verify($contraseña, $storedPassword)) {
                echo "Inicio de sesión exitoso.";
            } else {
                echo "Usuario o contraseña incorrectos. Inténtelo nuevamente.";
                $intentos++;

                $query = "UPDATE users SET intentos = $intentos WHERE username='$nombre'";
                
                // Olvidaste ejecutar la consulta después de actualizar los intentos
                $conexion->query($query);
            }
        }
    } else {
        echo "Usuario no encontrado. Regístrese primero.";
    }

    $conexion->close();
    header('Refresh: 1.5; location: login.php');
    exit; 
}
?>
