<?php
    // Verifica se o cookie do usuario existe
    if (isset($_COOKIE['username']) && isset($_COOKIE['nome']) && isset($_COOKIE['email']) && isset($_COOKIE['status']))
    {
        // Redirecionar para realizar login
        header('Location: ../../dashboard.php');
        exit();
    }
?>