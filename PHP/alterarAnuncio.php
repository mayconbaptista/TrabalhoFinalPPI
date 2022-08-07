<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

if(!isset($_SESSION['email'])) {
    header("../PHP/desloga.php");
    exit;
}

$titulo = $_POST['titulo'] ?? "";
$descricao = $_POST['descricao'] ?? "";
$preco = $_POST['preco'] ?? "";
$data = $_POST['data_hora'] ?? "";
$cep = $_POST['cep'] ?? "";
$bairro = $_POST['bairro'] ?? "";
$cidade = $_POST['cidade'] ?? "";
$estado = $_POST['estado'] ?? "";

try {

    $id = $_SESSION['id'];
    $sql = <<<SQL
        UPDATE anuncio
        SET titulo = ?, descricao = ?, preco = ?, data_hora = ?, cep = ?, bairro = ?, cidade = ?, estado = ?
        VALUES codAnunciante = $id
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $descricao, $preco, $data, $cep, $bairro, $cidade, $estado]);
    
} catch(Exception $e) {
    exit('Erro: ' . $e->getMessage());
}

?>