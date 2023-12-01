<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario=$_POST["usuario"];
        $pregunta=$_POST["security-question"];
        $respuesta=$_POST["respuesta"];
        $contraseña=$_POST["password"];

        $hashed_password = password_hash($contraseña, PASSWORD_BCRYPT);

        $query = "SELECT pregunta, respuesta FROM users WHERE username = '$usuario'";
        $result = $conexion->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $question = $row["pregunta"];
            $answer = $row["respuesta"];
            
            if($pregunta==$question && $answer==$respuesta){
                    $query = "UPDATE users SET password = '$hashed_password', intentos = 0  WHERE username = '$usuario'";
                    $conexion->query($query);
                    $conexion->close();
                    header('Refresh: 1.5; URL=alertas/recoveryOk.html');
                    exit; 
            }
        }else{
            $conexion->close();
            header('Refresh: 1.5; URL=alertas/recoveryError.html');
            exit; ;
        }

        $conexion->close();
        header('Refresh: 1.5; URL=alertas/recoveryError.html');
        exit;
    }
?>