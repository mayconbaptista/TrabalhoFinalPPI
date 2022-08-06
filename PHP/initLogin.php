<?php

session_start();

function checkLogin($pdo, $email, $senha) {
    $sql = <<<SQL
        SELECT senhaHash
        FROM anunciante
        WHERE email = ?
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row) return false;

        return password_verify($senha, $row['hash_senha']);

    } catch (Exception $e) {
        exit('Falha inesperada: ' . $e->getMessage());
    }
}

require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

$email = $_POST['email'] ?? "";
$senha = $_POST['senha'] ?? "";

if(checkLogin($pdo, $email, $senha)) {
    $_SESSION['email'] = $email;
    header('Location: ../Provado/logado.php');

} else {
    header('Location: ../Publico/login.php');
    exit;
}

?>