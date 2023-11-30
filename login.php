<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Gam.co</title>
    <link rel="stylesheet" href="css/style_Login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
          background-color: #00011e;
        }
        #cl{
        color:red;

        }
        #cl , a{
            text-decoration:none;
            margin:0 auto;
        }
        #show{
            margin:0 auto;
            font-weight:bold;
            text-align:center;
        }
        .text-success{
            margin:0 auto;
            text-align:center;
            margin:0.4rem 0;
            padding:0.3rem 0.2rem;
            font-size:1.9rem;
        }
        .text-danger{
            margin:0 auto;
            text-align:center;
            margin:0.4rem 0;
            padding:0.3rem 0.2rem;
            font-size:1.9rem;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
         <div class="corner-image">
            <img src="img\login_esquina.png" alt="Esquina">
        </div>
        <div class="logo">
            <img src="img\gamco_logo.jpg" alt="Logo">
        </div>
        <form class="login-form" action="verify-login.php" method="post">
            <h2>Iniciar sesión</h2>
            <div class="input-group">
                <input type="text" placeholder="Usuario" name="usuario" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Contraseña" name="contraseña" required>
            </div>
            <div class="input-group">
                <td style="width:10%;">
                    <img src="captcha_gen.php" />
                </td>
                <tr>
                    <br>
                    <td colspan="11" style="text-align:center;"><a href="" id="cl">Click to refresh</a></td>
                </tr>
                <td colspan="3" style="width:10%;">
                    <input type="text" name="captcha_code" style="text-transform:uppercase;" class="form-control" autocomplete="off"/>
                </td>  
            </div>
            <div class="options">
                <a href="register.php" class="small-text">Registrarse</a>
                <a href="recovery.php" class="small-text">¿Olvidaste la contraseña?</a>
            </div>
            <button type="submit" class="login-btn" name='submit' value="submit" id="st">Ingresar</button>
            <div class="remember-me" >
                <label for="remember-me">Recuérdame</label>
                <input type="checkbox" id="remember-me">
            </div>
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
