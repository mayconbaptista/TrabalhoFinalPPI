<?php

require "../Mysql/MysqlConnect.php";

$pdo = mysqlConnect();

$titulo = $_POST["titulo"] ?? " ";
$descricao = $_POST["descricao"] ?? " ";
$preco = $_POST["preco"] ?? "";
$data_hora = $_POST["data_hora"] ?? " ";
$cep = $_POST["cep"] ?? "";
$bairro = $_POST["logradouro"] ?? " ";
$cidade = $_POST["cidade"] ?? " ";
$estado = $_POST["estado"] ?? " ";
$categoria_id = $_POST["categoria"] ?? " ";
$anunciante_id = $_POST["anunciante"] ?? " ";
$nomeFoto = $_POST["foto"] ?? " ";



$sql = <<<SQL
  INSERT INTO anuncio (titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, categoria_id, anunciante_id)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO foto (anuncio_id, nome_arq_foto)
  VALUES (?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([
    $titulo , $descricao, $preco, $data_hora, $cep, $bairro, $cidade, $estado,$categoria_id, $anunciante_id
  ])) throw new Exception('Falha ao inserir o endereço');

  $anuncio_id = $pdo->lastInsertId();

  $stsmt2 = $pdo->prepare($sql2);
  if(!$stsmt2->execute([
    $anuncio_id, $nomeFoto
  ])) throw new Exception('Falha ao inserir a foto');

  $pdo->commit();

  header("location: ../privado/cria.html");
  exit();
  
} catch (Exception $e) {
    $pdo->rollBack();
    if ($e->errorInfo[1] === 1062)
      exit('Dados duplicados: ' . $e->getMessage());
    else
      exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
