<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Gam.co</title>
    <link rel="stylesheet" href="css/style_Tienda.css">
    
    <style>
        body {
            overflow-x: hidden; 
            background-color: #00011e;
        }
    </style>
</head>
<body>
    <header>
        <?php include('header.php'); ?>
    </header>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Sidebar con filtros -->
        <aside class="sidebar">
            <h2>Filtros</h2>
            <h3>Ordenar por:</h3>
            <form method="get">
                <label for="filtro1">Categoria</label>
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
                $products = [
                    ["id" => 1, "name" => "Resident Evil 4 Remake", "price" => "$1499", "discount" => "30%", "image" => "img1.1.jpg", "descripcion" => "Revive la clásica historia de Leon S. Kennedy en una versión remasterizada con gráficos mejorados y una experiencia renovada de terror y supervivencia.", "quantity" => 10, "type" => "Videojuegos"],
                    ["id" => 2, "name" => "Red Dead Redemption 2", "price" => "$1299", "discount" => "10%", "image" => "img1.2.jpeg", "descripcion" => "Sumérgete en el salvaje oeste como Arthur Morgan, un forajido en una emocionante aventura llena de acción, decisiones morales y un vasto mundo abierto.", "quantity" => 5, "type" => "Videojuegos"],
                    ["id" => 3, "name" => "Minecraft", "price" => "$999", "discount" => "0%", "image" => "img1.3.png", "descripcion" => "Un juego de construcción y aventura en un mundo generado proceduralmente, donde puedes explorar, crear y sobrevivir en un entorno pixelado.", "quantity" => 20, "type" => "Videojuegos"],
                    ["id" => 4, "name" => "Cuphead", "price" => "$1599", "discount" => "0%", "image" => "img1.4.jpg", "descripcion" => "Un desafiante juego de plataformas con un estilo artístico inspirado en las caricaturas de los años 30, lleno de jefes épicos y mecánicas de juego desafiantes.", "quantity" => 0, "type" => "Videojuegos"],
                    ["id" => 5, "name" => "Control Blanco Xbox", "price" => "$599", "discount" => "5%", "image" => "img2.1.webp", "descripcion" => "Un control inalámbrico para Xbox con un diseño blanco elegante y ergonómico que ofrece una experiencia de juego cómoda y precisa.", "quantity" => 8, "type" => "Accesorios"],
                    ["id" => 6, "name" => "Control Rojo Xbox", "price" => "$799", "discount" => "0%", "image" => "img2.2.webp", "descripcion" => "Un control inalámbrico para Xbox en un vibrante color rojo, diseñado para brindar una conexión estable y una jugabilidad fluida.", "quantity" => 15, "type" => "Accesorios"],
                    ["id" => 7, "name" => "Control Azul Xbox", "price" => "$899", "discount" => "0%", "image" => "img2.3.jpg", "descripcion" => "Un control inalámbrico para Xbox con un llamativo acabado azul, ofrece una respuesta táctil precisa y una experiencia de juego envolvente.", "quantity" => 0, "type" => "Accesorios"],
                    ["id" => 8, "name" => "Control Negro Xbox", "price" => "$999", "discount" => "0%", "image" => "img2.4.webp", "descripcion" => "Un control inalámbrico para Xbox en un clásico color negro, con tecnología avanzada para una conectividad sin retrasos y una jugabilidad suave.", "quantity" => 3, "type" => "Accesorios"],
                ];

                $categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'opcion0';

                // Muestra máximo 12 productos por página
                $productsPerPage = 12;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $productsPerPage;
                $end = $start + $productsPerPage;

                foreach ($products as $product) {

                    if ($categoriaSeleccionada === 'opcion0' || $product['type'] === $categoriaSeleccionada) {
                        // Mostrar el producto, puedes utilizar la estructura que ya tienes para mostrar los productos.
                        echo '<div class="product">';
                        echo '<img src="img/base/' . $product["image"] . '" alt="' . $product["name"] . '">';
                        echo '<h2>' . $product["name"] . '</h2>';
                        
                        
                        // Verificar si la cantidad disponible es cero
                        if ($product["quantity"] == 0) {
                            echo ' style="color: #999;"'; 
                        }
                        
                        echo '>' . $product["name"] . '</h2>';
                    
                        $discountedPrice = $product["price"];
                        if ($product["discount"] > "0%") {
                            $priceValue = intval(str_replace("$", "", $product["price"]));
                            $discountValue = intval(str_replace("%", "", $product["discount"]));
                            $discountedPrice = '$' . ($priceValue - ($priceValue * $discountValue / 100));
                            
                            if ($product["quantity"] == 0) {
                                echo '<p><span style="color: #999; text-decoration: line-through;">' . $product["price"] . '</span>';
                                echo ' Precio: ' . $discountedPrice . '</p>';
                            } else {
                                echo '<p>Precio: ' . $product["price"] . '</p>';
                            }
                        } else {
                            if ($product["quantity"] == 0) {
                                echo '<p><span style="color: #999;">Precio: ' . $product["price"] . '</span></p>';
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
                        echo "<p id='description'>" . $product['descripcion'] . "</p>";
                        echo '</div>';
                    
                        // ... (Resto de la estructura de tu producto)
                        echo '</div>';
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

    <!-- Pie de página -->
    <footer>
        <?php include('footer.php'); ?>
    </footer>
</body>
</html>
