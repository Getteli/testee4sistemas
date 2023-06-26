<?php
    include('app/db/logged.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<title>teste e4 sistemas</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Login</h3>
                <div class="d-flex">
                    <div class="">
                        <form action="app/db/login.php" method="POST">
                            <div>
                                <label for="username">Usuário:</label>
                                <input type="text" id="username" name="username"  class="form-control" required>
                            </div>
                            <div>
                                <label for="senha">Senha:</label>
                                <input type="password" id="senha" name="senha" class="form-control" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="d-flex">
                    <div class="">
                        <h3>Cadastro</h3>
                        <form action="app/model/User.php?action=cadastro" method="POST">
                            <div>
                                <label for="nome">Nome:</label>
                                <input type="text" id="nome" name="nome" class="form-control" required>
                            </div>
                            <div>
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div>
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div>
                                <label for="senha">Senha:</label>
                                <input type="password" id="senha" name="senha" class="form-control" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>