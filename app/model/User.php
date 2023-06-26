<?php

$action = filter_var($_GET['action']);

switch ($action)
{
    case 'cadastro':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $senha = $_POST['senha'];

        (new User())->criarUsuario($nome, $email, $username, $senha);
        break;
    case 'editar':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $senha = $_POST['senha'];

        (new User())->editarUsuario($nome, $email, $username, $senha);
        break;
    case 'delete':
        (new User())->excluirUsuario();
        break;
}

class User
{
    private string $nome;
    private string $email;
    private string $username;
    private string $senha;
    private bool $status;
    private $conn;

    function __construct()
    {
        $this->conn = include('../db/Conn.php');
    }

    // Métodos de definição (set)
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    // Métodos de obtenção (get)
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    // Método para criar usuário
    public function criarUsuario($nome, $email, $username, $senha, $status = 1): void
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO user (nome, email, username, senha, status) VALUES (:nome, :email, :username, :senha, :status)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':senha',password_hash($senha, PASSWORD_DEFAULT));
            $stmt->bindParam(':status', $status);

            $stmt->execute();
            $duracao = time() + (86400 * 30); // Cookie válido por 30 dias

            // Salvar a string no cookie
            setcookie("username", $username, $duracao, "/");
            setcookie("nome", $nome, $duracao, "/");
            setcookie("email", $email, $duracao, "/");
            setcookie("status", $status, $duracao, "/");

            header('Location: ../../dashboard.php');
            exit();

        }
        catch (\Throwable $th)
        {
            header('Location: ../../index.php');
            exit;
        }
    }

    // Método para editar usuário
    public function editarUsuario($nome, $email, $username, $senha, $status = 0): void
    {
        try
        {
            if (!empty($senha))
            {
                $stmt = $this->conn->prepare("UPDATE user SET nome = :nome, email = :email, username = :username, senha = :senha WHERE username = :username");
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':senha',password_hash($senha, PASSWORD_DEFAULT));
                $stmt->bindParam(':status', $status);
            }
            else
            {
                $stmt = $this->conn->prepare("UPDATE user SET nome = :nome, email = :email, username = :username WHERE username = :username");
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':status', $status);
            }

            $stmt->execute();
            $duracao = time() + (86400 * 30); // Cookie válido por 30 dias

            // Salvar a string no cookie
            setcookie("username", $username, $duracao, "/");
            setcookie("nome", $nome, $duracao, "/");
            setcookie("email", $email, $duracao, "/");
            setcookie("status", $status, $duracao, "/");

            header('Location: ../../dashboard.php');
            exit();

        }
        catch (\Throwable $th)
        {
            header('Location: ../../index.php');
            exit;
        }
    }

    // Método para excluir usuário
    public function excluirUsuario(): void
    {
        $username = $_COOKIE['username'];

        try
        {
            $stmt = $this->conn->prepare("UPDATE user SET status = 0 WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $duracao = time() - 3600;
            setcookie("username", '', $duracao, "/");
            setcookie("nome", '', $duracao, "/");
            setcookie("email",'', $duracao, "/");
            setcookie("status",'', $duracao, "/");

            echo true;
        }
        catch (\Throwable $th)
        {
            echo false;
        }
    }
}
?>