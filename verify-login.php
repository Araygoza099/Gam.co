<?phpsession_start();?>
<?phpob_start();?>
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

    $band=1;

    
    session_unset();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require("cartSQL.php");

        $nombre = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];

        $query = "SELECT password, intentos FROM users WHERE username = '$nombre'";
        $result = $conexion->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row["password"];
            $intentos = $row["intentos"];

            if ($intentos >= 3) {
                header('Refresh: 1.5; URL=alertas/bloqueo.html');
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
                    $mensaje="Usuario o contraseña incorrectos";
                    $query = "UPDATE users SET intentos = $intentos WHERE username='$nombre'";
                    
                    $conexion->query($query);
                }
                
            }
        } else {
            $band=0;
        }

        echo $band;
        if($band==1){
            echo $nombre;
            session_register('usuario');
            $_SESSION['usuario'] = $nombre;
            if (session_status() === PHP_SESSION_ACTIVE) {
    echo "Hay una sesión activa.<br>";

    // Verificar si una variable de sesión específica está definida
    if (isset($_SESSION['usuario'])) {
        $usr_id = $_SESSION['usuario'];
        echo "El usuario está identificado con el ID: $nombre";
    } else {
        echo "La variable 'usuario' no está definida en la sesión.";
        echo $nombre;
        echo $band;
    }
} else {
    echo "No hay ninguna sesión activa.";
}

            $sql = "SELECT usr_id FROM users WHERE username = '$nombre'";
            $result = $conexion->query($sql);
            $row = $result->fetch_assoc();
            
            // Extrae el valor de usr_id
            $usr_id = $row['usr_id'];
            $_SESSION['usr_id'] =$usr_id;
            if (session_status() === PHP_SESSION_ACTIVE) {
    echo "Hay una sesión activa.<br>";
        echo $usr_id;
    // Verificar si una variable de sesión específica está definida
    if (isset($_SESSION['usr_id'])) {
        $usr_id = $_SESSION['usr_id'];
        echo "El usuario está identificado con el ID: $usr_id";
    } else {
        echo "La variable 'usr_id' no está definida en la sesión. 1";
        echo "Coman KK";
    }
} else {
    echo "No hay ninguna sesión activa.";
}
            $conexion->close();
            header("Location: alertas/loginOk.php");
            exit();
        }
        else{
            $conexion->close();
            header("Location: alertas/loginError.php?variable=$mensaje");
            exit();
        }
        header('Refresh: 1.5; location: login.php');
        exit; 
    }
?>