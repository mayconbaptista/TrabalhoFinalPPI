<?php

class Endereco
{
  public $cep;
  public $cidade;
  public $estado;

  function __construct($cep, $cidade, $estado)
  {
    $this->cep = $cep;
    $this->cidade = $cidade;
    $this->estado = $estado;
  }
}

require "../Mysql/MysqlConnect.php";

$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT cep, cidade, estado
  FROM base
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

$cepGET = $_GET['cep'] ?? '';

while ($row = $stmt->fetch()) {

  $cep = htmlspecialchars($row['cep']);
  $cidade = htmlspecialchars($row['cidade']);
  $estado = htmlspecialchars($row['estado']);

  $endereco = new Endereco($cep ,$cidade, $estado);
  
  if($cepGET == $cep){
    echo json_encode($endereco);
    exit;
  }
}
$endereco = new Endereco( '?','none', 'PR');
echo json_encode($endereco);
?>