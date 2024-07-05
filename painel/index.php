<?php session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:login.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"
	<title>Painel Admin</title>
</head>
<body>
	<?php if ($seguranca) { ?>
		

	<h1>Painel administrativo do site</h1>
	<h3>Bem Vindo, <?php echo $_SESSION['nome']; ?></h3>
	<nav>
		<div>
			<a href="index.php">Painel</a>
			<a href="users.php">Gerenciar Usuários</a>
			<a href="logout.php">Sair</a>
		</div>
	</nav>
<?php };
 ?>
</body>
</html>