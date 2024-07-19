<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "nerdsales";
$port = "3308";
$connect = mysqli_connect($host, $db_user, $db_pass, $db_name, $port);

function login($connect) {
    if (isset($_POST['acessar']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $email = mysqli_real_escape_string($connect, $email);
        $senha = sha1($_POST['senha']);
        $senha = mysqli_real_escape_string($connect, $senha);

        $query = "SELECT * FROM users WHERE email = '$email'";
        $action = mysqli_query($connect, $query);
        $result = mysqli_fetch_array($action, MYSQLI_ASSOC);

        if ($result && $senha === $result['senha']) {
            session_start();
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['ativa'] = TRUE;
            header("location: ../painel/index2.php");
            exit();
        } else {
            return "E-mail ou senha incorretos";
        }
    }
    return null;
}

function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("location: ../pages/signin.php");
}

function buscaUnica($connect, $tabela, $id){
    $query = "SELECT * FROM $tabela WHERE id =".(int) $id;
    $execute = mysqli_query($connect, $query);
    $result = mysqli_fetch_assoc($execute);
    return $result;
}   

function buscar($connect, $tabela, $where = 1, $order = ""){
    if (!empty($order)){
        $order = "ORDER BY $order";
    };
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $execute = mysqli_query($connect, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    return $results;
}

function inserirUsuarios($connect) {
    if (isset($_POST['cadastrar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])) {
        $erros = array();
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $senha = sha1($_POST['senha']);

        if ($_POST['senha'] != $_POST['repetesenha']) {
            $erros[] = "Senhas não conferem!";
        }

        $queryEmail = "SELECT email FROM users WHERE email = '$email'";
        $buscaEmail = mysqli_query($connect, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);
        if (!empty($verifica)) {
            $erros[] = "E-mail já cadastrado!";
        }

        if (empty($erros)) {
            $query = "INSERT INTO users (nome, email, senha, data_cadastro) VALUES ('$nome', '$email', '$senha', NOW())";
            $executar = mysqli_query($connect, $query);
            if ($executar) {
                echo "Usuário inserido com sucesso!";
                header("location: ../painel/users.php");
            } else {
                echo "Erro ao inserir Usuário!";
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }
}

function atualizarUsuarios($connect) {
    if (isset($_POST['atualizarPerfil']) && !empty($_POST['id'])) {
        $erros = array();
        $id = mysqli_real_escape_string($connect, $_POST['id']);

        $email = !empty($_POST['email']) ? filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) : '';
        if ($email === false) {
            $erros[] = "Email inválido!";
        }

        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $senha = !empty($_POST['senha']) && $_POST['senha'] === $_POST['repetesenha'] ? sha1($_POST['senha']) : '';

        if ($email) {
            $queryEmail = "SELECT id FROM users WHERE email = '$email' AND id != '$id'";
            $buscaEmail = mysqli_query($connect, $queryEmail);
            if (mysqli_num_rows($buscaEmail) > 0) {
                $erros[] = "E-mail já cadastrado para outro usuário!";
            }
        }

        if (empty($erros)) {
            $query = "UPDATE users SET nome = '$nome'";
            if ($email) $query .= ", email = '$email'";
            if ($senha) $query .= ", senha = '$senha'";
            $query .= " WHERE id = '$id'";

            if (mysqli_query($connect, $query)) {
                echo "Usuário atualizado com sucesso!";
                header("location: ../painel/users.php");
                exit();
            } else {
                echo "Erro ao atualizar Usuário!";
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }
}

function deletar($connect, $tabela, $id) {
    if (!empty($id)) {
        $query = "DELETE FROM $tabela WHERE id = " . (int)$id;
        $execute = mysqli_query($connect, $query);
        if ($execute) {
            echo "Dado deletado com sucesso!";
        } else {
            echo "Erro ao deletar!";
        }
    }
}

$base_path = "/NerdSales_Project/";

function url($path) {
    global $base_path;
    return $base_path . ltrim($path, '/');
}

function uploadProfileImage($connect) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uploadProfile"])) {
        if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/NerdSales_Project/painel/assets/imgs/';

            $fileName = uniqid() . '_' . basename($_FILES["avatar"]["name"]);
            $targetPath = $uploadDir . $fileName;

            $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
            $validExtensions = array("jpg", "jpeg", "png", "gif");

            if (!in_array($imageFileType, $validExtensions)) {
                echo "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
            } else {
                $userId = $_SESSION['id'];
                $userData = getProfileData($connect, $userId);
                if ($userData && !empty($userData['caminho_imagem'])) {
                    $oldImagePath = $uploadDir . $userData['caminho_imagem'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetPath)) {
                    $queryUpdate = "UPDATE users SET caminho_imagem = '$fileName' WHERE id = $userId";
                    $resultUpdate = mysqli_query($connect, $queryUpdate);

                    if ($resultUpdate) {
                        echo "Imagem de perfil atualizada com sucesso!";
                        header("Location: index2.php");
                        exit();
                    } else {
                        echo "Erro ao atualizar imagem de perfil no banco de dados.";
                    }
                } else {
                    echo "Erro ao fazer o upload do arquivo.";
                }
            }
        } else {
            echo "Por favor, selecione um arquivo para fazer o upload.";
        }
    }
}

function getProfileData($connect, $userId) {
    $query = "SELECT *, caminho_imagem FROM users WHERE id = $userId";
    $result = mysqli_query($connect, $query);
    return mysqli_fetch_assoc($result);
}

if (isset($_SESSION['ativa'])) {
    $userId = $_SESSION['id'];
    $userData = getProfileData($connect, $userId);

    if (!$userData) {
        header("location: ../pages/signin.php");
        exit();
    }
}
?>
