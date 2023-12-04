<?php require "productos.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Gam.co</title>
    <link rel="stylesheet" href="css/style_Tienda.css">
    <link rel="icon" type="image/x-icon" href="img/gamco_logo.png">
    <link rel="stylesheet" type="text/css" href="css/style_foo.css"> 
    <style>
        body {
        overflow-x: hidden; 
        background-image: url(img/fondo2.png);
        }
    </style>
</head>
<body>

    <?php include('header.php'); ?>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Sidebar con filtros -->
        <aside class="sidebar">
            <h2>Filtros</h2>
            <h3>Ordenar por:</h3>
            <form method="get">
                <label for="filtro1">Categoria</label>
                <br>
                <select id="filtro1" name="categoria">
                    <option value="opcion0">Todos</option>
                    <option value="Videojuegos">Videojuegos</option>
                    <option value="Accesorios">Accesorios</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <!-- Encabezado -->
            <header>
                <h1>Gam.co - Productos</h1>
            </header>

            <!-- Contenido de los productos -->
            <section class="products">
                <?php
                // Simulación de productos desde una base de datos
                require("productos.php"); 

                $categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'opcion0';

                // Muestra máximo 12 productos por página
$productsPerPage = 12;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $productsPerPage;
$end = $start + $productsPerPage;

$counter = 0; // Variable para llevar el conteo de productos mostrados

foreach ($products as $product) {
    if ($categoriaSeleccionada === 'opcion0' || $product['type'] === $categoriaSeleccionada) {
        if ($counter >= $start && $counter < $end) {
            echo '<div class="product">';
            echo '<img src="img/base/' . $product["image"] . '" alt="' . $product["name"] . '">';
            echo '<h2';

            // Verificar si la cantidad disponible es cero
            if ($product["quantity"] == 0) {
                echo ' style="color: #999;"'; 
            }

            echo '>' . $product["name"] . '</h2>';
            
            $discountedPrice = $product["price"];
            if ($product["desc"] > 0) {
                $priceValue = $product["price"];
                $discountValue = $product["desc"];
                $discountedPrice = '$' . ($priceValue - ($priceValue * $discountValue / 100));

                echo '<p><span style="color: #999; text-decoration: line-through;"> $'. $product["price"] . '</span>';
                echo ' Precio: ' . $discountedPrice . '</p>';

            } else {
                if ($product["quantity"] == 0) {
                    echo '<p><span style="color: #999;">Precio: $' . $product["price"] . '</span></p>';
                } else {
                    echo '<p>Precio: ' . $product["price"] . '</p>';
                }
            }
            
            if ($product["quantity"] == 0) {
                echo '<a>No Disponible</a>';
            } else {
                echo '<a href="#">Agregar al Carrito</a>';
            }
            
            echo '<br><div class="desc">';
            echo "<p id='description'>" . $product['descrip'] . "</p>";
            echo '</div>';
            
            // ... (Resto de la estructura de tu producto)
            echo '</div>';
        }
        $counter++; // Incrementa el contador de productos mostrados
    }             
}
    
                ?>
            </section>

            <div class="pagination">
                <?php
                $totalPages = ceil(count($products) / $productsPerPage);
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                } ?>
            </div>
        </main>
    </div>

    <div style="padding: 150px;"></div>
    <?php include('footer.php'); ?>

    </body>
</html>
