<?php require_once __DIR__ . "/../painel/functions.php"; ?>
<link rel="stylesheet" href="<?php echo url('css/global/nav.css'); ?>">
<form id="search" onsubmit="return srch(this.id)" autocomplete="off">
    <input type="search" name="search" placeholder="Pesquisar..." required="">
    <button type="submit"><span class="material-symbols-outlined" style="color: #ffffff;">search</span></button>
</form>