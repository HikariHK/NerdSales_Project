<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "nerdsales";
$port = "3308";
$connect = mysqli_connect($host, $db_user, $db_pass, $db_name, $port);

function login($connect)
{
    if (isset($_POST['acessar']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $email = mysqli_real_escape_string($connect, $email);
        $password = sha1($_POST['senha']);
        $password = mysqli_real_escape_string($connect, $password);

        $query = "SELECT * FROM users WHERE email = '$email'";
        $action = mysqli_query($connect, $query);
        $result = mysqli_fetch_array($action, MYSQLI_ASSOC);

        if ($result && $password === $result['senha']) {
            session_start();
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['ativa'] = TRUE;
            header("location: ../painel/index.php");
            exit();
        } else {
            return "E-mail ou senha incorretos";
        }
    }
    return null;
}

function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("location: ../pages/signin.php");
}

function uniqueSearch($connect, $tabela, $id)
{
    $query = "SELECT * FROM $tabela WHERE id =" . (int) $id;
    $execute = mysqli_query($connect, $query);
    $result = mysqli_fetch_assoc($execute);
    return $result;
}

function search($connect, $tabela, $where = 1, $order = "")
{
    if (!empty($order)) {
        $order = "ORDER BY $order";
    }
    ;
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $execute = mysqli_query($connect, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    return $results;
}

function addUsers($connect)
{
    if (isset($_POST['cadastrar']) and !empty($_POST['email']) and !empty($_POST['senha'])) {
        $errors = array();
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $name = mysqli_real_escape_string($connect, $_POST['nome']);
        $password = sha1($_POST['senha']);

        if ($_POST['senha'] != $_POST['repetesenha']) {
            $errors[] = "Senhas não conferem!";
        }

        $queryEmail = "SELECT email FROM users WHERE email = '$email'";
        $searchEmail = mysqli_query($connect, $queryEmail);
        $verify = mysqli_num_rows($searchEmail);
        if (!empty($verify)) {
            $errors[] = "E-mail já cadastrado!";
        }

        if (empty($errors)) {
            $query = "INSERT INTO users (nome, email, senha, data_cadastro) VALUES ('$name', '$email', '$password', NOW())";
            $execute = mysqli_query($connect, $query);
            if ($execute) {
                header("location: users.php"); // Redireciona para a página users.php
                exit(); // Garante que o script pare de executar após o redirecionamento
            } else {
                echo "Erro ao inserir Usuário!";
            }
        } else {
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }
}

function signupUser($connect)
{
    if (isset($_POST['cadastrar']) and !empty($_POST['email']) and !empty($_POST['senha'])) {
        $erros = array();
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $name = mysqli_real_escape_string($connect, $_POST['nome']);
        $password = sha1($_POST['senha']);

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
            $query = "INSERT INTO users (nome, email, senha, data_cadastro) VALUES ('$name', '$email', '$password', NOW())";
            $executar = mysqli_query($connect, $query);
            if ($executar) {
                header("location: ../pages/signin.php"); // Redireciona para a página de login após o registro
                exit(); // Garante que o script pare de executar após o redirecionamento
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


function updateUsers($connect)
{
    if (isset($_POST['atualizarPerfil']) && !empty($_POST['id'])) {
        $errors = array();
        $id = mysqli_real_escape_string($connect, $_POST['id']);

        $email = !empty($_POST['email']) ? filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) : '';
        if ($email === false) {
            $errors[] = "Email inválido!";
        }

        $name = mysqli_real_escape_string($connect, $_POST['nome']);
        $password = !empty($_POST['senha']) && $_POST['senha'] === $_POST['repetesenha'] ? sha1($_POST['senha']) : '';

        if ($email) {
            $queryEmail = "SELECT id FROM users WHERE email = '$email' AND id != '$id'";
            $searchEmail = mysqli_query($connect, $queryEmail);
            if (mysqli_num_rows($searchEmail) > 0) {
                $errors[] = "E-mail já cadastrado para outro usuário!";
            }
        }

        if (empty($errors)) {
            $query = "UPDATE users SET nome = '$name'";
            if ($email)
                $query .= ", email = '$email'";
            if ($password)
                $query .= ", senha = '$password'";
            $query .= " WHERE id = '$id'";

            if (mysqli_query($connect, $query)) {
                echo "Usuário atualizado com sucesso!";
                header("location: ../painel/users.php");
                exit();
            } else {
                echo "Erro ao atualizar Usuário!";
            }
        } else {
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }
}

function dataDelete($connect, $table, $id)
{
    if (!empty($id)) {
        $query = "DELETE FROM $table WHERE id = " . (int) $id;
        $execute = mysqli_query($connect, $query);
        if ($execute) {
            echo "Dado deletado com sucesso!";
        } else {
            echo "Erro ao deletar!";
        }
    }
}

$base_path = "/NerdSales_Project/";

function url($path)
{
    global $base_path;
    return $base_path . ltrim($path, '/');
}

function uploadProfileImage($connect)
{
    $errorMessage = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uploadProfile"])) {
        if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/NerdSales_Project/painel/assets/imgs/';

            $fileName = uniqid() . '_' . basename($_FILES["avatar"]["name"]);
            $targetPath = $uploadDir . $fileName;

            $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
            $validExtensions = array("jpg", "jpeg", "png", "gif");

            if (!in_array($imageFileType, $validExtensions)) {
                $errorMessage = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
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
                        header("Location: profile.php");
                        exit();
                    } else {
                        $errorMessage = "Erro ao atualizar imagem de perfil no banco de dados.";
                    }
                } else {
                    $errorMessage = "Erro ao fazer o upload do arquivo.";
                }
            }
        } else {
            $errorMessage = "Por favor, selecione um arquivo para fazer o upload.";
        }
    }
    return $errorMessage;
}

function getProfileData($connect, $userId)
{
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

function updateSlideshow($connect)
{
    $errorMessage = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uploadBanner"])) {
        if (isset($_FILES["banner"]) && $_FILES["banner"]["error"] == 0) {
            // Define o diretório de upload
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/NerdSales_Project/assets/imgs/';

            // Obtém a extensão do arquivo original
            $imageFileType = strtolower(pathinfo($_FILES["banner"]["name"], PATHINFO_EXTENSION));
            $validExtensions = array("jpg", "jpeg", "png", "gif");

            if (!in_array($imageFileType, $validExtensions)) {
                $errorMessage = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
            } else {
                // Gera um código único para o arquivo
                $uniqueCode = uniqid('banner_', true);
                $fileName = $uniqueCode . '.' . $imageFileType;
                $targetPath = $uploadDir . $fileName;

                // Move o arquivo para o diretório de upload
                if (move_uploaded_file($_FILES["banner"]["tmp_name"], $targetPath)) {
                    // Verifica se já existe um registro na tabela banners
                    $queryCheck = "SELECT caminho_imagem FROM banners LIMIT 1";
                    $resultCheck = mysqli_query($connect, $queryCheck);

                    if (mysqli_num_rows($resultCheck) > 0) {
                        // Se existir, pega o caminho da imagem atual
                        $row = mysqli_fetch_assoc($resultCheck);
                        $oldImagePath = $uploadDir . $row['caminho_imagem'];

                        // Remove a imagem antiga
                        if (file_exists($oldImagePath) && $oldImagePath !== $targetPath) {
                            unlink($oldImagePath);
                        }

                        // Atualiza o caminho da imagem no banco de dados
                        $query = "UPDATE banners SET caminho_imagem = '$fileName' WHERE id = 1"; // Supondo que o id do banner seja 1
                    } else {
                        // Se não existir, insere um novo registro
                        $query = "INSERT INTO banners (caminho_imagem) VALUES ('$fileName')";
                    }

                    if (!mysqli_query($connect, $query)) {
                        $errorMessage = "Erro ao atualizar imagem do banner no banco de dados.";
                    }
                } else {
                    $errorMessage = "Erro ao fazer o upload do arquivo. Verifique as permissões do diretório.";
                }
            }
        } else {
            $errorMessage = "Por favor, selecione um arquivo para fazer o upload.";
        }
    }
    return $errorMessage;
}

function updateInfos($connect, $address, $email, $phone) {
    // Limpa e valida os dados de entrada
    $address = mysqli_real_escape_string($connect, $address);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $phone = mysqli_real_escape_string($connect, $phone);

    if ($email === false) {
        return "E-mail inválido!";
    }

    // Atualiza os dados na tabela contato_sac
    $query = "UPDATE contato SET endereco = '$address', email = '$email', telefone = '$phone' WHERE id = 1";
    $result = mysqli_query($connect, $query);

    if ($result) {
        return "Informações de contato atualizadas com sucesso!";
    } else {
        return "Erro ao atualizar informações de contato: " . mysqli_error($connect);
    }
}


function getInfos($connect) {
    $query = "SELECT endereco, email, telefone FROM contato WHERE id = 1";
    $result = mysqli_query($connect, $query);
    
    if (!$result) {
        // Retorna um erro se a consulta falhar
        die('Erro na consulta: ' . mysqli_error($connect));
    }
    
    $data = mysqli_fetch_assoc($result);
    
    if (!$data) {
        // Verifica se não há dados retornados
        die('Nenhum dado encontrado para o contato SAC.');
    }
    
    return $data;
}