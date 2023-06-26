<?php

$action = filter_var($_GET['action'] ?? null) ?? null;

switch ($action)
{
    case 'cadastro':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $logradouro = $_POST['logradouro'];
        $complemento = $_POST['complemento'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $telefone = $_POST['telefone'];


        (new Pessoa())->criarPessoa($nome, $email, $logradouro, $complemento, $numero, $bairro, $cidade, $estado, $telefone);
        break;
    case 'editar':
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        (new Pessoa())->editarPessoa($nome, $email, $id);
        break;
    case 'delete':
        $id = $_POST['id'];
        (new Pessoa())->excluirPessoa($id);
        break;
    case 'open':
        $id = $_GET['id'];
        $pessoa = (new Pessoa())->getPessoa($id);
        break;
}

class Pessoa
{
    private string $nome;
    private string $email;
    private string $username;
    private string $senha;
    private bool $status;
    private $conn;

    function __construct()
    {
        if (file_exists('../db/Conn.php'))
        {
            $this->conn = include('../db/Conn.php');
        }
        else
        {
            $this->conn = include(__DIR__.'/../../app/db/Conn.php');
        }
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

    // Método para criar pessoa
    public function criarPessoa($nome, $email, $logradouro, $complemento, $numero, $bairro, $cidade, $estado, $telefone): void
    {
        try
        {
            $sql = "INSERT INTO endereco (logradouro, complemento, numero, bairro, cidade, estado) 
            VALUES (:logradouro, :complemento, :numero, :bairro, :cidade, :estado)";
            $stmt = $this->conn->prepare($sql);

            // Executar a consulta com os valores dos parâmetros
            $stmt->execute([
                ':logradouro' => $logradouro,
                ':complemento' => $complemento,
                ':numero' => $numero,
                ':bairro' => $bairro,
                ':cidade' => $cidade,
                ':estado' => $estado
            ]);

            $endereco_id = $this->conn->lastInsertId();


            $stmt = $this->conn->prepare("INSERT INTO pessoa (nome, email, endereco_id) VALUES (:nome, :email, :endereco_id)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':endereco_id', $endereco_id);
            $stmt->execute();
            $pessoa_id = $this->conn->lastInsertId();

            foreach ($telefone as $key => $telefone)
            {
                $ddd = $telefone['ddd'];
                $numero = $telefone['numero'];
                
                $stmt = $this->conn->prepare("INSERT INTO telefone (ddd, numero, pessoa_id) VALUES (:ddd, :numero, :pessoa_id)");
                $stmt->bindParam(':ddd', $ddd);
                $stmt->bindParam(':numero', $numero);
                $stmt->bindParam(':pessoa_id', $pessoa_id);
                $stmt->execute();
            }

            header('Location: ../../criar-pessoa.php');
            exit();

        }
        catch (\Throwable $th)
        {
            header('Location: ../../index.php');
            exit;
        }
    }

    // Método para editar pessoa
    public function editarPessoa($nome, $email, $id): void
    {
        try
        {
            $stmt = $this->conn->prepare("UPDATE pessoa SET nome = :nome, email = :email WHERE id = :id");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            header('Location: ../../listar-pessoa.php');
            exit();
        }
        catch (\Throwable $th)
        {
            header('Location: ../../index.php');
            exit;
        }
    }

    // Método para excluir pessoa
    public function excluirPessoa($id): void
    {
        try
        {
            $this->conn->beginTransaction();

            // Deleta o registro da tabela "endereco" pelo campo "endereco_id" da tabela "pessoa"
            $stmtEndereco = $this->conn->prepare("DELETE FROM endereco WHERE endereco_id = (SELECT endereco_id FROM pessoa WHERE id = :id)");
            $stmtEndereco->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtEndereco->execute();
        
            // Deleta a pessoa pelo ID
            $stmtPessoa = $this->conn->prepare("DELETE FROM pessoa WHERE id = :id");
            $stmtPessoa->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtPessoa->execute();
        
            // Confirma a transação
            $this->conn->commit();

            echo true;
        }
        catch (\Throwable $th)
        {
            echo false;
        }
    }

    // Método para listar pessoas
    public function listarPessoa() : array
    {
        $stmt = $this->conn->prepare("SELECT p.*, t.ddd AS ddd_telefone, t.numero AS numero_telefone
            FROM pessoa p
            LEFT JOIN (
                SELECT pessoa_id, ddd, numero
                FROM telefone
                WHERE id IN (
                    SELECT MIN(id)
                    FROM telefone
                    GROUP BY pessoa_id
                )
            ) t ON p.id = t.pessoa_id");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getPessoa($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pessoa WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Recupera o registro encontrado
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        return $registro;
    }
}

$allPessoa = (new Pessoa())->listarPessoa();
?>