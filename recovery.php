<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar contraseña | Gam.co</title>
  <link rel="stylesheet" href="css/style_PasswordRecovery.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="corner-image">
            <img src="img\recovery_esquina.png" alt="Esquina">
        </div>
        <div class="logo">
            <img src="img\gamco_logo.jpg" alt="Logo">
        </div>
        <form class="password-recovery-form">
            <h2>Recuperar contraseña</h2>
            <div class="input-group">
                <select name="security-question" required>
                    <option value="" disabled selected>Elige una pregunta de seguridad</option>
                    <option value="question1">¿Cuál es el nombre de tu primera mascota?</option>
                    <option value="question2">¿Cuál es tu comida favorita?</option>
                    <!-- Agrega más opciones de preguntas aquí -->
                </select>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Respuesta" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Nueva contraseña" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirmar contraseña" required>
            </div>
            <div class="options">
                <a href="register.php" class="small-text">Registrarse</a>
                <a href="login.php" class="small-text">Ingresar</a>
            </div>
            <button type="submit" class="login-btn">Recuperar</button>
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
