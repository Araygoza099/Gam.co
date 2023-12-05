<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gam.co | Modificar</title>
    <link rel="stylesheet" href="./css/style_forms.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>

<div class="container" >  
            <form id="contactus"  method="post" >
              <h3>Modificar el envio</h3>
              
              <fieldset>
                <input placeholder="Calle" type="text" name="calle" required autofocus>
              </fieldset>
              <fieldset>
                <input placeholder="Fraccionamiento" type="text" name="frac" required>
              </fieldset>
              <fieldset>
                <input placeholder="Codigo Postal" type="number"   name="cp"  required>
             </fieldset>
             <fieldset>
                <input placeholder="Estado" type="text" tabindex="3" name="edo"required>
             </fieldset>
              <fieldset>
                <input placeholder="Ciudad" type="text" tabindex="3" name="cd"required>
              </fieldset>
              <fieldset>
                <input placeholder="Numero de telefono" type="number"   name="tel"  required>
             </fieldset>
             
              <fieldset>
                <button name="submit" type="submit" id="contactus-submit" data-submit="...Sending">Guardar cambios</button>
              </fieldset>
            
            </form>
          </div>
          <script>
            AOS.init();
          </script>
    
</body>
</html>