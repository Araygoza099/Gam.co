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
                
                <label for="filtro2">Precio</label>
                <br>
                <select id="filtro2" name="precio">
                    <option value="mayor">Mayor->Menor</option>
                    <option value="menor">Menor->Mayor</option>
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

                require('productos.php');

                $categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'opcion0';

                $precioFinal = array();
                 
                // foreach ($products as $product) {
                //     if ($categoriaSeleccionada === 'opcion0' || $product['type'] === $categoriaSeleccionada) {
                //         $precioFinal[$product['id']] = isset($product["price"]) ? $product["price"] : 0;

                //         if (isset($product["desc"]) && $product["desc"] > 0) {
                //             $precioFinal[$product['id']] = $precioFinal[$product['id']] - ($precioFinal[$product['id']] * $product["desc"] / 100);
                //         }
                //     }
                // }

                foreach ($products as $productId => $product) {
                    if ($categoriaSeleccionada === 'opcion0' || $product['type'] === $categoriaSeleccionada) {
                        $precioFinal[$productId] = isset($product["price"]) ? $product["price"] : 0;

                        if (isset($product["desc"]) && $product["desc"] > 0) {
                            $precioFinal[$productId] = $precioFinal[$productId] - ($precioFinal[$productId] * $product["desc"] / 100);
                        }
                    }
                }

                // Ordenar el array de precios según la opción seleccionada
                if (isset($_GET['precio'])) {
                    if ($_GET['precio'] === 'mayor') {
                        arsort($precioFinal);
                    } else {
                        asort($precioFinal);
                    }
                }

                foreach ($precioFinal as $productId => $precio) {
                    $product = isset($products[$productId]) ? $products[$productId] : null;
                    if ($product && ($categoriaSeleccionada === 'opcion0' || $product['type'] === $categoriaSeleccionada)) {
                            // Resto del código para mostrar el producto
                            echo '<div class="product">';
                            echo '<img src="img/base/' . (isset($product["image"]) ? $product["image"] : '') . '" alt="' . (isset($product["name"]) ? $product["name"] : '') . '">';
                            echo '<h2';

                            // Verificar si la cantidad disponible es cero
                            if (isset($product["quantity"]) && $product["quantity"] == 0) {
                                echo ' style="color: #999;"'; 
                            }

                            echo '>' . (isset($product["name"]) ? $product["name"] : '') . '</h2>';
                            
                            $discountedPrice = $precio;
                            if (isset($product["desc"]) && $product["desc"] > 0) {
                                echo '<p><span style="color: #999; text-decoration: line-through;"> $'. (isset($product["price"]) ? $product["price"] : '') . '</span>';
                                echo ' Precio: ' . $discountedPrice . '</p>';
                            } else {
                                if (isset($product["quantity"]) && $product["quantity"] == 0) {
                                    echo '<p><span style="color: #999;">Precio: $' . $precio . '</span></p>';
                                } else {
                                    echo '<p>Precio: ' . $precio . '</p>';
                                }
                            }
                            
                            if (isset($product["quantity"]) && $product["quantity"] == 0) {
                                echo '<a>No Disponible</a>';
                            } else {
                                // echo '<a href="verify-cart.php">Agregar al Carrito</a>';
                                echo '<form action="verify-cart.php" method="post">';
                                echo '<input type="hidden" name="productId" value="' . $product['id'] . '">';
                                echo '<input type="hidden" name="productName" value="' . (isset($product["name"]) ? $product["name"] : '') . '">';
                                echo '<input type="number" name="cantidad" value="1" min="1" max="' . (isset($product["quantity"]) ? $product["quantity"] : 0) . '" style="display: block; font-family: \'Rubik\', sans-serif; text-align: center; padding: 8px 0px; margin-top: 15px; background-color: #333; color: #fff; text-decoration: none; border-radius: 5px; width: 100%; font-size: .95em;">';
                                echo '<input type="hidden" name="precio" value="' . $precio . '">';
                                echo '<button class="button-agregar" type="submit">Agregar al Carrito</button>';
                                echo '</form>';
                            }
                            
                            echo '<br><div class="desc">';
                            echo "<p id='description'>" . (isset($product['descrip']) ? $product['descrip'] : '') . "</p>";
                            echo '</div>';
                            
                            // ... (Resto de la estructura de tu producto)
                            echo '</div>';
                        
                    }             
                }
    
                ?>
            </section>

            
        </main>
    </div>

    <div style="padding: 150px;"></div>
    <?php include('footer.php'); ?>

</body>
</html>
