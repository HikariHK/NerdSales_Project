<?php require_once __DIR__ . "/../painel/functions.php"; ?>
<link rel="stylesheet" href="<?php echo url('css/global/nav.css'); ?>">
<script>
function toggleSubMenu(event) {
    event.stopPropagation();
    var submenu = document.getElementById("submenu");
    if (submenu.style.display === "none" || submenu.style.display === "") {
        submenu.style.display = "flex";
    } else {
        submenu.style.display = "none";
    }
}

document.addEventListener("click", function(event) {
    var submenu = document.getElementById("submenu");
    var menuToggle = document.querySelector(".menu-toggle");
    if (!submenu.contains(event.target) && !menuToggle.contains(event.target)) {
        submenu.style.display = "none";
    }
});

document.getElementById("submenu").addEventListener("click", function(event) {
    event.stopPropagation();
});
</script>

<a href="<?php echo url('pages/sac.php'); ?>"><span class="material-symbols-outlined">contact_support</span></a>
<a href="<?php echo url('#'); ?>"><span class="material-symbols-outlined">shopping_cart</span></a>
<a href="<?php echo url('pages/signin.php'); ?>"><span class="material-symbols-outlined">account_circle</span></a>
<a href="#" onclick="toggleSubMenu(event)" class="menu-toggle"><span class="material-symbols-outlined">menu</span></a>
<div class="submenu" id="submenu">
    <a href="<?php echo url('pages/figures.php'); ?>">Livros</a>
    <a href="<?php echo url('pages/figures.php'); ?>">Roupas</a>
    <a href="<?php echo url('pages/figures.php'); ?>">Action Figures</a>
</div>
