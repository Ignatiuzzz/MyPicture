'use strict';

function aumentarContador(id) {
  var contadorElemento = document.getElementById(id);
  var contador = parseInt(contadorElemento.value);
  contadorElemento.value = contador + 1;
}

function disminuirContador(id) {
  var contadorElemento = document.getElementById(id);
  var contador = parseInt(contadorElemento.value);
  if (contador > 0) {
      contadorElemento.value = contador - 1;
  }
}
function scrollToDestination(enlaceId, puntoDestinoId) {
  document.getElementById(enlaceId).addEventListener('click', function (event) {
    event.preventDefault(); // Evita el comportamiento predeterminado del enlace

    // Obtén la posición del elemento al que deseas desplazarte
    var destino = document.getElementById(puntoDestinoId);

    // Desplaza la ventana hasta la posición del elemento de destino
    window.scrollTo({
      top: destino.offsetTop - 150,
      behavior: 'smooth'
    });
  });
}
// Selecciona el elemento del overlay, el botón de apertura del menú, el navbar y el botón de cierre del menú.
const overlay = document.querySelector("[data-overlay]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navbar = document.querySelector("[data-navbar]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");

// Crea un array con los elementos relevantes para el menú de navegación.
const navElems = [overlay, navOpenBtn, navCloseBtn];

// Agrega un evento de clic a cada elemento del menú de navegación.
for (let i = 0; i < navElems.length; i++) {
  navElems[i].addEventListener("click", function () {
    // Alterna la clase "active" en el navbar y el overlay al hacer clic en cualquier elemento del menú.
    navbar.classList.toggle("active");
    overlay.classList.toggle("active");
  });
}

