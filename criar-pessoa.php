<?php
    include('app/db/keep_login.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<title>Dashboard - Criar Pessoa</title>
</head>
<body>
	<div class="d-block w-100 text-end pe-3 mt-3">
		<a href="dashboard.php" class="text-decoration-none text-success">Voltar</a>
	</div>
	<main class="container">
	<div class="col-12 col-sm-6">
		<div class="d-flex">
			<div class="">
				<h3>Criar pessoa</h3>
				<form action="app/model/Pessoa.php?action=cadastro" method="POST">
					<div>
						<label for="nome">Nome:</label>
						<input type="text" id="nome" name="nome" class="form-control" require>
					</div>
					<div>
						<label for="email">Email:</label>
						<input type="email" id="email" name="email" class="form-control" require>
					</div>
					<fieldset>
						<legend>Endereço</legend>
						<div>
							<label for="logradouro">Logradouro:</label>
							<input type="text" id="logradouro" name="logradouro" class="form-control" require>
						</div>
						<div>
							<label for="numero">numero:</label>
							<input type="text" id="numero" name="numero" class="form-control" require>
						</div>
						<div>
							<label for="complemento">Complemento:</label>
							<input type="text" id="complemento" name="complemento" class="form-control" require>
						</div>
						<div>
							<label for="bairro">Bairro:</label>
							<input type="text" id="bairro" name="bairro" class="form-control" require>
						</div>
						<div>
							<label for="cidade">Cidade:</label>
							<input type="text" id="cidade" name="cidade" class="form-control" require>
						</div>
						<div>
							<label for="estado">Estado:</label>
							<input type="text" id="estado" maxlength="2" name="estado" class="form-control" require>
						</div>
					</fieldset>
					<fieldset>
						<legend>Telefones</legend>
						<button type="button" class="btn" id="add-mais-telefone">+</button>
						<div id="container-telefone">
							<div class="div-telefone">
								<div>
									<label for="ddd">ddd:</label>
									<input type="text" id="ddd" maxlength="2" name="telefone[1][ddd]" class="form-control" >
								</div>
								<div>
									<label for="ddd">Telefone:</label>
									<input type="text" id="telefone" maxlength="9" name="telefone[1][numero]" class="form-control" >
								</div>
							</div>
						</div>
					</fieldset>
					<div class="my-3">
						<button type="submit" class="btn btn-primary">Criar</button>
					</div>
				</form>
			</div>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="assets/index.js"></script>