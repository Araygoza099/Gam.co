<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Registro de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usr_id'];
    $sql2 = "SELECT MAX(dir_id) AS last_id FROM direccion";
    $resultado2 = $conn->query($sql2);

    if ($resultado2->num_rows > 0) {
        $fila2 = $resultado2->fetch_assoc();
        $ultimo_id2 = $fila2['last_id'];
        $nuevo_id2 = $ultimo_id2 + 1;
    }

    $calle=$_POST['calle'];
    $frac=$_POST['frac'];
    $cp=$_POST['cp'];
    $edo=$_POST['edo'];
    $cd=$_POST['cd'];
    $tel=$_POST['tel'];

    $stmt2 = $conn->prepare("INSERT INTO direccion (dir_id, usr_id,	calle, fracc, zipcode, estado, ciudad, num_tel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("iississi", $nuevo_id2,  $nuevo_id, $calle, $frac, $cp, $edo, $cd, $tel);


    if ($stmt2->execute()) {
        header("Location: alertas/registroOk.php"); 
    } else {
        $mensaje= "Algo no funciona";
        header("Location: alertas/registroError.php?variable=$mensaje"); 
    }

    $stmt2->close();
    $stmtCheck->close();
}
else{
    $mensaje= "Algo no funciona";
    header("Location: alertas/registroError.php?variable=$mensaje"); 
}

$conn->close();
?>
