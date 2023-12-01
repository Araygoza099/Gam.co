<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro | Gam.co</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style_Registro.css">
  <style>
    body {
      overflow-x: hidden; 
      background-color: #00011e;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="col-md-6 white-column">
            <form action="uploadregister.php" method="post" id="registroForm">
                <h2>Registro</h2>
                <div class="input-group">
                    <input type="text" placeholder="Nombre completo" required>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Usuario" name="username" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Correo electrónico" name="email" required>
                </div>
                <div id="mensaje" class="mismatch"></div>
                <div class="input-group">
                    <input type="password" placeholder="Contraseña" id="password1" name="password" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Repetir contraseña" id="password2" oninput="verificarContraseñas()" required>
                </div> 
                <div class="input-group">
                    <select name="security-question" required>
                    <option value="" disabled selected>Selecciona una pregunta de seguridad</option>
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
                </div>
                <div class="col-md-6 yellow-column">
                    <h3>Dirección de envío</h3>
                    <div class="input-group">
                        <input type="text" placeholder="Calle" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Fraccionamiento" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Código postal" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Estado" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Ciudad" required>
                    </div>
                    <div class="input-group">
                        <input type="tel" placeholder="Número de teléfono" required>
                    </div>
                    <button type="submit" class="login-btn" id="btnsub">Registrarse</button>
            </form>
        </div>
    </div>
    <div class="container-header">
        <img src="img\register_header.png" alt="Imagen de encabezado" class="header-image">
    </div>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function verificarContraseñas() {
            var password1 = $("#password1").val();
            var password2 = $("#password2").val();
            // var btn = document.getElementById("btnsub");

            // Verificar si ambos campos de contraseña están vacíos
            if (password1 == "" || password2 == "") {
                $("#btnsub").css("display", "none");
                return;
            }

            // Verificar si las contraseñas coinciden
            var mensaje = $("#mensaje");
            if (password1 == password2) {
                mensaje.html("Las contraseñas coinciden.");
                mensaje.removeClass("mismatch");
                $("#mensaje").css("color", "green");                
                $("#btnsub").css("display","block");
            } else {
                mensaje.html("Las contraseñas no coinciden.");
                mensaje.addClass("mismatch");
                $("#mensaje").css("color", "red");
                $("#btnsub").css("display","none");
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
