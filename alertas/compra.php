<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación de compra</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f3f3f3;
    }
    #flex {
      text-align: center;
    }
    .face {
      width: 100px;
      height: 100px;
      background-image: url('ruta_a_la_imagen_de_la_cara.png');
      background-size: cover;
      display: inline-block;
      animation: blink-animation 1s infinite;
    }
    @keyframes blink-animation {
      50% {
        opacity: 0;
      }
    }
    #message {
      margin: 20px 0;
      font-size: 18px;
      font-weight: bold;
    }
    #buttons {
      margin-top: 20px;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      margin: 0 10px;
      text-decoration: none;
      color: #fff;
      background-color: #3498db;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div id="flex">
    <div class="face"></div>
    <div id="message">¡Compra realizada correctamente!</div>
    <div id="buttons">
      <a href="#" class="button">Seguir comprando</a>
      <a href="#" class="button">Comprobante</a>
    </div>
  </div>
</body>
</html>
