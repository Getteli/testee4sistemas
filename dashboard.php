<?php
    include('app/db/keep_login.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<title>Dashboard</title>
</head>
<body>
	<div class="d-block w-100 text-end pe-3 mt-3">
		<a href="app/db/logout.php" class="text-decoration-none text-danger">deslogar</a>
	</div>
	<main class="container">
		<div class="d-grid w-100 text-start ps-3 mt-3">
			<a href="criar-pessoa.php" class="text-decoration-none text-danger">Criar Pessoa</a>
			<a href="listar-pessoa.php" class="text-decoration-none text-danger">Listar Pessoas</a>
			<a href="editar.php" class="text-decoration-none text-danger">Editar</a>
			<a href="perfil.php" class="text-decoration-none text-danger">Ver</a>
		</div>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>