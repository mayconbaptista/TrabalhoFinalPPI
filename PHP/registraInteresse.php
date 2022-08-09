<?php

require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

$codAnuncio = $_GET['cod'] ?? "";
$mensagem = $_POST['mensagem'] ?? "";
$data = $_POST['data_hora'] ?? "";
$contato = $_POST['contato'] ?? "";

try {
    $sql = <<<SQL
    
        INSERT INTO interesse(mensagem, data_hora, contato, codAnuncio)
        VALUES (?, ?, ?, ?)
    
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mensagem, $data, $contato, $codAnuncio]);

} catch (Exception $e) {
    exit('ERRO: ' . $e->getMessage());
}

header("Location: ../.");
exit;

?>