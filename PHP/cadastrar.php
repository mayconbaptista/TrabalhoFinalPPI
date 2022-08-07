<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

$nome = $_POST['nome'] ?? "";
$cpf = $_POST['cpf'] ?? "";
$telefone = $_POST['telefone'] ?? "";
$email = $_POST['email'] ?? "";
$senha = $_POST['senha'] ?? "";
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $sql = <<<SQL

        SELECT * FROM anunciante
        WHERE email = ?

    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if($stmt->fetch()) {
        header('Location: ../Publico/cadastrar.php');
        exit;
    }

    $sql = <<<SQL

        INSERT INTO anunciante(nome, cpf, email, senhaHash, telefone)
        VALUES (?, ?, ?, ?, ?)

    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cpf, $email, $senhaHash, $telefone]);

    $id = $pdo->lastInsertId();
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    
    header("Location: ../Privado/logado.php");
    exit;

} catch(Exception $e) {
    exit("Erro: " . $e->getMessage());
}

?>