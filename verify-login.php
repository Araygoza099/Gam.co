<?php
    $cadena = $_POST["captcha_code"];

    // Establecer la longitud máxima deseada (por ejemplo, 10 caracteres)
    $longitudMaxima = 6;

    // Verificar y ajustar la longitud
    if (strlen($cadena) > $longitudMaxima) {
        // Si la cadena es demasiado larga, truncarla
        $cadena = substr($cadena, 0, $longitudMaxima);
    } elseif (strlen($cadena) < $longitudMaxima) {
        // Si es demasiado corta, puedes agregar caracteres, por ejemplo, espacios
        $cadena .= str_repeat('a', $longitudMaxima - strlen($cadena));
    }

    // Aquí puedes hacer lo que necesites con la cadena ajustada
    echo "Cadena ajustada: " . $cadena;

    session_start();

    if(isset($_POST["captcha_code"])){
        
        if($cadena == $_SESSION["captcha_code"]){
             $message ='Message Submitted Successfully';
        }
        else{
            $message = 'Captcha incorrecto intentalo de nuevo';
        }
    }
    
    if(isset($message)){
        echo $message;
    }session_unset();

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
