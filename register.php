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
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
            <div class="col-md-6 white-column">
                <form action="">
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
                    <div class="input-group">
                        <input type="password" placeholder="Contraseña" required>
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Repetir contraseña" required>
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
</body>
</html>
