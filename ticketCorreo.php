<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        
        require 'Exception.php';
        require 'PHPMailer.php';
        require 'SMTP.php';

        require("bdSQL.php");
        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------
        session_start();
        $usr_id = $_SESSION['usr_id'];

        // Consulta SQL para obtener la fila con el pagado_id máximo para el usr_id dado
        $sql_max_pagado_id = "SELECT MAX(pagado_id) AS max_pagado_id
                            FROM pagados
                            WHERE usr_id = $usr_id";

        $result_max_pagado_id = $conn->query($sql_max_pagado_id);

        if ($result_max_pagado_id->num_rows > 0) {
            $row_max_pagado_id = $result_max_pagado_id->fetch_assoc();
            $max_pagado_id = $row_max_pagado_id['max_pagado_id'];

            // Consulta principal utilizando el pagado_id máximo
            $sql = "SELECT *
                    FROM det_pedido AS dp
                    INNER JOIN pagados AS p ON dp.pagado_id = p.pagado_id
                    INNER JOIN users AS u ON p.usr_id = u.usr_id
                    INNER JOIN direccion AS d ON p.dir_id = d.dir_id
                    INNER JOIN pagos AS pg ON p.pago_id = pg.pago_id
                    INNER JOIN productos AS pr ON dp.proc_id = pr.proc_id
                    WHERE u.usr_id = $usr_id AND p.pagado_id = $max_pagado_id";

            $result = $conn->query($sql);
        }



        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

        //Algoritmo para extraer el codigo de usuario

        $subject='Ticket Gam.co';
        $msg='
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Ticket</title>
                <link rel="stylesheet" href="css/style_ticket.css">
                <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
                <style>
                @font-face {
                    font-family: mifuente;
                    src: url(../Ticketing.ttf);
                }
                
                body{
                    background-image: url(../img/fondo2.png); 
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    margin: 0;
                    font-family: mifuente;
                    color: black;
                }
                
                .ticket{
                    width: 300px;
                    max-width: 100%;
                    height: auto;
                    background-image: url(../img/ticketFondo.png);
                    border: 1px solid #000000;
                    border-radius: 10px;
                    padding: 40px;
                }
                
                
                .header {
                    text-align: center;
                    margin-bottom: 10px;
                }
                
                .items {
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    padding: 10px 0;
                    margin-bottom: 10px;
                }
                
                .item {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 5px;
                    
                }
                
                .top{
                    border-top: 1px solid #000000;
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 5px;
                    font-weight: bold;
                }
                
                .total {
                    margin-bottom: 5px;
                    font-weight: bold;
                    border-bottom: 1px solid #000000;
                }
                
                #values{
                    float: right;
                }
                
                .footer {
                    margin-top: 10px;
                    text-align: center;
                    font-size: 12px;
                    color: #777;
                }
                
                .qr{
                    width: 60%;
                    opacity: 0.8;
                }
                </style>
            </head>

            <body>
                <div class="ticket">
                    <div class="header">
                        <h2>======GAM.CO======</h2>
                        <p>-Gaming sin Limites!-</p>
                        <div class="top">
                            <span>ID ' . "\t" .'Cant.' . "\t" .'Producto</span>
                            <span>' . "\t" .'PRECIO</span>
                        </div>
                    </div>
        ';

        if ($result->num_rows > 0) {
            $msg .= '<div class="items">';
            while ($row = $result->fetch_assoc()) {
                $msg .= '<div class="item">';
                $msg .= '<span>' . $row['proc_id'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['detpedido_cantidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['proc_name'] . '</span>';
                $msg .= '<span>$' . $row['prec_unitario'] * $row['detpedido_cantidad'] . '</span>';
                $msg .= '</div>';
                $total = $row['total'];
                $subtotal += ($row['prec_unitario'] * $row['detpedido_cantidad']);
                $envio = $row['envio'];
                $pais = $row['pais'];
        
                $metod_pago = $row['card_number'];
                $dire_envio = $row['calle'] . '&nbsp;&nbsp;&nbsp;' . $row['fracc'] . '&nbsp;&nbsp;&nbsp;' . $row['zipcode'] . '&nbsp;&nbsp;&nbsp;' . $row['estado'] . '&nbsp;&nbsp;&nbsp;' . $row['ciudad'] . '&nbsp;&nbsp;&nbsp;' . $row['pais'];
                $nombre=$row['usr_name'];
                $correo=$row['email'];
                $name_card=$row['card_name'];
            }
        
            if($name_card == "OXXO"){
                $pago="OXXO";
            }else{
                $pago="Tarjeta";
            }
        
            if ($pais == "Mexico") {
                $impuesto = 0.16;
            } elseif ($pais == "America") {
                $impuesto = 0.20;
            } elseif ($pais == "Europa") {
                $impuesto = 0.35;
            } elseif ($pais == "Africa") {
                $impuesto = 0.05;
            } elseif ($pais == "Asia") {
                $impuesto = 0.09;
            } elseif ($pais == "Oceania") {
                $impuesto = 0.40;
            }
            $msg .= '</div>';
        
            $msg .= '<div class="total">';
        
            $msg .= '<span>SUBTOTAL:</span>';
        
            $msg .= '<span id="values">$' . $subtotal . '</span> <br>';
        
            $msg .= '<span>Impuesto:</span>';
        
            $msg .= '<span id="values">$' . $impuesto * $subtotal . '</span> <br>';
        
            $msg .= '<span>Direccion de Envio:</span> <br>';
        
            $msg .= '<span style="font-size:10px;" >' . $dire_envio . '</span> <br>';
        
            $msg .= '<span>Costo de Envio:</span>';
        
            $msg .= '<span id="values">$' . $envio . '</span> <br>';
        
            $msg .= '<span>Metodo de Pago:</span>';
        
            $msg .= '<span id="values" style="font-size:10px;">' . $pago . '</span> <br>';

            $msg .= '<span>Num. ref: </span>';

            $msg .= '<span id="values">' . $metod_pago . '</span>';
        
            $msg .= '<span>TOTAL:</span>';
        
            $msg .= '<span id="values">' . $total . '</span>';
        
            $msg .= '</div>';
        
            $msg .= '<div class="footer">';
            $msg .= '<p>¡Gracias por tu compra!</p>';
            $msg .= '</div>';

        }

        $msg.='
        </body>
        </html>';

        $conn->close();
    

        try {
            $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = 0; 
            $mail->isSMTP(); 
            $mail->Host = 'smtp-mail.outlook.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'gam.co2023@outlook.com'; 
            $mail->Password = 'gamco2023'; 
            $mail->SMTPSecure = 'STARTTLS'; 
            $mail->Port = 587;                                 

            //Recipients
            $mail->setFrom('gam.co2023@outlook.com');
            $mail->addAddress($correo, $nombre);
    
            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;

            $mail->Body = $msg;

            // Envía el correo
            $mail->send();
                header('Location: alertas/emailOK.html');
        } catch (Exception $e) {
            header('Location: alertas/emailError.html');
        }       
          

    ?>