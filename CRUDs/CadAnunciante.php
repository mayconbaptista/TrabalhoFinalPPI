<?php

require_once "../Mysql/MysqlConnect.php";

$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$email = $_POST["eamil"] ?? "";

if(isset( $_POST["senha"])) $senhaHash = password_hash($_POST["senha"], PASSWORD_DEFAULT);

$telefone = $_POST["telefone"] ?? "";

$sql = <<<SQL
  INSERT INTO (nome, cpf, email, senhaHash, telefone)
  VALUES (?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([
    $nome, $cpf, $email, $senhaHash, $telefone
  ])) throw new Exception('Falha ao inserir o endereço');

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
