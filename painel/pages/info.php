<?php
session_start();
define('ROOT_PATH', dirname(__DIR__) . '/');
require_once ROOT_PATH . 'functions.php';


if (!isset($_SESSION['ativa'])) {
    header("location: ../pages/signin.php");
    exit();
}

$mensagemErro = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizarContato'])) {
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagemErro = updateInfos($connect, $endereco, $email, $telefone);
}

$contatoData = getInfos($connect);
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
            overflow-y: auto;
            max-height: 100vh;
        }
        .content h2, .content h3 {
            color: #000;
            margin-bottom: 20px;
        }
        .main-content {
            margin: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="file"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-control-file:focus {
            border-color: #007bff;
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
        .mt-4 {
            background-color: #fff;
            border-radius: 4px;
            border: 1px solid black;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 600px;
        }
        .mt-3 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .img-banner {
            height: auto;
            max-width: 100%;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
                <h2>Atualizar Contato</h2>
                <section id="atualizar-contato" class="mt-4">
                    <?php if (!empty($mensagemErro)): ?>
                        <p class="mensagem-erro"><?php echo $mensagemErro; ?></p>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo url('painel/pages/info.php'); ?>">
                        <label for="endereco">Endereço:</label><br>
                        <textarea id="endereco" name="endereco" rows="4" cols="50"><?php echo htmlspecialchars($contatoData['endereco']); ?></textarea><br><br>

                        <label for="email">E-mail:</label><br>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contatoData['email']); ?>"><br><br>

                        <label for="telefone">Telefone:</label><br>
                        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($contatoData['telefone']); ?>"><br><br>

                        <input type="submit" name="atualizarContato" value="Atualizar Dados">
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
