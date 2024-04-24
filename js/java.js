const header = document.querySelector("header");

// Agrega o quita la clase "sticky" al encabezado cuando se desplaza
window.addEventListener("scroll", function () {
    header.classList.toggle("sticky", window.scrollY > 0);
});

let menu = document.querySelector("#menu-icon");
let navmenu = document.querySelector(".navmenu");

// Corrige el evento de clic del menú
menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navmenu.classList.toggle('open');
};
