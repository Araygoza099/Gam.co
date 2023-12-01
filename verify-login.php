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

    session_start();

    if(isset($_POST["captcha_code"])){
        
        if($cadena == $_SESSION["captcha_code"]){
            $band=1;
        }
        else{
            $band=0;
        }
    }
    
    session_unset();

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
                    if(!empty($_POST["remember"])){
                        setcookie("usuario", $_POST["usuario"], time()+86400);
                        setcookie("contraseña", $_POST["contraseña"], time()+86400);
                    }else{
                        setcookie("usuario", "", time() - 86400);
                        setcookie("contraseña", "", time() - 86400);
                    }
                    
                } else {
                    $intentos++;
                    $band=0;
                    $query = "UPDATE users SET intentos = $intentos WHERE username='$nombre'";
                    
                    $conexion->query($query);
                }
            }
        } else {
            $band=0;
        }

        $conexion->close();
        if($band==1){
            header('Location: alertas/loginOk.php');
        }
        else{
            header('Location: alertas/loginError.html');
        }
        header('Refresh: 1.5; location: login.php');
        exit; 
    }
?>


