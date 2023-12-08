<?php


// Conexión a la base de datos
$servername = "localhost";
$username = "id21632463_admin";
$password = "Pa$$w0rd";
$dbname = "id21632463_proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

?>