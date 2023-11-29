<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eneba - Productos</title>
    <link rel="stylesheet" href="css/style_Tienda.css">
    <style>
    body {
      overflow-x: hidden; 
      background-color: #00011e;
    }
  </style>
</head>
<body>

<!-- Contenedor principal -->
<div class="container">
    <!-- Sidebar con filtros -->
    <aside class="sidebar">
        <h2>Filtros</h2>
        <!-- Aquí puedes agregar opciones de filtrado -->
        <label for="filtro1">Filtro 1:</label>
        <select id="filtro1">
            <option value="opcion1">Opción 1</option>
            <option value="opcion2">Opción 2</option>
            <!-- Agrega más opciones según sea necesario -->
        </select>

        <!-- Agrega más filtros si lo necesitas -->
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <!-- Encabezado -->
        <header>
            <h1>Eneba - Productos</h1>
        </header>

        <!-- Contenido de los productos -->
        <section class="products">
            <?php
            // Simulación de productos desde una base de datos
            $products = [
                ["id" => 1, "name" => "Producto 1", "price" => "$20", "image" => "product1.jpg"],
                ["id" => 2, "name" => "Producto 2", "price" => "$30", "image" => "product2.jpg"],
                // ... Más productos ...
            ];

            // Muestra máximo 12 productos por página
            $productsPerPage = 12;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $productsPerPage;
            $end = $start + $productsPerPage;

            for ($i = $start; $i < $end && $i < count($products); $i++) {
                $product = $products[$i];
                echo '<div class="product">';
                echo '<img src="images/' . $product["image"] . '" alt="' . $product["name"] . '">';
                echo '<h2>' . $product["name"] . '</h2>';
                echo '<p>Precio: ' . $product["price"] . '</p>';
                echo '<a href="#">Comprar</a>';
                echo '</div>';
            }
            ?>
        </section>

        <!-- Paginación -->
        <div class="pagination">
            <!-- Enlace para cargar más productos -->
            <?php
            $totalPages = ceil(count($products) / $productsPerPage);
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </main>
</div>

<!-- Pie de página -->
<footer >
    <p>Derechos reservados &copy; 2023 Eneba</p>
</footer>

</body>
</html>
