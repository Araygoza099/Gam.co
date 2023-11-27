<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $nombre_usuario = $_POST['username'];
    $email = $_POST['email'];
    $contrasena = $_POST['password'];

    //verifica si el nombre de usuario ya existe
    $check_username = "SELECT * FROM users WHERE username = '$nombre_usuario'";
    $result_username = $con->query($check_username);

    if ($result_username->num_rows > 0) {
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    } else {
        //verifica si el correo electrónico ya existe
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $result_email = $con->query($check_email);

        if ($result_email->num_rows > 0) {
            echo "El correo electrónico ya está registrado. Por favor, utiliza otro.";
        } else {
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

            //inserta nuevo usuario en la base de datos
            $insert_user = "INSERT INTO users (username, email, password) VALUES ('$nombre_usuario', '$email', '$hashed_password')";

            if ($con->query($insert_user) === TRUE) {
                echo "Registro exitoso. Ahora puedes iniciar sesión.";
            } else {
                echo "Error al registrar el usuario: " . $con->error;
            }
        }
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">

                <form class="login" action="index.php" method="post">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Usuario" name="reg_username">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-envelope"></i>
                        <input type="email" class="login__input" placeholder="Correo Electrónico" name="reg_email">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Contraseña" name="reg_password">
                    </div>
                    <button class="button login__submit" type="submit" name="login">
                        <span class="button__text">Registrar</span>
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
