<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar | Gam.co</title>
    <link rel="stylesheet" href="css/style_Login.css">
    <link rel="icon" type="image/x-icon" href="img/gamco_logo.png">
    <link rel="stylesheet" type="text/css" href="css/style_foo.css">
    <style>
        body {
            overflow-x: hidden; 
            background-image: url(img/fondo2.png);
            }
        #cl{
        color:red;

        }
        #cl , a{
            text-decoration:none;
            margin:0 auto;
        }
        #show{
            margin:0 auto;
            font-weight:bold;
            text-align:center;
        }
        .text-success{
            margin:0 auto;
            text-align:center;
            margin:0.4rem 0;
            padding:0.3rem 0.2rem;
            font-size:1.9rem;
        }
        .text-danger{
            margin:0 auto;
            text-align:center;
            margin:0.4rem 0;
            padding:0.3rem 0.2rem;
            font-size:1.9rem;
        }
        .buttons {
      margin-top: 20px;
    }
    .buttons a {
      text-decoration: none;
    }
    .buttons button {
      background-color: #ffc600;
      color: #00011e;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      margin: 0 10px;
      font-size: 16px;
      cursor: pointer;
    }
    .return-btn {
      margin-top: 20px;
    }
    .return-btn button {
      background-color: #ffc600;
      color: #00011e;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: white;
    }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="flex" style="background-image: url(img/fondo2.png); ; margin-bottom:-200px;">
    <div class="container">
         <div class="corner-image">
            <img src="img\admin_pag.png" alt="Esquina">
          </div>
          <div class="buttons">
            <a href="alta_productos.php"><button style="margin-top: 20px;">Altas</button></a> 
            <a href="baja_productos.php"><button style="margin-top: 20px;">Bajas</button></a>
            <a href="modificar_productos.php"><button style="margin-top: 20px;">Cambios</button></a>
            <a href="graficas.php"><button style="margin-top: 20px;">Graficas</button></a>
          </div>
        
          <div class="return-btn">
            <a href="index.php"><button style="margin-left: 20px;">Regresar</button></a>
          </div>
    </div>
    </div>
    <div style="padding: 150px;"></div>
    <?php include('footer.php'); ?>
</body>
</html>
