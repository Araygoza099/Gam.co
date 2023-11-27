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
            <form action="" id="registroForm">
                <h2>Registro</h2>
                <div class="input-group">
                    <input type="text" placeholder="Nombre completo" required>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Usuario" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Correo electrónico" required>
                </div>
                <div id="mensaje" class="mismatch"></div>
                <div class="input-group">
                    <input type="password" placeholder="Contraseña" id="password1" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Repetir contraseña" id="password2" oninput="verificarContraseñas()" required>
                </div> 
                <div class="input-group">
                    <select required>
                        <option value="" disabled selected>Pregunta de seguridad</option>
                        <option value="mascota">Cual es tu juego favorito??</option>
                    </select>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Respuesta" required>
                </div>
            </form>
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
            <button type="submit" class="login-btn">Registrarse</button>
            </form>
        </div>
    </div>
    <div class="container-header">
        <img src="img\register_header.png" alt="Imagen de encabezado" class="header-image">
    </div>
    <?php include('footer.php'); ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function verificarContraseñas() {
            var password1 = $("#password1").val();
            var password2 = $("#password2").val();

            // Verificar si ambos campos de contraseña están vacíos
            if (password1 === "" || password2 === "") {
                $("#mensaje").html("");
                $("#mensaje").addClass("mismatch");
                $("#mensaje").css("color", "black");
                return;
            }

            // Verificar si las contraseñas coinciden
            var mensaje = $("#mensaje");
            if (password1 === password2) {
                mensaje.html("Las contraseñas coinciden.");
                mensaje.removeClass("mismatch");
                $("#mensaje").css("color", "green");
            } else {
                mensaje.html("Las contraseñas no coinciden.");
                mensaje.addClass("mismatch");
                $("#mensaje").css("color", "red");
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
