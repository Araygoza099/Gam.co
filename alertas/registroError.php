<?php 
  $mensaje = $_GET['variable'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <link rel="icon" type="image/x-icon" href="../img/gamco_logo.png">
  <link rel="stylesheet" href="../css/styleAlert.scss">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,700;1,900&display=swap">
</head>
<body>
  <div class="containerError">
    <img style="width: 100%;" src="../img/gokutamal.gif" alt="img" width="100">
    <h4>Algo anda mal...</h4>
    <p class="message"><?php echo "$mensaje"; ?></p>
    <a href="../register.php"><button class="nice-button-error nice-button nice-button-round" >Volver a intentar</button></a>
    
  </div>
    
</body>
</html>