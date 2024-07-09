<?php require_once "painel/functions.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo url('css/global/style.css'); ?>">
    <link rel="icon" href="<?php echo url('assets/imgs/fav.png'); ?>">
    <title>NerdSales</title>
</head>
<body>
    <!--- <script type="text/javascript" src="js/script.js"></script>-->
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <?php require 'layout/nav-left.php';?>
            </div>
            <div class="nav-center">
                <?php require 'layout/nav-center.php';?>
            </div>
            <div class="nav-right">
                <?php require 'layout/nav-right.php';?>
            </div>
        </nav>
    </header>
    <main id="main-content">
        <?php require 'pages/home.php';?>
    </main>
    <div class="whatsapp-icon">
        <?php include 'layout/buttons.php';?>
    </div>
    <footer>
        <div class="footer-wrapper">
            <?php include 'layout/footer.php';?>
        </div>
    </footer>
</body>
</html>