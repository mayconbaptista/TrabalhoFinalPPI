<?php

class Endereco
{
  public $cep;
  public $bairro;
  public $cidade;
  public $estado;

  function __construct($cep, $bairro, $cidade, $estado)
  {
    $this->cep = $cep;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
    $this->estado = $estado;
  }
}

require "../Mysql/MysqlConnect.php";

$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT cep, bairro, cidade, estado
  FROM base
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

$cepGET = $_GET['cep'] ?? '';

while ($row = $stmt->fetch()) {

  //echo $cep + " # ";
  $cep = htmlspecialchars($row['cep']);
  $bairro = htmlspecialchars($row['bairro']);
  $cidade = htmlspecialchars($row['cidade']);
  $estado = htmlspecialchars($row['estado']);

  $endereco = new Endereco($cep, $bairro ,$cidade, $estado);
  
  if($cepGET == $cep)
  {
    echo json_encode($endereco);
    exit;
  }
}

$endereco = new Endereco( $cep,'','','');

echo json_encode($endereco);
?>