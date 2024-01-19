// Obtener elementos del DOM
var modal = document.getElementById("desarrolladoModal");
var btn = document.getElementById("desarrolladoBtn");
var closeBtn = document.getElementsByClassName("close")[0];

// Abrir el modal al hacer clic en el enlace
btn.onclick = function() {
  modal.style.display = "block";
}

// Cerrar el modal al hacer clic en la 'x'
closeBtn.onclick = function() {
  modal.style.display = "none";
}

// Cerrar el modal al hacer clic fuera del contenido del modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}