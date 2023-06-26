<?php
    $servername = "localhost"; 
    $user_db = "getteli";
    $pass = "0505getteli";
    $dbname = "database_testee4sistemas";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user_db, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch (PDOException $e)
    {
        echo "Falha na conexão com o banco de dados: " . $e->getMessage();
        exit;
    }
?>