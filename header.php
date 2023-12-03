<!-- Encabezado cuando NO ha iniciado sesion -->

<!-- <head>
  <link rel="stylesheet" href="css/style_header.css">
  <script src="https://kit.fontawesome.com/0c5cf4a4b8.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,700;1,900&display=swap">
</head>
<header class="not-logged-in">
  <header class="header-princi">
    <div class="logo">
    <a href="inicio.php"><img src="img/logo.png" alt=""></a>
    </div>
    <nav class="nav-bar" >
    <ul >
          <li><a style="color: white;" href="index.php">Inicio</a></li>
          <li><a href="tienda.php">Tienda</a></li>
          <li><a href="acercaDe.php">Acerca de</a></li>
          <li><a href="Contacto.php">Contactanos</a></li>
          <li><a href="help.php">Ayuda</a></li>
          <li><a href="login.php">Cuenta</a></li>
          <li>
          <div class="cart-icon-container">
            <span class="product-count">0</span>
            <a href="#" class="cart-icon">
              <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
<path fill="#ffffff" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
             
            </a>
          </div>
          </li>
        </ul>
    </nav>
    <script src="script_login.js"></script>
  </header>
</header> -->

<head>
  <link rel="stylesheet" href="css/style_header.css">
  <script src="https://kit.fontawesome.com/0c5cf4a4b8.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,700;1,900&display=swap">
</head>
<header class="header-princi" style="margin-bottom:75px;">
    <?php session_start(); ?>
    <div class="logo">
      <a href="inicio.php"><img src="img/logo.png" style="width:125px; height:auto;"></a>
    </div>
    <nav class="nav-bar" >
    <style>
      .menu-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%; 
        background-image: url('img/avatar.png');
        background-size: cover;
        cursor: pointer;
        margin-top:-10px;
      }

      .dropdown-menu {
        display: none;
        position: absolute;
        top: 45px;
        background-color: #3a3d3ef7;
        padding: 10px;
        border: #ffc600 1px solid;
        border-radius: 10px;
      }

      .dropdown-menu a {
        display: block;
        color: white;
        text-decoration: none;
        margin-bottom: 5px;
      }

      .dropdown-menu a:hover {
        text-decoration: underline;
      }

    </style>
    <ul>
          <li><a style="color: white;" href="index.php">INICIO</a></li>
          <li><a href="tienda.php">TIENDA</a></li>
          <li><a href="acercaDe.php">ACERCA DE</a></li>
          <li><a href="Contacto.php">CONTACTANOS</a></li>
          <li><a href="help.php">AYUDA</a></li>
          <?php
            if(isset($_SESSION['usuario'])){
              //Admin
              $usuario = $_SESSION['usuario'];
              if($usuario === "admin") { ?> 
                <li><a href="admin.php">ADMINISTRAR</a></li> <?php
              } ?>

              <!-- Carrito  -->
              <li>
                <div class="cart-icon-container">
                  <!-- Muestra el numero, luego se obtendra de la base de datos -->
                  <span class="product-count">0</span> 
                  <a href="#" class="cart-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path fill="#ffffff" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                  </a>
                </div>
              </li> 

              <!-- Imagen de la sesion  -->
              <li>
              <div class="menu-btn" onclick="toggleMenu()"></div>
                <div class="dropdown-menu" id="dropdownMenu">
                  <a href="#"><p style="margin: 0; cursor: pointer; color: #ffc600;"><?php echo strtoupper($usuario)?></p></a><br>
                  <a href="logout.php" style="color: white; text-decoration: none;">Cerrar Sesion</a>
                </div> 
              </div> 
              </li>
              
              <script>
                function toggleMenu() {
                  var menu = document.getElementById("dropdownMenu");
                  if (menu.style.display === "block") {
                    menu.style.display = "none";
                  } else {
                    menu.style.display = "block";
                  }
                }
              </script><?php
            } else {
              // Iniciar Sesion ?>
              <li><a href="login.php">INICIAR SESION</a></li> <?php
            } ?>
    </ul>
    </nav>
    <script src="script_login.js"></script>
</header>