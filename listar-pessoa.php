<?php
	include_once('app/model/Pessoa.php');

	include('app/db/keep_login.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<title>Dashboard - Listar</title>
</head>
<body>
	<div class="d-block w-100 text-end pe-3 mt-3">
		<a href="dashboard.php" class="text-decoration-none text-success">Voltar</a>
	</div>

	<main class="container">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nome</th>
				<th scope="col">Email</th>
				<th scope="col">1° telefone</th>
				<th scope="col">ações</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($allPessoa as $key => $pessoa) {
			?>
			<tr>
				<th scope="row"><?php echo $pessoa["id"] ?></th>
				<td><?php echo $pessoa["nome"] ?></td>
				<td><?php echo $pessoa["email"] ?></td>
				<td><?php echo "(".$pessoa["ddd_telefone"].") " . $pessoa["numero_telefone"] ?></td>
				<td><a href="#" class="deletePessoa" data-id="<?php echo $pessoa["id"] ?>">deletar</a></td>
				<td><a href="app/model//Pessoa.php?action=open&id=<?php echo $pessoa["id"] ?>" data-id="<?php echo $pessoa["id"] ?>">abrir</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="assets/index.js"></script>