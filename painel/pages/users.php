<?php
session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: ../pages/signin.php");
require_once "../functions.php";
addUsers($connect); // Certifique-se de que esta linha está antes de qualquer saída HTML
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        
        .main-content {
            margin: 20px;
        }

        h1, h2 {
            color: #000;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            background-color: #fff;
            border: 1px solid black;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }

        form fieldset {
            border: none;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .container {
            background-color: #fff;
            border: 1px solid black;
            border-radius: 4px;
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            font-weight: bolder;
        }

        table th {
            background-color: #f4f4f4;
        }

        table td {
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            display: block;
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 4px;
            width: 100%;
            text-align: center;
        }

        .action-buttons a.edit {
            background-color: #28a745;
        }

        .action-buttons a.edit:hover {
            background-color: #218838;
        }

        .action-buttons a.delete {
            background-color: #dc3545;
        }

        .action-buttons a.delete:hover {
            background-color: #c82333;
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
            <?php if ($seguranca) { ?>
                <h1>Gerenciador de Usuários</h1>
                <?php
                $tabela = "users";
                $order = "nome";
                $users = search($connect, $tabela, 1, $order);
                addUsers($connect);
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
                        dataDelete($connect, "users", $_POST['id']);
                    } else {
                        echo "Você não pode alterar seu próprio usuário";
                    }
                }
                ?>
            <?php  ?> 
            <form action="" method="post">
                <fieldset>
                    <legend>Inserir Usuários</legend>
                    <input type="text" name="nome" placeholder="Nome" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="password" name="repetesenha" placeholder="Confirme sua senha" required>
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
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['nome']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['data_cadastro']; ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="editar_usuario.php?id=<?php echo $user['id']; ?>" class="edit">Editar</a>
                                            <a href="users.php?id=<?php echo $user['id']; ?>&nome=<?php echo $user['nome']; ?>" class="delete">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php }; ?>
            </div>
        </div>
    </div>
</body>
</html>
