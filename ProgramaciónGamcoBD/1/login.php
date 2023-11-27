<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['username'];
    $contrasena = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$nombre_usuario'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mod_password = $row["password"];

        if (password_verify($contrasena, $mod_password)) {
            echo "Inicio de sesión exitoso. Bienvenido, $nombre_usuario!<br>";
            echo "Contraseña verificada correctamente.";
        } else {
            echo "Contraseña incorrecta. Inténtalo de nuevo.";
        }
    } else {
        echo "Nombre de usuario no encontrado. Inténtalo de nuevo.";
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" action="index.php" method="post">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Usuario" name="username">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Contraseña" name="password">
                    </div>
                    <button class="button login__submit" type="submit">
                        <span class="button__text">Entrar</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>				
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>		
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>		
        </div>
    </div>
</body>
</html>