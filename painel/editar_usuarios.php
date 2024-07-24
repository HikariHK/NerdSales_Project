<?php
session_start();
require_once('functions.php'); 

if (!isset($_SESSION['ativa'])) {
    header("location: login.php");
    exit();
}

$userId = $_SESSION['id'];
$userData = getProfileData($connect, $userId); // Obter dados do perfil do usuário

if (!$userData) {
    header("location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['atualizarPerfil'])) {
        updateUsers($connect);
    }

    if (isset($_POST['uploadProfile'])) {
        uploadProfileImage($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="caminho/para/seu/arquivo/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Meu Perfil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Painel</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Imagem de Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h2>Meu Perfil</h2>
    <section id="dados" class="mt-4">
        <h3>Dados Pessoais</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($userData['nome']); ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>">
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Nova senha">
            </div>
            <div class="form-group">
                <label for="repetesenha">Repita a Senha:</label>
                <input type="password" class="form-control" id="repetesenha" name="repetesenha" placeholder="Repita a nova senha">
            </div>
            <button type="submit" class="btn btn-primary" name="atualizarPerfil">Atualizar</button>
        </form>
    </section>
    <section id="imagem" class="mt-4">
        <h3>Imagem de Perfil</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="avatar">Selecione uma imagem:</label>
                <input type="file" class="form-control-file" id="avatar" name="avatar">
            </div>
            <button type="submit" class="btn btn-primary" name="uploadProfile">Atualizar Imagem</button>
        </form>
        <?php if (!empty($userData['caminho_imagem'])): ?>
            <div class="mt-3">
                <img src="/NerdSales_Project/painel/assets/imgs/<?php echo htmlspecialchars($userData['caminho_imagem']); ?>" class="img-thumbnail" alt="Imagem de Perfil">
            </div>
        <?php endif; ?>
    </section>
</div>
</body>
</html>
