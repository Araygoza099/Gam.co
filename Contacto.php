<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contact Us | Gam.co </title>
  <link rel="stylesheet" type="text/css" href="css/style_foo.css"> 
  <link rel="stylesheet" href="css/style_Contacto.css">
  <link rel="icon" type="image/x-icon" href="img/gamco_logo.png">
  <style>
    body {
      overflow-x: hidden; 
      background-color: #00011e;
    }
  </style>
</head>
<body>

    <?php include('header.php'); ?>

  <div class="form">
    <div class="background">
      <div class="container">
        <div class="screen">
          <div class="screen-header">
            <div class="screen-header-left">
              <div class="screen-header-button close"></div>
              <div class="screen-header-button maximize"></div>
              <div class="screen-header-button minimize"></div>
            </div>
            <div class="screen-header-right">
              <div class="screen-header-ellipsis"></div>
              <div class="screen-header-ellipsis"></div>
              <div class="screen-header-ellipsis"></div>
            </div>
          </div>
          <div class="screen-body">
            <div class="screen-body-item left">
              <div class="app-title">
                <span>CONTACT</span>
                <span>US</span>
              </div>
              <div class="app-contact">CONTACT INFO : +52 449 373 5654</div>
            </div>
            <div class="screen-body-item">
              <div class="app-form">
                <form action="correo.php" method="post">
                  <div class="app-form-group">
                  <input class="app-form-control" placeholder="USER" name="user">
                </div>
                <div class="app-form-group">
                  <input class="app-form-control" placeholder="EMAIL" name="email">
                </div>
                <div class="app-form-group">
                  <input class="app-form-control" placeholder="CONTACT NO" name="number">
                </div>
                <div class="app-form-group message">
                  <input class="app-form-control" placeholder="MESSAGE" name="message">
                </div>
                <div class="app-form-group buttons">
                  <button href="inicio.php" class="app-form-button">CANCEL</button>
                  <button type="submit"class="app-form-button">SEND</button>
                </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>


  
  <div style="padding: 100px;"></div>
  <?php include('footer.php'); ?>

</body>
</html>
