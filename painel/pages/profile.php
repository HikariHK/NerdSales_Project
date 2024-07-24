<?php
session_start();
define('ROOT_PATH', dirname(__DIR__) . '/');
require_once ROOT_PATH . 'functions.php';

if (!isset($_SESSION['ativa'])) {
    header("location: ../pages/signin.php");
    exit();
}

// Lidar com o logout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    logout();
}

$userId = $_SESSION['id'];
$userData = getProfileData($connect, $userId); // Obter dados do perfil do usuário

if (!$userData) {
    header("location: ../pages/signin.php");
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

$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uploadProfile"])) {
    $errorMessage = uploadProfileImage($connect);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo url('painel/css/global/style.css'); ?>">
    <style>
        .content {
            flex-grow: 1;
            background-color: #cdcdcd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Adiciona barra de rolagem */
            max-height: 100vh; /* Garante que a altura máxima seja 100% da viewport */
        }

        .content h2, .content h3 {
            color: #000;
            margin-bottom: 20px;
        }

        .main-content{
            margin: 20px;
        }

        .profile-wrapper{
            gap: 50px;
            display: flex;
            flex-direction: row;

        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control, .form-control-file {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-control:focus, .form-control-file:focus {
            border-color: #007bff;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            width: 100%; /* Ajusta a largura para preencher o formulário */
            text-align: center; /* Centraliza o texto */
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control, .form-control-file {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-control:focus, .form-control-file:focus {
            border-color: #007bff;
        }

        .img-thumbnail {
            max-width: 150px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .mt-4 {
            background-color: #fff;
            border-radius: 1%;
            border: 1px solid black;
            padding: 10px;
            display: flex;
            flex-direction: column;
            flex: 1;
            
        }


        .mt-3 {
            margin-top: 1rem;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            flex: 1;
        }

        .warning {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 5px;
        }

        .mensagem-erro, .warning span {
            color: red;
            text-align: left;
            margin: 0;
        }

        .form-group.error {
            border-color: red;
        }

    </style>
</head>
<body>
    <div class="wrapper" id="wrapper">
        <?php include '../layout/sidebar.php'; ?>

        <div class="content" id="content">
            <div class="nav">
                <?php include '../layout/nav.php'; ?>
            </div>
            <div class="main-content">
                <h2>Meu Perfil</h2>
                <div class="profile-wrapper">
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
                    <?php if (!empty($userData['caminho_imagem'])): ?>
                        <div class="mt-3">
                            <img src="/NerdSales_Project/painel/assets/imgs/<?php echo htmlspecialchars($userData['caminho_imagem']); ?>" class="img-thumbnail" alt="Imagem de Perfil">
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="form-group <?php echo !empty($errorMessage) ? 'error' : ''; ?>">
                            <label for="avatar">Selecione uma imagem:</label>
                            <input type="file" class="form-control-file" id="avatar" name="avatar">
                        </div>
                        <?php if (!empty($errorMessage)): ?>
                            <div class="warning">
                                <span class="material-symbols-outlined">warning</span><p class="mensagem-erro"><?php echo $errorMessage; ?></p>
                            </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary" name="uploadProfile">Atualizar Imagem</button>
                    </form>
                </section>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
