<?php
    include('app/db/keep_login.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<title>Dashboard - Editar</title>
</head>
<body>
	<div class="d-block w-100 text-end pe-3 mt-3">
		<a href="dashboard.php" class="text-decoration-none text-success">Voltar</a>
	</div>
	<main class="container">
		<div class="col-12 col-sm-6">
			<div class="d-flex">
				<div class="">
					<h3>Editar meu perfil</h3>
					<form action="app/model/User.php?action=editar" method="POST">
						<div>
							<label for="nome">Nome:</label>
							<input type="text" id="nome" name="nome" class="form-control" value="<?php echo $_COOKIE['nome'] ?>" required>
						</div>
						<div>
							<label for="username">Username:</label>
							<input type="text" id="username" name="username" class="form-control" value="<?php echo $_COOKIE['username'] ?>" required>
						</div>
						<div>
							<label for="email">Email:</label>
							<input type="email" id="email" name="email" class="form-control" value="<?php echo $_COOKIE['email'] ?>" required>
						</div>
						<div>
							<label for="senha">Senha:</label>
							<input type="password" id="senha" name="senha" class="form-control">
						</div>
						<div class="my-3">
							<button type="submit" class="btn btn-primary">Editar</button>
						</div>
					</form>
					<button type="button" id="deleteUser" class="btn btn-danger">Excluir</button>
				</div>
			</div>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="assets/index.js"></script>