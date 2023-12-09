
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
            <form id="contactus" action="dirCambio.php" method="post" >
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
              <select name="pais">
                  <option value="" disabled selected>País</option>
                  <option value="America">Argentina</option>
                  <option value="America">Brasil</option>
                  <option value="America">Canadá</option>
                  <option value="Europa">España</option>
                  <option value="America">Estados Unidos</option>
                  <option value="Mexico">México</option>
                  <option value="Europa">Francia</option>
                  <option value="Europa">Italia</option>
                  <option value="Asia">Japón</option>
                  <option value="Oceanía">Australia</option>
                  <option value="Asia">China</option>
                  <option value="Asia">India</option>
                  <option value="África">Sudáfrica</option>
                  <option value="Europa">Rusia</option>
                  <option value="Asia">Corea del Sur</option>
                  <option value="Europa">Reino Unido</option>
                  <option value="Europa">Alemania</option>
                  <option value="America">Canadá</option>
                  <option value="America">Brasil</option>
                  <option value="America">Argentina</option>
              </select>
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