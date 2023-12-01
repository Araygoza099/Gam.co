<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$bd = "proyecto";

$con = new mysqli($host, $username, $password, $bd);

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

// array a actualizar
$products = array();

// Consulta SELECT
$sql = "SELECT proc_id, proc_name, proc_descrip, proc_desc, proc_price, cantidad, proc_urlimg, type FROM productos";
$result = $con->query($sql);

// procesa los resultados y actualiza el array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // añade cada fila al array
        $products[] = [
            "id" => $row["proc_id"],
            "name" => $row["proc_name"],
            "descrip" => $row["proc_descrip"],
            "desc" => $row["proc_desc"], 
            "price" => $row["proc_price"],
            "quantity" => $row["cantidad"],
            "image" => $row["proc_urlimg"],
            "type" => $row["type"]
        ];
    }
} else {
    echo "0 resultados";
}

$con->close();

return $products;
?>
