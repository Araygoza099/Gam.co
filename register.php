<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro | Gam.co</title>
  <link rel="icon" type="image/x-icon" href="img/gamco_logo.png">
    <link rel="stylesheet" type="text/css" href="css/style_foo.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style_Registro.css">
  <style>
    body {
      overflow-x: hidden; 
      background-image: url(img/fondo2.png);
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="flex">
    <div class="container">
        <div class="col-md-6 white-column">
            <form action="uploadregister.php" method="post" id="registroForm">
                <h2>Registro</h2>
                <div class="input-group">
                    <input type="text" placeholder="Nombre completo" name="name" required>
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
                        <input type="text" placeholder="Calle y Numero" name="calle" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Fraccionamiento"  name="frac" required>
                    </div>
                    <div class="input-group">
                        <input type="number" placeholder="Código postal" name="cp" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Estado" name="edo" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Ciudad" name="cd" required>
                    </div>
                    <div class="input-group">
                        <select name="pais">
                            <option value="" disabled selected>País</option>
                            <option value="America">Argentina</option>
                            <option value="America">Brasil</option>
                            <option value="America">Canadá</option>
                            <option value="Europa">España</option>
                            <option value="America">Estados Unidos</option>
                            <option value="Mexico">México</option>
                            <option value="Europa">Francia</option>
                            <option value="Europa">Italia</option>
                            <option value="Asia">Japón</option>
                            <option value="Oceanía">Australia</option>
                            <option value="Asia">China</option>
                            <option value="Asia">India</option>
                            <option value="África">Sudáfrica</option>
                            <option value="Europa">Rusia</option>
                            <option value="Asia">Corea del Sur</option>
                            <option value="Europa">Reino Unido</option>
                            <option value="Europa">Alemania</option>
                            <option value="America">Canadá</option>
                            <option value="America">Brasil</option>
                            <option value="America">Argentina</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="tel" placeholder="Número de teléfono" name="tel" maxlength="13" required>
                    </div>
                    
                    <button type="submit" class="login-btn" id="btnsub">Registrarse</button>
            </form>

            
        </div>
    </div>
    <div class="container-header">
        <img src="img\register_header.png" alt="Imagen de encabezado" class="header-image">
    </div>
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

    <div style="padding: 150px;"></div>
    <?php include('footer.php'); ?>
</body>
</html>
