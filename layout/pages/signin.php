<?php require_once "C:/xampp/htdocs/projeto/painel/functions.php";
if (isset($_POST['acessar'])) {
        login($connect);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/projeto/css/global/style.css">
    <link rel="stylesheet" href="/projeto/css/pages/signin.css">
    <link rel="icon" href="imgs/fav.png">
    <title>NerdSales</title>
</head>
<body>
    <!--- <script type="text/javascript" src="js/script.js"></script>-->
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <?php require '..\nav-left2.php';?>
            </div>
            <div class="nav-center">
                <?php require '..\nav-center.php';?>
            </div>
            <div class="nav-right">
                <?php require '..\nav-right.php';?>
            </div>
        </nav>
    </header>
    <main>
        <h2>Login</h2>
        <div class="page">
            <form method="POST" class="formLogin">
                <h2>Olá, seja bem-vindo!</h2>
                <p>É muito bom ver você de novo por aqui.</p>
                
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Digite seu e-mail" />

                <label for="password">Senha</label>
                <input type="password" name="password" placeholder="Digite sua senha" />

                <a href="../pages/signup.php">Registrar-se</a>
                <input type="submit" value="Entrar" />
            </form>
        </div>
    </main>
    <div class="whatsapp-icon">
        <?php include '..\buttons.php';?>
    </div>
    <footer>
        <div class="footer-wrapper">
            <?php include '..\footer.php';?>
        </div>
    </footer>
</body>
</html>