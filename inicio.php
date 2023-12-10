<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" name="viewport" content="width=device-widht, initial-scale=1.0">
    <title>Inicio | Gam.co</title>
    <link rel="stylesheet" type="text/css" href="css/style_index.css">
    <link rel="stylesheet" href="css/style_suscrip.css"> 
    <link rel="icon" type="image/x-icon" href="img/gamco_logo.png">
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,700;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
   <link rel="stylesheet" href="style-card.css">
 <style>
  
 </style>
  </head>
  <body >
    <!-- RECORDAR CAMBIAR NOMBRE DE HTML A PHP -->
   <?php session_start();?>

    <div class="parallax" >

      <header class="header-princi">
        <div class="logo">
            <a href="inicio.php"><img src="img/logo.png" alt=""></a>
        </div>
        <nav class="nav-bar" >
        <ul>
          <li><a href="tienda.php">TIENDA</a></li>
          <li><a href="acercaDe.php">ACERCA DE</a></li>
          <li><a href="Contacto.php">CONTACTANOS</a></li>
          <li><a href="help.php">AYUDA</a></li>
          <?php
            if(isset($_SESSION['usuario'])){
              //Admin
              $usuario = $_SESSION['usuario'];
              if($usuario === "admin") { ?> 
                <li><a href="admin.php">Administrar</a></li> <?php
              } ?>

              <!-- Imagen de la sesion  -->
              <li><a href="logout.php"><p style="margin: 0; cursor: pointer; color: #ffc600;"><?php echo strtoupper($usuario)?></p></a><br></li>

              <!-- Carrito  -->
              <li>
                <div class="cart-icon-container">
                  <!-- Muestra el numero, luego se obtendra de la base de datos -->
                  <?php require("cartSQL.php");
                  if (isset($_SESSION['num_productos'])) {
                      echo '<span class="product-count">' . $_SESSION['num_productos'] . '</span>';
                  } else {
                    ?> <span class="product-count">0</span> <?php
                  }?>
                  <a href="cart.php" class="cart-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path fill="#ffffff" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                  </a>
                </div>
              </li> 
              
              <?php
            } else {
              // Iniciar Sesion ?>
              <li><a href="login.php">INICIAR SESION</a></li> <?php
            } ?>

         </ul>
        </nav>
      </header>

       <div class="hero"  data-aos="fade-right" data-aos-duration="2000">
        <div class="wrapper">
          <h1 class="hero__title">
            <span>Presiona Start!</span> Gaming sin límites!
          </h1>
          <button class="button">Compra ya!</button>
        </div>
      </div>

      
        <img src="img/CAPA_0.png" class="humo1" data-aos="fade-up" data-aos-duration="2000" alt="">
     
    
        <img src="img/CAPA_1.png" class="spiderman" data-aos="zoom-in-down" data-aos-duration="2000" alt="">
     
      
        <img src="img/CAPA_2.png" class="rachet" data-aos="fade-up-right" data-aos-duration="2000" alt="">
    
     
        <img src="img/CAPA_3.png" class="elden" data-aos="fade-right" data-aos-duration="2000" alt="">
     
        <img src="img/CAPA_4.png" class="cyber" data-aos="fade-up-right" data-aos-duration="2000" alt="">
     
        <img src="img/CAPA_5.png" class="gow"  data-aos="fade-left" data-aos-duration="2000" alt="">
      
        <img src="img/CAPA_6.png" class="blue" data-aos="fade-up-right" data-aos-duration="2000" alt="">
     
        <img src="img/CAPA_7.png" class="ellie" data-aos="fade-up-left" data-aos-duration="2000" alt="">
     
      
      <img src="img/FOREGROUND1.png" class="foreNaranja"  alt="">
      <img src="img/FOREGROUND2.png" class="foreAzul"  alt=""> 

  
      
    </div>

    <main class="contenido_princi" >
      <div class="recomendaciones" data-aos="fade-up-right">
        <h1 style="color: white; font-size: 30px;">Recomendaciones Para ti</h1>
        <div>
          <div class="card-container">
            <div class="card">
              <img src="./img/rdr.png" alt="rdr2">
              <div class="intro">
                <h1 >Red</h1>
                <div class="precio">
                  <div class="precio-oferta">
                  <div class="precio etiqueta-oferta" >Oferta: $19.99</div>
                  <div class="precio etiqueta-regular">Precio Regular: $29.99</div>
                </div>
                </div>
              </div>
            </div>
            <div class="card">
              <img src="./img/cyberpunkCover.png" alt="rdr2">
              <div class="intro">
                <h1 >cyberPunk</h1>
                <div class="precio">
                  <div class="precio-oferta">
                  <div class="precio etiqueta-oferta">Oferta: $19.99</div>
                  <div class="precio etiqueta-regular">Precio Regular: $29.99</div>
                </div>
              </div>
              </div>
            </div>
            <div class="card">
              <img src="./img/spidermanCover.png" alt="rdr2">
              <div class="intro">
                <h1>Spiderman</h1>
                <div class="precio">
                  <div class="precio-oferta">
                  <div class="precio etiqueta-oferta">Oferta: $19.99</div>
                  <div class="precio etiqueta-regular">Precio Regular: $29.99</div>
                </div>
              </div>
              </div>
             
          </div>
          
        </div>
        <button class="boton"><a href="tienda.php">Ver Todo</a></button>
          </div>
      </div>
     
      
    
    </main>

    <main>
      <div class="slide" data-aos="fade-up-right">
        <h1 class="titulo" >Mas Ofertas para ti</h1>
        <div class="anuncios">
         
          <img class="img1" src="img/anuncio1.png" alt="">
          <img class="img2" src="img/anuncio2.png" alt="">
        </div>
        <div class="carousel">
          <div class="pic-ctn">
            <img src="img/carousel1.png" alt="" class="pic">
            <img src="img/carousel2.png" alt="" class="pic">
            <img src="img/carousel3.png" alt="" class="pic">
            <img src="img/carousel1.png" alt="" class="pic">
            <img src="img/carousel2.png" alt="" class="pic">
         
          </div>
        </div>
        <div class="butonBottom"><button class="boton2" ><a href="tienda.php">Ir a Tienda</a></button></div>
     </div>
   
    
    </main>

      <div class="sus" data-aos="fade-up-right">
    <div class="containerr">  
        <form id="contactus" action="CorreoCupon.php" method="post">
          <h3>Suscribete!</h3>
          <h4>Para recibir un cupon de regalo!</h4>
          <fieldset>
            
          </fieldset>
          <fieldset>
            <button name="submit" type="submit" id="contactus-submit" data-submit="...Sending">Suscribete Ahora</button>
          </fieldset>
        </form>
       
            <img src="img/ellie.png" alt="" class="imgEllie">
        </div>
    </div>

    
   
 <div class="espacio">

 </div>
    
   
      
     <?php include('footer.php'); ?>  

  </body>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="script_login.js"></script>
 <script>
  document.addEventListener("DOMContentLoaded", function() {
  // Esperar 2 segundos antes de agregar la clase 'animate'
  setTimeout(function() {
    var parallaxItems = document.querySelectorAll('.parallax > *');
    parallaxItems.forEach(function(item) {
      item.classList.add('animate');
    });
  }, 2000);
});
</script>

</html>