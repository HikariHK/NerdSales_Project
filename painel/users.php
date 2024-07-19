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
            <?php if ($seguranca) { ?>
                <h1>Gerenciador de Usuários</h1>
                <nav>
                    <div>
                        <a href="logout.php">Sair</a>
                        <a href="editar_usuarios.php">Editar Usuarios</a>
                    </div>
                </nav>
                <?php
                $tabela = "users";
                $order = "nome";
                $users = buscar($connect, $tabela, 1, $order);
                inserirUsuarios($connect);
                if (isset($_GET['id']) && isset($_GET['nome'])) { ?>
                    <h2>Tem certeza de que deseja deletar o usuário <?php echo $_GET['nome']; ?>?</h2>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <input type="submit" name="deletar" value="Deletar">
                    </form>
                <?php } ?>

                <?php
                if (isset($_POST['deletar'])) {
                    if ($_SESSION['id'] != $_POST['id']) {
                        deletar($connect, "users", $_POST['id']);
                    } else {
                        echo "Você não pode alterar seu próprio usuário";
                    }
                }
                ?>
            <?php  ?> 
            <form action="" method="post">
                <fieldset>
                    <legend>Inserir Usuários</legend>
                    <input type="text" name="nome" placeholder="Nome">
                    <input type="email" name="email" placeholder="E-mail">
                    <input type=password name="senha" placeholder="Senha">
                    <input type=password name="repetesenha" placeholder="Confirme sua senha">
                    <input type="submit" name="cadastrar" value="Cadastrar">
                </fieldset>
            </form>
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Data Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php
                                    echo $user['id'];?>
                                        
                                    </td>
                                    <td><?php
                                    echo $user['nome'];?>
                                        
                                    </td>
                                    <td><?php
                                    echo $user['email'];?>
                                        
                                    </td>
                                    <td><?php
                                    echo $user['data_cadastro'];?>
                                        
                                    </td>
                                    <td>
                                        <a href="users.php?id=<?php
                                    echo $user['id'];?>&nome=<?php
                                    echo $user['nome'];?>">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        <?php };
        ?>
        </div>
    </div>
</body>
</html>
