<?php require_once "functions.php";
?>
<link rel="stylesheet" href="<?php echo url('painel/css/global/sidebar.css'); ?>">
<div class="sidebar" id="sidebar">
    <div class="sidebar-heading">
        Menu
        <button class="menu-toggle" id="menu-toggle">☰</button>
    </div>
    <div class="sidebar-menu-container">
        <ul class="sidebar-menu">
            <li><a href="../painel/index.php">Dashboard</a></li>
            <li><a href="../painel/users.php">Gerenciar usuários</a></li>
            <li><a href="../painel/atualizar_banner.php">Alterar Banner principal</a></li>
            <li><a href="../painel/atualizar_contato.php">Alterar Dados do sac</a></li>
        </ul>
    </div>
</div>