<?php
session_start();

if(isset($_SESSION['usuario'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica si el carrito de compras ya existe en la sesión, si no, créalo
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    
        // Recibe los datos del producto desde el formulario
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
    
        // Agrega el producto al carrito
        $item = array(
            'id' => $productId,
            'name' => $productName,
            'quantity' => $quantity,
            'price' => $price
        );
    
        $_SESSION['cart'][] = $item;
        
        header('location: tienda.php');
    } else {
        // Maneja el caso en que la solicitud no sea POST
        header('location: cartError.php');
    }
}else{
    header('location: alertas/cartError.html');
}

?>
