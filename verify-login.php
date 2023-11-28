<php
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexion = new mysqli("localhost:8080", "root", "", "proyecto");
        $nombre = $_POST['Usuario'];
        $contraseña = $_POST['Contraseña'];

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];
        $intentos = $row["intentos"];

            // Verificar la contraseña
            if($intentos>=3){
                header('location: recovery.php');    
            }else{

                if (password_verify($contraseña, $storedPassword)) {
                    echo "Inicio de sesión exitoso.";
                } else {
                    echo "Usuario o contraseña incorrectos. Inténtelo nuevamente.";
                    $intentos++;

                    $query = "UPDATE users SET intentos = $intentos WHERE username='$nombre'";
            }
            }
            

        } else {
            echo "Usuario no encontrado. Regístrese primero.";
        }

        
        
    }
?>