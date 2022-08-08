<?php

session_start();

function salvarImagem($caminho) {
  move_uploaded_file($_FILES["nome_arq_foto"]['tmp_name'], "../" . $caminho);
}

require "../ConexaoMySQL/MysqlConnect.php";

$pdo = mysqlConnect();

if(!$_SESSION['email']) {
    header("../PHP/desloga.php");
    exit;
}

$titulo = $_POST["titulo"] ?? "";
$descricao = $_POST["descricao"] ?? "";
$preco = $_POST["preco"] ?? "";
$data_hora = $_POST["data_hora"] ?? "";
$cep = $_POST["cep"] ?? "";
$bairro = $_POST["bairro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$categoria_id = $_POST["categoria"] ?? "";
$anunciante_id = $_POST["anunciante"] ?? "";

$sql = <<<SQL
  INSERT INTO anuncio (titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, codCategoria, codAnunciante)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO foto (codAnuncio, nomeArqFoto)
  VALUES (?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([
    $titulo , $descricao, $preco, $data_hora, $cep, $bairro, $cidade, $estado,$categoria_id, $_SESSION['id']
  ])) throw new Exception('Falha ao inserir o endereço');

  $anuncio_id = $pdo->lastInsertId();
  $nome = $anuncio_id . ".jpg";
  salvarImagem("ImagensAnuncios/" . $nome);

  $stsmt2 = $pdo->prepare($sql2);
  
  if(!$stsmt2->execute([
    $anuncio_id, "ImagensAnuncios/" . $nome
  ])) throw new Exception('Falha ao inserir a foto');

  $pdo->commit();

  header("Location: ../Privado/listarAnuncios.php");
  exit();
  
} catch (Exception $e) {
    $pdo->rollBack();
    if ($e->errorInfo[1] === 1062)
      exit('Dados duplicados: ' . $e->getMessage());
    else
      exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}

?>