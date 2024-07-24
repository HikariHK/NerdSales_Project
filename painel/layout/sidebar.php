<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__) . '/');
}
require_once ROOT_PATH . 'functions.php';
?>
<link rel="stylesheet" href="<?php echo url('painel/css/global/sidebar.css'); ?>">
<div class="sidebar" id="sidebar">
    <div class="sidebar-heading">
        Menu
        <button class="menu-toggle" id="menu-toggle">☰</button>
    </div>
    <div class="sidebar-menu-container">
        <ul class="sidebar-menu">
            <li><a href="<?php echo url('painel/index.php'); ?>">Dashboard</a></li>
            <li><a href="<?php echo url('painel/pages/users.php'); ?>">Gerenciar usuários</a></li>
            <li><a href="<?php echo url('painel/pages/slideshow.php'); ?>">Alterar banner principal</a></li>
            <li><a href="<?php echo url('painel/pages/info.php'); ?>">Alterar informações</a></li>
        </ul>
    </div>
</div>