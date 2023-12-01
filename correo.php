<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        
        require 'Exception.php';
        require 'PHPMailer.php';
        require 'SMTP.php';

        //Algoritmo para extraer el codigo de usuario

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario=$_POST['user'];
            $correo=$_POST['email'];
            $numero=$_POST['number'];
            $mensaje=$_POST['message'];
            $subject='Contacto Gam.co';
            $msg='
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Respuesta de Formulario</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        color: #333;
                        margin: 0;
                        padding: 0;
                    }
            
                    .respuesta-container {
                        max-width: 600px;
                        margin: 50px auto;
                        padding: 20px;
                        background-color: #fff;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
            
                    .detalles-contacto ul {
                        list-style: none;
                        padding: 0;
                    }
            
                    .detalles-contacto li {
                        margin-bottom: 10px;
                    }
            
                    .mensaje p {
                        margin-bottom: 15px;
                    }
            
                    .firma {
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
            
                <div class="respuesta-container">
                    <h1>¡Hola ' . $usuario . '!</h1>
                    <p>Gracias por ponerte en contacto con nosotros. Hemos recibido tu formulario y estamos emocionados de saber más sobre tus inquietudes.</p>
            
                    <div class="detalles-contacto">
                        <p><strong>Detalles de Contacto:</strong></p>
                        <ul>
                            <li><strong>Nombre de usuario:</strong> ' . $usuario . ' </li>
                            <li><strong>Correo Electrónico:</strong> ' . $correo . '</li>
                            <li><strong>Número de Contacto:</strong> ' . $numero . '</li>
                        </ul>
                    </div>
            
                    <div class="mensaje">
                        <p><strong>Mensaje:</strong></p>
                        <p>' . $mensaje . '</p>
                    </div>
            
                    <p>Estamos revisando tu mensaje y nos pondremos en contacto contigo lo antes posible. Tu opinión es muy valiosa para nosotros, y estamos comprometidos a brindarte la mejor experiencia posible.</p>
            
                    <p>¡Gracias por elegirnos!</p>
            
                    <div class="firma">
                        <p>Saludos cordiales,</p>
                        <p style="text-align:center";>Gam.co</p>
                         <p style="text-align:center";>Presiona Start</p>
                    </div>
                </div>
            </body>
            </html>';

        

            try {
                $mail = new PHPMailer(true);
                //Server settings
                $mail->SMTPDebug = 0; 
                $mail->isSMTP(); 
                $mail->Host = 'smtp.office365.com'; 
                $mail->SMTPAuth = true; 
                $mail->Username = 'gamco_co@outlook.com'; 
                $mail->Password = 'Pa$$w0rd2023'; 
                $mail->SMTPSecure = 'STARTTLS'; 
                $mail->Port = 587;                                 
        
                //Recipients
                $mail->setFrom('gamco_co@outlook.com');
                $mail->addAddress($correo, $usuario);
        
                //Content
                $mail->isHTML(true); 
                $mail->Subject = "Mensaje";
                $mail->isHTML(true);
                $mail->Subject = $subject;

                $mail->Body = $msg;

                // Envía el correo
                $mail->send();
                echo '<h1>Correo Enviado</h1>';
            } catch (Exception $e) {
                echo "<h1>No se pudo enviar el correo. Error del Mailer: {$mail->ErrorInfo}</h1>";
            }       
        }       

    ?>