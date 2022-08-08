<?php

class Endereco
{
  public $codigo;
  public $nome;

  function __construct($codigo, $nome)
  {
    $this->codigo = $codigo;
    $this->nome = $nome;
  }
}

require "../ConexaoMySQL/MysqlConnect.php";

$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT codigo, nome
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
  $codigo = htmlspecialchars($row['codigo']);

  $nomes[] = new Endereco($codigo, $nome);
}

echo json_encode($nomes);
