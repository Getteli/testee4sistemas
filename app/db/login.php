<?php
    include('../db/Conn.php');

    try
    {
        $pass = $_POST['senha'];
        $username = $_POST['username'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Verificar se o usuário foi encontrado
        if ($stmt->rowCount() > 0)
        {
            // Usuário encontrado, realizar operações com os dados
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['status'] != 1)
            {
                header('Location: ../../index.php');
            }

            // Verificar a senha
            if (password_verify($pass, $row['senha']))
            {
                $duracao = time() + (86400 * 30); // Cookie válido por 30 dias

                // Salvar a string no cookie
                setcookie("username", $row['username'], $duracao, "/");
                setcookie("nome", $row['nome'], $duracao, "/");
                setcookie("email", $row['email'], $duracao, "/");
                setcookie("status", $row['status'], $duracao, "/");

                header('Location: ../../dashboard.php');
                exit();
            }
            else
            {
                throw new \Exception('Usuário não encontrado no sistema. Tente novamente');
            }
        }
        else
        {
            throw new \Exception('Usuário não encontrado no sistema. Tente novamente');
        }
    }
    catch (\Throwable $th)
    {
        header('Location: ../../index.php');
        exit();
    }
?>