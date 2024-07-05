<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "projeto_adm";
$connect = mysqli_connect($host, $db_user, $db_pass, $db_name);
function login($connect){
	if (isset($_POST['acessar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])) {
		$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
		$senha = sha1($_POST['senha']);
		$query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
		$executar = mysqli_query($connect, $query);
		$return = mysqli_fetch_assoc($executar);
		if (!empty($return['email'])) {
			// echo "Bem vindo " . $return['nome'];
			session_start();
			$_SESSION['nome']= $return['nome'];
			$_SESSION['id']= $return['id'];
			$_SESSION['ativa']= TRUE;
			header("location: index.php");
		}else{
			echo "Usuário ou senha não encontrado!";
	}
		}
	}
function logout(){
	session_start();
	session_unset();
	session_destroy();
	header("location: login.php");
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
function inserirUsuarios($connect){
	if (isset($_POST['cadastrar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){
		$erros = array();
		$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
		$nome = mysqli_real_escape_string($connect, $_POST['nome']);
		$senha = sha1($_POST['senha']);
		if ($_POST['senha'] != $_POST['repetesenha']) {
			$erro[] = "Senhas não conferem!";
		}
		$queryEmail = "SELECT email  FROM usuarios WHERE email = '$email'";
		$buscaEmail = mysqli_query($connect, $queryEmail);
		$verifica = mysqli_num_rows($buscaEmail);
		if (!empty($verifica)) {
			$erros[] = "E-mail já cadastrado!";
		}
		if (empty($erros)) {
			$query = "INSERT INTO usuarios (nome, email, senha, data_cadastro) VALUES ('$nome', '$email', '$senha', NOW())";
			$executar = mysqli_query($connect, $query);
			if ($executar) {
				echo "Usuário inserido com sucesso!";
			}else{
				echo "Erro ao inserir Usuário!";
			}
		}else{
			foreach ($erros as $erro){
				echo "<p>$erro</p>";
			}
		}
	}
	}
function deletar($connect, $tabela, $id){
	if (!empty($id)) {
		$query = "DELETE FROM $tabela WHERE id =". (int) $id;
		$execute = mysqli_query($connect, $query);
		if ($execute) {
				echo "Dado deletado com sucesso!";
			}else{
				echo "Erro ao deletar!";
			}
	}
	
}