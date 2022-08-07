<?php

session_start();
if(!isset($_SESSION['email'])) {
    header('Location: desloga.php');
    exit;
}

require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

try {
    $id = $_SESSION['id'];
    $sql = <<<SQL

        DELETE FROM anuncio WHERE codAnunciante = $id

    SQL;

    $pdo->exec($sql);
} catch(Exception $e) {
    exit('ERRO: ' . $e->getMessage());
}

header('Location: ../Privado/excluirAnuncio.php');
exit;

?>
