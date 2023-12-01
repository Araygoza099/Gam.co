<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Inicio | Gam.co</title>
    <link rel="stylesheet" type="text/css" href="css/style_index.css"> 
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
   <link rel="stylesheet" href="css/style-card.css">
 <style>
  
 </style>
  </head>
  <body >
    <!-- RECORDAR CAMBIAR NOMBRE DE HTML A PHP -->
   

    <div class="parallax" >

      <header class="header-princi">
        <div class="logo">
            <img src="img/logo.png" alt="">
        </div>
        <nav class="nav-bar" >
          <ul >
            <li><a style="color: white;" href="">Inicio</a></li>
            <li><a href="">Tienda</a></li>
            <li><a href="">Acerca de</a></li>
            <li><a href="">Contactanos</a></li>
            <li><a href="">Ayuda</a></li>
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

    <main class="contenido_princi">
      <div class="recomendaciones">
        <h1 style="color: white; font-size: 30px;">Recomendaciones Para ti</h1>
        <div>
          <div class="card-container">
            <div class="card">
              <img src="./img/rdr.png" alt="rdr2">
              <div class="intro">
                <h1 style=" font-size: 30px;">Red</h1>
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
                <h1 style=" font-size: 30px;">cyberPunk</h1>
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
                <h1 style=" font-size: 30px;">Spiderman</h1>
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
     
      
    
    </main>

    <main>
      <div class="slide">
        <h1 style="color: white; font-size: 30px; margin-left:400px;">Mas Ofertas para ti</h1>
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
        <button class="boton2" ><a href="tienda.php">Ir a Tienda</a></button>
     </div>
    </main>
    
   
 <div class="espacio">

 </div>
    
   
      
     <?php include('footer.php'); ?>  

  </body>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
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


