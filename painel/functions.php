<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "nerdsales";
$connect = mysqli_connect($host, $db_user, $db_pass, $db_name);

function login($connect) {
    if (isset($_POST['acessar']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $email = mysqli_real_escape_string($connect, $email);
        $senha = sha1($_POST['senha']);
        $senha = mysqli_real_escape_string($connect, $senha);  //serve para limpar a string que, no caso, será enviada ao banco de dados.

        // Busca o usuário pelo email
        $query = "SELECT * FROM users WHERE email = '$email'";
        $action = mysqli_query($connect, $query);
        $result = mysqli_fetch_array($action, MYSQLI_ASSOC);

        // Verifica se encontrou algum resultado e se a senha está correta
        if ($result && $senha === $result['senha']) {
            // Iniciar sessão
            session_start();
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['ativa'] = TRUE;
            header("location: ../painel/index.php");
            exit();
        } else {
            // E-mail ou senha incorretos
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
        $senha = sha1($_POST['senha']);  // Criptografa a senha

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

// Função para construir URLs
function url($path) {
    global $base_path;
    return $base_path . ltrim($path, '/');
}

