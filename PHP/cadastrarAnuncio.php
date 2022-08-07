<?php

session_start();

function salvarImagem($imagem, $titulo) {
    $fp = fopen("ImagensAnuncios/" . $titulo, "wb");
    fwrite($fp, $imagem);
    fclose($fp);
}

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
$categoria = $_POST['categoria'] ?? "";
$imagem = $_POST['imagem'] ?? "";

try {

    $sql = <<<SQL
        SELECT codigo FROM categoria
        WHERE nome = $categoria
    SQL;

    $stmt = $pdo->query($sql);
    $row = $stmt->fetch();
    $codCategoria = $row['codigo'];

    $sql = <<<SQL
        INSERT INTO anuncio(titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, codCategoria, codAnunciante)
        VALUES ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    SQL;

    salvarImagem($imagem, $titulo);

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $descricao, $preco, $data, $cep, $bairro, $cidade, $estado, $categoria, $codCategoria, $_SESSION['id']]);
    $codAnuncio = $pdo->lastInsertId();

    $sql = <<<SQL

        INSERT INTO foto(codAnuncio, nomeArqFoto)
        VALUE (?, "ImagensAnuncios/" . $titulo)

    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codAnuncio]);

} catch(Exception $e) {
    exit('Erro: ' . $e->getMessage());
}

?>