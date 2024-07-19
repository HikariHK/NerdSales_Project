document.getElementById("menu-toggle").addEventListener("click", function() {
    document.getElementById("wrapper").classList.toggle("toggled");
});

document.getElementById("dropdown-toggle").addEventListener("click", function() {
    document.querySelector(".dropdown").classList.toggle("active");
});