<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar contraseña | Gam.co</title> 
  <link rel="stylesheet" href="css/style_PasswordRecovery.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        <form class="password-recovery-form" action="verify-recovery.php" method="post">
            <h2>Recuperar contraseña</h2>
            <div class="input-group">
                <input type="text" placeholder="Usuario" name="usuario" required>
            </div>
            <div class="input-group">
                <select name="security-question" required>
                    <option value="" disabled selected>Elige una pregunta de seguridad</option>
                    <option value="color">¿Cuál es tu color favorito?</option>
                    <option value="mascota">¿Cuál es el nombre de tu primera mascota?</option>
                    <option value="ciudad">¿En qué ciudad naciste?</option>
                    <option value="libro">¿Cuál es tu libro favorito?</option>
                    <option value="equipo">¿Cuál es tu equipo deportivo favorito?</option>
                    <option value="pelicula">¿Cuál es tu película favorita?</option>
                </select>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Respuesta" name="respuesta" required>
            </div>
            <div class="input-group">
                    <input type="password" placeholder="Nueva contraseña" id="password1" name="password" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Repetir contraseña" id="password2" oninput="verificarContraseñas()" required>
                </div> 
            <div id="mensaje" class="mismatch"></div>
            <button type="submit" class="login-btn" id="btnsub">Recuperar</button>
        </form>
    </div>
    

    <script>
        function verificarContraseñas() {
            var password1 = $("#password1").val();
            var password2 = $("#password2").val();
            var mensaje = $("#mensaje");

            // Verificar si ambos campos de contraseña están vacíos
            if (password1 == "" || password2 == "") {
                mensaje.html("");
                $("#btnsub").css("display", "none");
                $("#mensaje").css("padding-bottom", "3em");
                return;
            }

            // Verificar si las contraseñas coinciden
            
            if (password1 == password2) {
                mensaje.html("Las contraseñas coinciden.");
                mensaje.removeClass("mismatch");
                $("#mensaje").css("color", "green");                
                $("#btnsub").css("display","block");
                $("#mensaje").css("padding-bottom", "0px");
            } else {
                mensaje.html("Las contraseñas no coinciden.");
                mensaje.addClass("mismatch");
                $("#mensaje").css("color", "red");
                $("#btnsub").css("display","none");
                $("#mensaje").css("padding-bottom", "3em");
            }
        }

        // Ejecutar la verificación al cargar la página
        $(document).ready(function() {
            verificarContraseñas();
        });

        // También puedes agregar la verificación en tiempo real mientras se escribe
        $("#password1, #password2").on("input", function() {
            verificarContraseñas();
        });
    </script>

</body>
</html>
