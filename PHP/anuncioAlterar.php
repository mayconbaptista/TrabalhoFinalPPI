<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();
$idAnuncio = $_SESSION['idAnuncio'];

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


$sql = <<<SQL

    SELECT * FROM anuncio
    WHERE id = $idAnuncio;

SQL;

$stmt = $pdo->query($sql);
$row = $stmt->fetch();
if(!$row) {
    echo json_encode(new anuncio("", "", "", "", "", "", "", "", "", "", ""));
    exit;
}

echo json_encode($row['codigo'], $row['titulo'], $row['descricao'], $row['preco'], $row['data_hora'], $row['cep'], $row['bairro'], $row['cidade'], $row['estado'], $row['codCategoria'], $row['codAnunciante']);
exit;

?>