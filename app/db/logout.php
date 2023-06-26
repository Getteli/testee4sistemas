<?php
    // Deletar o cookie definindo o valor como vazio e tempo de expiração passado
    $duracao = time() - 3600;
    setcookie("username", '', $duracao, "/");
    setcookie("nome", '', $duracao, "/");
    setcookie("email",'', $duracao, "/");
    setcookie("status",'', $duracao, "/");

    // Redirecionar para outra página
    header('Location: ../../index.php');
    exit();
?>