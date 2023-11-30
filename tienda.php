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
                <h1>Gam.co - Productos</h1>
            </header>

            <!-- Contenido de los productos -->
            <section class="products">
                <?php
                // Simulación de productos desde una base de datos
                $products = [
                    ["id" => 1, "name" => "Resident Evil 4 Remake", "price" => "$1499", "discount" => "30%", "image" => "img1.1.jpg", "descripcion" => "Revive la clásica historia de Leon S. Kennedy en una versión remasterizada con gráficos mejorados y una experiencia renovada de terror y supervivencia."],
                    ["id" => 2, "name" => "Red Dead Redemption 2", "price" => "$1299", "discount" => "10%", "image" => "img1.2.jpeg", "descripcion" => "Sumérgete en el salvaje oeste como Arthur Morgan, un forajido en una emocionante aventura llena de acción, decisiones morales y un vasto mundo abierto."],
                    ["id" => 3, "name" => "Minecraft", "price" => "$999", "discount" => "0%", "image" => "img1.3.png", "descripcion" => "Un juego de construcción y aventura en un mundo generado proceduralmente, donde puedes explorar, crear y sobrevivir en un entorno pixelado."],
                    ["id" => 4, "name" => "Cuphead", "price" => "$1599", "discount" => "0%", "image" => "img1.4.jpg", "descripcion" => "Un desafiante juego de plataformas con un estilo artístico inspirado en las caricaturas de los años 30, lleno de jefes épicos y mecánicas de juego desafiantes."],
                    ["id" => 5, "name" => "Control Blanco Xbox", "price" => "$599", "discount" => "5%", "image" => "img2.1.webp", "descripcion" => "Un control inalámbrico para Xbox con un diseño blanco elegante y ergonómico que ofrece una experiencia de juego cómoda y precisa."],
                    ["id" => 6, "name" => "Control Rojo Xbox", "price" => "$799", "discount" => "0%", "image" => "img2.2.webp", "descripcion" => "Un control inalámbrico para Xbox en un vibrante color rojo, diseñado para brindar una conexión estable y una jugabilidad fluida."],
                    ["id" => 7, "name" => "Control Azul Xbox", "price" => "$899", "discount" => "0%", "image" => "img2.3.jpg", "descripcion" => "Un control inalámbrico para Xbox con un llamativo acabado azul, ofrece una respuesta táctil precisa y una experiencia de juego envolvente."],
                    ["id" => 8, "name" => "Control Negro Xbox", "price" => "$999", "discount" => "0%", "image" => "img2.4.webp", "descripcion" => "Un control inalámbrico para Xbox en un clásico color negro, con tecnología avanzada para una conectividad sin retrasos y una jugabilidad suave."],
                ];
                
                

                // Muestra máximo 12 productos por página
                $productsPerPage = 12;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $productsPerPage;
                $end = $start + $productsPerPage;

                for ($i = $start; $i < $end && $i < count($products); $i++) {
                    $product = $products[$i];
                    echo '<div class="product">';
                    echo '<img src="img/base/' . $product["image"] . '" alt="' . $product["name"] . '">';
                    echo '<h2>' . $product["name"] . '</h2>';

                    // Calcula el precio con descuento si el descuento es mayor a 0
                    $discountedPrice = $product["price"];
                    if ($product["discount"] > "0%") {
                        $priceValue = intval(str_replace("$", "", $product["price"]));
                        $discountValue = intval(str_replace("%", "", $product["discount"]));
                        $discountedPrice = '$' . ($priceValue - ($priceValue * $discountValue / 100));
                        
                        // Muestra el precio original con descuento tachado y en gris
                        echo '<p><span style="color: #999; text-decoration: line-through;">' . $product["price"] . '</span>';
                        echo ' Precio: ' . $discountedPrice . '</p>';
                    } else {
                        // Muestra el precio normal si no hay descuento
                        echo '<p>Precio: ' . $product["price"] . '</p>';
                    }

                    echo '<a href="#">Agregar al Carrito</a>';?>
                    <br><div style="color: #ffc600; text-align: justify; background-color: #00011e; border-radius: 10px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); padding: 20px; font-family: 'Roboto', sans-serif; font-size: 18px; line-height: 1.5;">
    <?php echo "<p style='color: #ffc600; font-size: 20px; font-family: Arial, sans-serif;'>" . $product['descripcion'] . "</p>"; ?>
</div>


 <?php
 
                    echo '</div>';
                }
                ?>
            </section>

            <div class="pagination">
                <?php
                // Cálculo de la paginación
                $totalPages = ceil(count($products) / $productsPerPage);
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
                ?>
            </div>
        </main>
    </div>

    <!-- Pie de página -->
    <footer>
        <?php include('footer.php'); ?>
    </footer>

</body>
</html>
