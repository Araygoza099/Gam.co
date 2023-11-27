<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "gamco";

    $con = new mysqli($servername, $username, $password, $db);

    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
?>