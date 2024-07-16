<?php 
session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:../pages/signin.php");

require_once "functions.php";

// Chama a função de upload de imagem se o formulário foi enviado
uploadProfileImage($connect);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Upload de Imagem de Perfil</title>
</head>
<body>
    <h2>Upload de Imagem de Perfil</h2>
    <div>
        <a href="<?php echo url('painel/index.php'); ?>">Painel</a>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" accept="image/*" required>
        <br><br>
        <input type="submit" name="uploadProfile" value="Enviar">
    </form>
</body>
</html>
