<?php
require ("bdSQL.php");
session_start();
$usr_id = $_SESSION['usr_id'];

// Consulta SQL para obtener la fila con el pagado_id máximo para el usr_id dado
$sql = "SELECT *
        FROM det_pedido AS dp
        INNER JOIN pagados AS p ON dp.pagado_id = p.pagado_id
        INNER JOIN users AS u ON p.usr_id = u.usr_id
        INNER JOIN direccion AS d ON p.dir_id = d.dir_id
        INNER JOIN pagos AS pg ON p.pago_id = pg.pago_id
        INNER JOIN productos AS pr ON dp.proc_id = pr.proc_id
        WHERE u.usr_id = $usr_id";
        

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>detpedido_id</th>
    <th>proc_id</th>
    <th>pedido_id</th>
    <th>pagado_id</th>
    <th>detpedido_cantidad</th>
    <th>prec_unitario</th>
    <th>dir_id</th>
    <th>usr_id</th>
    <th>pago_id</th>
    <th>envio</th>
    <th>total</th>
    <th>proc_name</th>
    <th>proc_descrip</th>
    <th>proc_desc</th>
    <th>proc_price</th>
    <th>cantidad</th>
    <th>proc_urlimg</th>
    <th>type</th>
    </tr>";

    // Imprimir datos de la fila recuperada
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}
// Cerrar la conexión
$conn->close();

?>
