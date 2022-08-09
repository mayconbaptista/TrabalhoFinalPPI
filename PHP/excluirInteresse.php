<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

if(!isset($_SESSION['email'])) {
    header('Location: desloga.php');
    exit;
}

$codigo = $_GET['id'] ?? "";

$sql = <<<SQL

    DELETE FROM interesse WHERE codigo = $codigo

SQL;

try {
    $stmt = $pdo->exec($sql);
} catch(Exception $e) {
    exit("ERRO: " . $e->getMessage());
}

header('Location: ../Privado/logado.php');
exit;

?>