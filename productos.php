<?php
$products = [
                    ["id" => 1, "name" => "Resident Evil 4 Remake", "price" => "$1800", "discount" => "10%", "image" => "img1.1.jpg"],
                    ["id" => 2, "name" => "Red Dead Redemption 2", "price" => "$1200", "discount" => "10%", "image" => "img1.2.jpeg"],
                    ["id" => 3, "name" => "Minecraft", "price" => "$700", "discount" => "5%", "image" => "img1.3.png"],
                    ["id" => 4, "name" => "Cuphead", "price" => "$1599", "discount" => "10%", "image" => "img1.4.jpg"],
                    ["id" => 5, "name" => "Control Xbox Series X|S", "price" => "$1000", "discount" => "5%", "image" => "img2.1.webp"],
                    ["id" => 6, "name" => "Control Xbox Series X|S Camuflaje Rojo", "price" => "$1000", "discount" => "5%", "image" => "img2.2.webp"],
                    ["id" => 7, "name" => "Control Xbox Series X|S Azul", "price" => "$1000", "discount" => "5%", "image" => "img2.3.jpg"],
                    ["id" => 8, "name" => "Control Xbox Series X|S Negro", "price" => "$1000", "discount" => "5%", "image" => "img2.4.webp"],
                ];
?>

<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$bd = "proyecto";

$con = new mysqli($host, $username, $password, $bd);

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

//aray a actualizar
$products = array();

// Consulta SELECT
$sql = "SELECT proc_id, proc_name, proc_desc, proc_price, proc_urlimg, type FROM productos";
$result = $con->query($sql);

//procesa los resultados y actualiza el array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //añade cada fila al array
        $products[] = [
            "id" => $row["proc_id"],
            "name" => $row["proc_name"],
            "price" => $row["proc_price"],
            "description" => $row["proc_desc"],
            "image" => $row["proc_urlimg"],
            "type" => $row["type"]
        ];
    }
} else {
    echo "0 resultados";
}

$con->close();

print_r($products);

?>
