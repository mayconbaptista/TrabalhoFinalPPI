<?php

use arrayAnuncios as GlobalArrayAnuncios;

session_start();

class anuncio {
    public $codigo;
    public $titulo;
    public $descricao;
    public $preco;
    public $data;
    public $cep;
    public $bairro;
    public $cidade;
    public $estado;
    public $codCategoria;
    public $codAnunciante;

    function __construct($codigo, $titulo, $descricao, $preco, $data, $cep, $bairro, $cidade, $estado, $codCategoria, $codAnunciante) {
        $this->codigo = $codigo;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->data = $data;
        $this->cep = $cep;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->codCategoria = $codCategoria;
        $this->codAnunciante = $codAnunciante;
    }
}

class arrayAnuncios {
    public $arr;
    public $qtd;

    function __construct($arr, $qtd) {
        $this->arr = $arr;
        $this->qtd = $qtd;
    }
}


require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();
$id = $_SESSION['id'];

try {
    $sql = <<<SQL
        SELECT * FROM anunciante
        WHERE codAnunciante = $id
    SQL;
    $stmt = $pdo->query($sql);

} catch(Exception $e) {
    exit('Erro: ' . $e->getMessage());
}

$arr = array();
$i = 0;
while($row = $stmt->fetch()) {
    $arr[$i] = new anuncio($row['codigo'], $row['titulo'], $row['descricao'], $row['preco'], $row['data_hora'], $row['cep'], $row['bairro'], $row['cidade'], $row['estado'], $row['codCategoria'], $row['codAnunciante']);
    ++$i;
}
++$i;

$arrAnuncios = new arrayAnuncios($arr, $i);
echo json_encode($arrAnuncios);
exit;

?>