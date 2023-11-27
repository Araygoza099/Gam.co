<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Gam.co</title>
  <link rel="stylesheet" href="css/style_Login.css">
    <style>
    body {
      background-color: #00011e;
    }
  </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="logo">
            <img src="img\gamco_logo.jpg" alt="Logo">
        </div>
        <form class="login-form">
            <h2>Iniciar sesión</h2>
            <div class="input-group">
                <input type="text" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Contraseña" required>
            </div>
            <div class="options">
                <a href="register.php" class="small-text">Registrarse</a>
                <a href="recovery.php" class="small-text">¿Olvidaste la contraseña?</a>
            </div>
            <button type="submit" class="login-btn">Ingresar</button>
            <div class="remember-me" >
                <input type="checkbox" id="remember-me">
                <label for="remember-me">Recuérdame</label>
            </div>
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
