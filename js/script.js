// Obtenemos el botón y la lista desplegable por su id
const dropdownBtn = document.getElementById("dropdown-btn");
const dropdownContent = document.getElementById("dropdown-content");

// Agregamos un manejador de eventos al botón para mostrar/ocultar la lista
dropdownBtn.addEventListener("click", function(event) {
    event.preventDefault(); // Previene la navegación al hacer clic en el enlace
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
});