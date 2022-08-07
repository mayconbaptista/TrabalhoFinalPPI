<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

if(!isset($_SESSION['email'])) {
    header('Location: desloga.php');
    exit;
}

$codAnuncio = $_GET['id'] ?? "";

$sql = <<<SQL

    DELETE FROM interesse WHERE codAnuncio = ?

SQL;

try {
    $stmt = $pdo->exec($sql);
} catch(Exception $e) {
    exit("ERRO: " . $e->getMessage());
}

?>