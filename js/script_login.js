// Suponiendo que tienes una variable `productCount` que contiene la cantidad de productos
const productCount = 10; // Puedes cambiar esto dinámicamente

// Seleccionar el elemento de conteo de productos
const productCountElement = document.querySelector('.product-count');

// Actualizar el contenido del conteo de productos
productCountElement.textContent = productCount.toString();
