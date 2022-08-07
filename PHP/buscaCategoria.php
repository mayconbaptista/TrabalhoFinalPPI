<?php

class Endereco
{
  public $id;
  public $nome;

  function __construct($id, $nome)
  {
    $this->id = $id;
    $this->nome = $nome;
  }
}

require "../ConexaoMySQL/MysqlConnect.php";

$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT id, nome
    FROM categoria
SQL;

try {
    $stmt = $pdo->query($sql);
} 
catch (Exception $e)
{
    exit('Falha inesperada: ' . $e->getMessage());
}

$nomes = array();

while ($row = $stmt->fetch())
{
  $nome = htmlspecialchars($row['nome']);
  $id = htmlspecialchars($row['id']);

  $nomes[] = new Endereco($id, $nome);
}

echo json_encode($nomes);
