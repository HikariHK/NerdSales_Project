<?php require_once "../painel/functions.php";
if (isset($_POST['cadastrar'])) {
        inserirUsuarios($connect);} ?>
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
    <link rel="stylesheet" href="/projeto/css/pages/signup.css">
    <link rel="icon" href="imgs/fav.png">
    <title>NerdSales</title>
</head>
<body>
    <!--- <script type="text/javascript" src="js/script.js"></script>-->
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <?php require '..\layout\nav-left2.php';?>
            </div>
            <div class="nav-center">
                <?php require '..\layout\nav-center.php';?>
            </div>
            <div class="nav-right">
                <?php require '..\layout\nav-right.php';?>
            </div>
        </nav>
    </header>
    <main>
        <h2>Registro</h2>
        <div class="page">
            <form action="" method="post" class="formLogin">
                <h2>Crie uma conta nova</h2>
                <p>Complete seus dados para cadastro.</p>
                
                <label for="name">Nome</label>
                <input type="text" name="nome" placeholder="Nome">
                
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="E-mail">

                <label for="password">Senha</label>
                <input type="password" name="senha" placeholder="Senha">
                <label for="password">Repita a senha</label>
                <input type="password" name="repetesenha" placeholder="Confirme sua senha">
                <a href="../pages/signin.php">Já possuo uma conta</a>
                <input type="submit" name="cadastrar" value="Cadastrar">
 
            </form>
        </div>
    </main>
    <div class="whatsapp-icon">
        <?php include '..\layout\buttons.php';?>
    </div>
    <footer>
        <div class="footer-wrapper">
            <?php include '..\layout\footer.php';?>
        </div>
    </footer>
</body>
</html>