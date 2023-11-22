<!-- Actualizacion -->
<div style="background-color: #fff; color: #fff; padding: 1px;"> </div>
<div class="row" style = "background-color: #1b2838; color: #fff; display: flex; items">
    <div class="col-4" style="text-align: center;"><div>Última actualización: <?php date_default_timezone_set("America/Mexico_City"); echo date("d/m/Y H:i:s", filemtime(__FILE__)); ?></div></div>
</div>
<div style="background-color: #fff; color: #fff; padding: 1px;"> </div>

<!-- Footer -->
<footer>
    <div id="contacto" style="font-size: small; margin-left: 3px;">
        <p>Tepezala 507, 20010, Aguascalientes, Ags, Rinconada a Loreto
        <br> 449 237 7977 <br>Cod3Crafterz@gmail.com </p>
    </div>
    <div id="legal">
        <p style="color: white;">&copy; 2023 Code Crafters. Todos los derechos reservados.</p>
        <a href="#">Política de privacidad</a>
        <a href="#">Términos de servicio</a>
    </div>
</footer>

<!-- Cambiar si inicio sesion -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const isLoggedIn = true; // Ajusta según el estado de inicio de sesión real.
        if (isLoggedIn) {
            document.querySelector('.not-logged-in').style.display = 'none';
            document.querySelector('.logged-in').style.display = 'flex';
        } else {
            document.querySelector('.not-logged-in').style.display = 'flex';
            document.querySelector('.logged-in').style.display = 'none';
        }
    });
</script>
