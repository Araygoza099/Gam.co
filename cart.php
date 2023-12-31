<?php
session_start();
    require("cartSQL.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/gamco_logo.png">
    <title>Carrito | Gam.co</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        .flex{
    background: #ddd;
    min-height: 100vh;
    vertical-align: middle;
    display: flex;
    font-family: sans-serif;
    font-size: 0.8rem;
    font-weight: bold;
    background-image: url(./img/fondo2.png);
}
.logo img{
    width: 150px;
    margin-left: 100px;
    animation: bounceInDown;
    animation-duration: 2s;
  }
.title{
    margin-bottom: 5vh;
}
.card{
    margin: auto;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent;
}
@media(max-width:767px){
    .card{
        margin: 3vh auto;
    }
}
.cart{
    background-color: #ffffff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
}
@media(max-width:767px){
    .cart{
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem;
    }
}
.summary{
    background-color: rgb(104, 38, 86);
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    box-shadow: -10px 0px 10px rgba(0, 0, 0, 0.2);
    padding: 4vh;
    color: rgb(254, 254, 254);
}
@media(max-width:767px){
    .summary{
    border-top-right-radius: unset;
    border-bottom-left-radius: 1rem;
    }
}
.summary .col-2{
    padding: 0;
}
.summary .col-10
{
    padding: 0;
}.row{
    margin: 0;
}
.title b{
    font-size: 1.5rem;
}
.main{
    margin: 0;
    padding: 2vh 0;
    width: 100%;
}
.col-2, .col{
    padding: 0 1vh;
}
a{
    padding: 0 1vh;
}
.close{
    margin-left: auto;
    font-size: 0.7rem;
}
img{
    width: 3.5rem;
}
.back-to-shop{
    margin-top: 4.5rem;
}
h5{
    margin-top: 4vh;
}
hr{
    margin-top: 1.25rem;
}
form{
    padding: 2vh 0;
}
select{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
}
.btn{
    background-color: #dc8b4e;
    border-color: #dc8b4e;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0;
}
.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none; 
}
.btn:hover{
    color: white;
}
a{
    color: black; 
}
a:hover{
    color: black;
    text-decoration: none;
}
 #code{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
}


span.cantidad {
    font-size: 14px; /* Tamaño de la fuente */
    font-weight: bold; /* Negrita */
    text-align: center; /* Alineado al centro */
    display: block; /* Para ocupar el ancho completo del contenedor */
    margin: 0 auto; /* Centrar horizontalmente */

}
.header-princi{
    display: flex;
    font-family: "Rubik", sans-serif;
  }

  .nav-bar ul{
    position: absolute;
    top: 70px;
    right: 300px;
    flex: 1;
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 2rem;
    justify-content: space-between;
   
  }
  
  .nav-bar a{
    color: white;
    text-decoration: none;
    transition: opacity 0.3s;
  }
  
  .nav-bar a:hover {
    opacity: 0.8; 
  }

    </style>
</head>
<body style="background-color: #00011e;">
    <header class="header-princi">
        <div class="logo">
            <a href="inicio.php"><img src="img/logo.png" alt=""></a>
        </div>
        <nav class="nav-bar" >
        <ul>
          <li><a href="tienda.php">TIENDA</a></li>
          <li><a href="acercaDe.php">ACERCA DE</a></li>
          <li><a href="Contacto.php">CONTACTANOS</a></li>
          <li><a href="help.php">AYUDA</a></li>
          <?php
            if(isset($_SESSION['usuario'])){
              //Admin
              $usuario = $_SESSION['usuario'];
              if($usuario === "admin") { ?> 
                <li><a href="admin.php">ADMINISTRAR</a></li> <?php
              } ?>


    <!-- Imagen de la sesion  -->
    <li><a href="logout.php" style=" color: #ffc600;"><?php echo strtoupper($usuario)?></a><br></li>
          
              <?php
            } ?>

         </ul>
        </nav>
    </header>

    <div class="flex">
        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>Carrito</b></h4></div>
                            <div class="col align-self-center text-right text-muted"><?php echo "Número de productos: " . $result->num_rows; ?></div>
                        </div>
                    </div>    
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            
                            <div class="row border-top border-bottom">
                                <div class="row main align-items-center">
                                    <div class="col-2"><img class="img-fluid" src="img/base/<?php echo $row['proc_urlimg']; ?>"></div>
                                    <div class="col">
                                        <div class="row text-muted"><?php echo $row['type']; ?></div>
                                        <div class="row"><?php echo $row['proc_name']; ?></div>
                                    </div>
                                    <div class="col">
                                        <span class="cantidad"><?php echo $row['detpedido_cantidad']; ?></span>
                                        <?php $cantidad+= $row['detpedido_cantidad']; ?>
                                    </div>
                                    <?php $precio = ($row['proc_price'] - ($row['proc_price'] * $row['proc_desc'] / 100)) * $row['detpedido_cantidad'] ; ?>
                                    <div class="col">$ <?php echo number_format($precio, 0, '.', ','); ?>.00 <a href="eliminar_cart.php?detpedido_id=<?php echo $row['detpedido_id']; ?>"><span class="close">&#10005;</span></a></div>
                                    <?php $precioFinal += ($precio); ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Aun no tienes cosas agregadas a tu carrito";
                    }

                    ?>

                    <div class="back-to-shop"><a href="tienda.php">&leftarrow;<span class="text-muted">Regresar a la Tienda</span></a></div>
                </div>

                <div class="col-md-4 summary">
                    <div><h5><b>Resumen</b></h5></div>
                    <hr>
                    <div class="row">
                    <div class="col" style="padding-left:0;">Productos: <?php echo $cantidad; ?> </div>
                    <div class="col text-right">$ <?php echo number_format($precioFinal, 0, '.', ','); ?>.00</div>

                </div>
                <form>
                    <p>ENVIO</p>
                    <?php 
                    $usr_id = $_SESSION['usr_id'];   

                    $query = "SELECT pais FROM direccion WHERE usr_id = $usr_id";

                    // Ejecuta la consulta.
                    $result = $conn->query($query);

                    // Verifica si la consulta fue exitosa.
                    if ($result) {
                        // Obtén el resultado como un array asociativo.
                        $row = mysqli_fetch_assoc($result);

                        // Ahora $row["pais"] contiene el valor del país.
                        $pais = $row["pais"];
                    }else {
                        // Maneja el caso en que la consulta no fue exitosa.
                        echo "Error en la consulta: " . mysqli_error();
                    }


                    if ($pais == "Mexico") {
                        $impuesto = 1.16;
                        ?>
                        <select id="envio">
                            <option class="text-muted" value="0">Envío Estándar - $00.00</option>
                            <option class="text-muted" value="99">Envío Rápido - $99.00</option>
                        </select>
                        <?php
                    } elseif ($pais == "America") {
                        $impuesto = 1.2;
                        ?>
                        <select id="envio">
                            <option class="text-muted" value="99">Envío Estándar - $99.00</option>
                            <option class="text-muted" value="199">Envío Rápido - $199.00</option>
                        </select>
                        <?php
                    } elseif ($pais == "Europa") {
                        $impuesto = 1.35;
                        ?>
                        <select id="envio">
                            <option class="text-muted" value="199">Envío Estándar - $199.00</option>
                            <option class="text-muted" value="299">Envío Rápido - $299.00</option>
                        </select>
                        <?php
                    } elseif ($pais == "Africa") {
                        $impuesto = 1.05;
                        ?>
                        <select id="envio">
                            <option class="text-muted" value="299">Envío Estándar - $299.00</option>
                            <option class="text-muted" value="399">Envío Rápido - $399.00</option>
                        </select>
                        <?php
                    } elseif ($pais == "Asia") {
                        $impuesto = 1.09;
                        ?>
                        <select id="envio">
                            <option class="text-muted" value="399">Envío Estándar - $399.00</option>
                            <option class="text-muted" value="499">Envío Rápido - $499.00</option>
                        </select>
                        <?php
                    } elseif ($pais == "Oceania") {
                        $impuesto = 1.4;
                        ?>
                        <select id="envio">
                            <option class="text-muted" value="499">Envío Estándar - $499.00</option>
                            <option class="text-muted" value="599">Envío Rápido - $599.00</option>
                        </select>
                        <?php
                    }?>
                    
                    
                    
                    <p>Direccion</p>
                    <select id="seleccionarArchivo" onchange="cargarArchivo()">
                    <?php
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo '<option class="text-muted"  value="' . $row['calle'] . '">' . $row['calle'] . '</option>';
                        }
                    }?>
                    <option class="text-muted" value="./formComfirmacion.php"><a href="#respuestaServidor" class="text-muted">Agregar Dirección</a></option>
                    </select>

                    <p>Metodo de Pago</p>
                    <select id="seleccionarArchivo2" onchange="cargarPago()">
                    <?php
                    if ($result3->num_rows > 0) {
                        while ($row = $result3->fetch_assoc()) {
                            echo '<option class="text-muted"  value="' . $row['pago_id'] . '">' . $row['card_number'] . '</option>';
                        }
                    }?>
                    <option class="text-muted" value="./pagos.php"><a href="#respuestaServidor" class="text-muted">Agregar Metodo</a></option>
                    </select>

                    <p>CODIGO</p>
                    <input id="code" placeholder="Incluya su codigo de descuento">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">SUB-TOTAL</div>
                    <div class="col text-right">$ <?php echo number_format($precioFinal, 0, '.', ','); ?></div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0; font-size: x-small">
                    <div class="col">Impuestos</div>
                    <div class="col text-right">$ <?php echo number_format(($precioFinal*$impuesto-$precioFinal), 0, '.', ','); ?></div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0; font-size: x-small">
                    <div class="col">Descuento agregado</div>
                    <div class="col text-right" id="desc"></div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">PRECIO TOTAL (Con envio e Impuestos)</div>
                    <?php $precioFinal = ($precioFinal * $impuesto); $precioFinalRedondeado = round($precioFinal, 2);  ?>
                    <div class="col text-right" id="total">$ <?php echo number_format($precioFinalRedondeado, 0, '.', ','); ?></div>
                </div>

                <?php
                    // Actualizar el campo "total" en la tabla de pedidos
                    $usr_id = $_SESSION['usr_id'];
                    $precioFinalEntero = intval($precioFinal);

                    $sql = "UPDATE pedidos SET total = $precioFinalEntero WHERE usr_id = $usr_id";
                    if ($conn->query($sql) === TRUE) {
                      
                    } else {
                        echo "Error al actualizar los pedidos: " . $conn->error;
                    }

                    // Cierra la conexión y cualquier otra operación necesaria
                    $conn->close();
                    ?>
                <div style="display: flex; justify-content: center; align-items: center;">
    <button style="margin-right: 10px; padding: 8px 20px; background-color: #005bbb; color: #fff; border: none; border-radius: 5px; cursor: pointer;" onclick="pasarVariables()">PAGAR AHORA</button>
    <!-- <button style="border-radius: 5px; display: inline-block;" onclick="pasarVariables()">
        <img src="https://www.axondigital.mx/wp-content/uploads/2019/10/Oxxoapp.jpg" alt="" style="border-radius: 5px; width:110px;">
    </button> -->
        
</div>



            </div>
        </div>
                


        
       
        
    </div>
    
    <div id="respuestaServidor" style="margin-right:-10px; margin-left:20px"></div></div>

    <script>

    function pasarVariables() {
        // Obtener los valores de las variables
        var envio = document.getElementById("envio").value;
        var dir_id = document.getElementById("seleccionarArchivo").value;
        var pago_id = document.getElementById("seleccionarArchivo2").value;
        var preciototal = document.getElementById("total").textContent;

        // Crear un objeto con las variables
        var url = 'compra.php' +
              '?envio=' + encodeURIComponent(envio) +
              '&dir_id=' + encodeURIComponent(dir_id) +
              '&pago_id=' + encodeURIComponent(pago_id) +
              '&preciototal=' + encodeURIComponent(preciototal);

        // Redirigir a la página deseada con los parámetros GET
        window.location.href = url;

    }

     function cargarArchivo() {
    var selectedOption = document.getElementById("seleccionarArchivo").value;

    if (selectedOption === "./formComfirmacion.php") {
        
        $.ajax({
            type: "GET",
            url: selectedOption,
            success: function(response) {
            
                $("#respuestaServidor").html(response);
            },
            error: function() {
                
                $("#respuestaServidor").html("Error al cargar la página.");
            }
        });
    }
}
    function cargarPago(){

        var selectedOption = document.getElementById("seleccionarArchivo2").value;

    if (selectedOption === "./pagos.php") {

        $.ajax({
            type: "GET",
            url: selectedOption,
            success: function(response) {
            
                $("#respuestaServidor").html(response);
            },
            error: function() {
                // Maneja errores si es necesario.
                $("#respuestaServidor").html("Error al cargar la página.");
            }
        
    });
    
}

}

function calcularPrecioTotal() {
    var cupon = $("#code").val();
    var preciototal = <?php echo json_encode($precioFinal); ?>;
    var miDesc=0;
    // Verificar y aplicar descuentos según el cupón
    if (cupon == "CUP10") {
        preciototal = preciototal - (preciototal * 0.10);
        miDesc=-1*(preciototal * 0.10);
    } else if (cupon == "GAMCOELMEJOR2023") {
        preciototal = preciototal - (preciototal * 0.23);
        miDesc=-1*(preciototal * 0.23);
    }
    else if (cupon == "DESC15") {
        preciototal = preciototal - (preciototal * 0.15);
        miDesc=-1*(preciototal * 0.15);
    }
    miDesc=miDesc.toFixed(2);
    document.getElementById("desc").innerHTML = "$" + miDesc;

    return preciototal;
}

function actualizarPrecioTotal() {
    // Obtener el valor seleccionado del elemento select con id "envio"
    var envioSelect = document.getElementById("envio");
    var envioValue = parseInt(envioSelect.value);

    // Obtener el precio total calculado
    var preciototal = calcularPrecioTotal();

    // Sumar el valor del envío a preciototal
    preciototal += envioValue;

    // Formatear el precio total con la moneda y la coma separadora de miles
    var formattedPrecioTotal = preciototal.toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD'
    });

    // Actualizar el precio total en el elemento con id "total"
    $("#total").html(formattedPrecioTotal);

    // Mostrar el botón de envío
    $("#btnsub").css("display", "block");
}

// Ejecutar la actualización al cargar la página
$(document).ready(function () {
    actualizarPrecioTotal();
});

// También puedes agregar la actualización cuando cambia la opción del envío
$("#envio").on("change", function () {
    actualizarPrecioTotal();
});

// También puedes agregar la actualización en tiempo real mientras se escribe el código
$("#code").on("input", function () {
    actualizarPrecioTotal();
});


</script>
    </script>
    </div>
</body>
</html>