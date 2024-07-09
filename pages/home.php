<?php require_once __DIR__ . "/../painel/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo url('css/global/styles.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('css/pages/home.css'); ?>">
    <link rel="icon" href="<?php echo url('assets/imgs/fav.png'); ?>">
    <title>NerdSales</title>
</head>
<body>
    <main id="main-content">
        <section id="banner" class="banner">
            <img src="assets/imgs/banner.jpg" alt="">
        </section>
        <section id="highlight" class="highlight">
            <h2>Destaques</h2>
            <div class="highlight-product">
                <img src="/imgs/destaque1.jpg" alt="">
            </div>
            <div class="highlight-product">
                <img src="/imgs/destaque2.jpg" alt="">
            </div>
            <div class="highlight-product">
                <img src="/imgs/destaque3.jpg" alt="">
            </div>
        </section>
        <section id="about" class="about">
            <h2>Sobre nós</h2>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore 
                magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea 
                commodo consequat. Duis aute irure dolor in reprehenderit
                in voluptate velit esse cillum dolore eu fugiat nulla 
                pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est
                laborum."</p>
        </section>
        <section id="gallery" class="gallery">
            <h2>Galeria</h2>
            <div class="product-img">
                <img src="/imgs/galeria1.jpg" alt="">
            </div>
            <div class="product-img">
                <img src="/imgs/galeria2.jpg" alt="">
            </div>
            <div class="product-img">
                <img src="/imgs/galeria3.jpg" alt="">
            </div>
        </section>
    </main>
</body>
</html>
