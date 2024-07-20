<?php
session_start();
require_once('functions.php');

if (!isset($_SESSION['ativa'])) {
    header("location: ../pages/signin.php");
    exit();
}

$userId = $_SESSION['id'];
$userData = getProfileData($connect, $userId);

if (!$userData) {
    header("location: ../pages/signin.php");
    exit();
}

$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uploadBanner"])) {
    $errorMessage = atualizarBanner($connect);
}

// Obter o caminho atual do banner
$queryBanner = "SELECT caminho_imagem FROM banners LIMIT 1";
$resultBanner = mysqli_query($connect, $queryBanner);
$banner = mysqli_fetch_assoc($resultBanner);
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
        <?php include 'layout/sidebar.php'; ?>

        <div class="content" id="content">
            <div class="nav">
                <?php include 'layout/nav.php'; ?>
            </div>
            <div class="main-content">
                <h2>Atualizar Banner</h2>
                <section id="atualizar-banner" class="mt-4">
                    <h3>Imagem Atual do Banner</h3>
                    <?php if (!empty($banner)): ?>
                        <div class="mt-3">
                            <img src="<?php echo url('assets/imgs/' . $banner['caminho_imagem']); ?>" class="img-banner" alt="Banner">
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group <?php echo !empty($errorMessage) ? 'error' : ''; ?>">
                            <label for="banner">Selecione a nova imagem para o banner:</label>
                            <input type="file" id="banner" name="banner" accept="image/jpeg, image/png, image/gif" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="uploadBanner" value="Atualizar Banner">
                        </div>
                    </form>
                    <?php
                    if (!empty($errorMessage)) {
                        echo '<div class="warning"><span class="material-symbols-outlined">warning</span><p class="mensagem-erro">' . $errorMessage . '</p></div>';
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
