<!-- Encabezado cuando NO ha iniciado sesion -->
<head>
    <link rel="stylesheet" href="css/style_FooHead.css">
</head>
<header class="not-logged-in">
    <nav>
        <ul>
            <li id="home" style="margin-left: 1px;">
                <a href="inicio.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-houses" viewBox="0 0 16 16">
                        <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z"/>
                    </svg> Inicio
                </a>
            </li>
            <li><a href="#">Tienda</a></li>
            <li><a href="paginas/acerdaDe.php">Acerca De</a></li>
            <li><a href="paginas/Contacto.php">Contáctanos</a></li>
            <li><a href="#">Ayuda</a></li>
        </ul>
    </nav>
    <div class="login-register">
        <a href="#">Iniciar sesión</a>
        <a href="#">Registrarse</a>
    </div>
</header>

<!-- Encabezado cuando ha iniciado sesion -->
<header class="logged-in">
    <nav>
        <ul>
            <li id="home">
                <a href="inicio.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-houses" viewBox="0 0 16 16" style="margin-left: 2px;">
                        <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z"/>
                    </svg>  Inicio
                </a>
            </li>
            <li><a href="#">Tienda</a></li>
            <li><a href="paginas/acerdaDe.php">Acerca De</a></li>
            <li><a href="paginas/Contacto.php">Contáctanos</a></li>
            <li><a href="#">Ayuda</a></li>
        </ul>
    </nav>
    <div class="user-actions">
        <span style = "color: white;"> User 1 </span>
        <a href="#">Cerrar sesión</a>
    </div>
</header>

<!-- Eslogan -->
<div style="background-color: #fff; color: #fff; padding: 1px;"> </div>
<div class="row">
    <div  style = "text-align:center; background-color: #1b2838; color: #fff;">"Tu Éxito es Nuestra Línea de Código."</div>
</div>
<div style="background-color: #fff; color: #fff; padding: 1px;"> </div>
