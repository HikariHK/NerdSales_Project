<?php 

require_once "functions.php";

// Lidar com o logout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    logout();
}
?>
<link rel="stylesheet" href="<?php echo url('painel/css/global/nav.css'); ?>">
<nav class="navbar">
    <div class="user-menu">
        <?php
        if (!empty($userData['caminho_imagem'])) {
            $imagePath = 'assets/imgs/' . $userData['caminho_imagem'];
            echo '<img src="' . $imagePath . '" class="user-avatar" alt="Imagem de Perfil">';
        }
        ?>
        <span class="user-name"><?php echo $_SESSION['nome']; ?></span>
        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdown-toggle">▼</button>
            <div class="dropdown-menu" id="dropdown-menu">
                <a href="profile.php">Editar perfil</a>
                <a href="logout.php">Sair</a>
            </div>
        </div>
    </div>
</nav>
<script type="text/javascript" src="<?php echo url('painel/assets/js/script.js'); ?>"></script>
