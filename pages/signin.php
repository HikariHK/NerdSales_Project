<?php require_once "../painel/functions.php";
if (isset($_POST['acessar'])) {
        login($connect);} 

$mensagemErro = login($connect);
?>
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
    <link rel="stylesheet" href="<?php echo url('css/pages/signin.css'); ?>">
    <link rel="icon" href="<?php echo url('assets/imgs/fav.png'); ?>">
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
        <h2>Login</h2>
        <div class="page">
            <form method="POST" class="formLogin">
                <h2>Olá, seja bem-vindo!</h2>
                <p>É muito bom ver você de novo por aqui.</p>
                
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Digite seu e-mail" class="<?php echo !empty($mensagemErro) ? 'error' : ''; ?>" />

                <label for="password">Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha" class="<?php echo !empty($mensagemErro) ? 'error' : ''; ?>" />

                <?php if (!empty($mensagemErro)): ?>
                    <div class="warning">
                        <span class="material-symbols-outlined">warning</span><p class="mensagem-erro"><?php echo $mensagemErro; ?></p>
                    </div>
                <?php endif; ?>

                <a href="../pages/signup.php">Registrar-se</a>
                <input type="submit" name="acessar" value="Entrar" />
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