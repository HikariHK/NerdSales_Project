<?php
session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:../pages/signin.php");
require_once "functions.php";

// Verificar se o usuário está logado
if ($seguranca) {
    $userId = $_SESSION['id'];
    $userData = getProfileData($connect, $userId); // Obter dados do perfil do usuário

    // Verificar se foi encontrado algum dado do usuário
    if ($userData) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Painel Administrativo</title>
        </head>
        <body>
            <h1>Painel administrativo do site</h1>
            <h3>Bem-vindo, <?php echo $_SESSION['nome']; ?></h3>
            <nav>
                <div>
                    <a href="index.php">Painel</a>
                    <a href="profile.php">Editar perfil</a>
                    <a href="users.php">Gerenciar Usuários</a>
                    <a href="../pages/signin.php">Sair</a>
                </div>
            </nav>

            <!-- Exibir imagem de perfil -->
            <div>
                <h2>Imagem de Perfil</h2>
                <?php
                if (!empty($userData['caminho_imagem'])) {
                    $imagePath = 'assets/imgs/' . $userData['caminho_imagem'];
                    echo '<img src="' . $imagePath . '" alt="Imagem de Perfil">';
                } else {
                    echo '<p>Usuário ainda não possui uma imagem de perfil.</p>';
                }
                ?>
            </div>

        </body>
        </html>
        <?php
    } else {
        // Se não encontrar dados do usuário, redirecionar para página de login
        header("location: ../pages/signin.php");
        exit();
    }
}
?>
