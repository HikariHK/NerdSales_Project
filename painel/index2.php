<?php
session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: ../pages/signin.php");
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo url('painel/css/global/style.css'); ?>">
</head>
<body>
    <div class="wrapper" id="wrapper">
        <?php include 'layout/sidebar.php'; ?>

        <div class="content" id="content">
            <?php include 'layout/nav.php'; ?>
            <?php include 'pages/main.php'; ?>
        </div>
    </div>
</body>
</html>
