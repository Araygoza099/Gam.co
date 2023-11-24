// Función para cambiar automáticamente la posición del carrusel
function cambiarAutomatico() {
    let posicionActual = 1; // Empezar desde la posición 1
    const intervalo = setInterval(() => {
      posicionActual = (posicionActual % 5) + 1; // Cambia entre las 5 posiciones
      document.querySelector(`input:nth-of-type(${posicionActual})`).checked = true;
    }, 3000); // Cambia automáticamente cada 3 segundos, puedes ajustar el intervalo
  }
  
  // Llamar a la función para el cambio automático
  cambiarAutomatico();
  