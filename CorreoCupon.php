<?php 

    session_start();

    $user=$_SESSION['usuario'];

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

    $query = "SELECT usr_name, email FROM users WHERE username = ?";

    // Preparar la sentencia
    $stmt = $conn->prepare($query);

    // Vincular el parámetro
    $stmt->bind_param("s", $user);

    // Ejecutar la consulta
    $stmt->execute();

    // Vincular las variables de resultado
    $stmt->bind_result($usr_name, $email);

    // Obtener los resultados
    $stmt->fetch();

    // Cerrar la sentencia
    $stmt->close();


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';

    $usuario=$_POST['user'];
    $correo=$_POST['email'];
    $subject='Suscripción Gam.co';
    $msg='
    <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bienvenido a Gam.co</title>
            <style>
                body {
                    font-family: "Arial", sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                    margin: 0;
                    padding: 20px;
                    text-align: center;
                }

                h1 {
                    color: #0066cc;
                }

                p {
                    font-size: 18px;
                    line-height: 1.6;
                    margin-bottom: 20px;
                }

                strong {
                    color: #009933;
                }

                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            </style>
        </head>
        <body>

        <div class="container">
            <h1>Bienvenido a Gam.co</h1>

            <p>¡Gracias por suscribirte a Gam.co! Como muestra de nuestro agradecimiento, te regalamos un cupón de descuento:</p>

            <p><strong>Cupón:</strong></p><br><img src="https://i.imgur.com/s0znkif.png" alt="">


            <p>Utiliza este cupón al realizar tu próxima compra para obtener un 15% de descuento en tus productos favoritos. ¡Esperamos que disfrutes de la experiencia de juego en Gam.co!</p>

            <p>¡Gracias de nuevo por unirte a nuestra comunidad!</p>
        </div>

        </body>
        </html>';


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
        $mail->addAddress($email, $usr_name);

        //Content
        $mail->isHTML(true); 
        $mail->Subject = "Mensaje";
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



