<?php

class Anuncio
{
    public $anunciante;
    public $titulo;
    public $descricao;
    public $preco;
    public $data_hora;
    public $cep;
    public $bairro;
    public $cidade;
    public $estado;
    public $categoria;

    function __construct($anunciante, $titulo, $descricao, $preco, $data_hora, $cep, $bairro, $cidade, $estado, $categoria)
    {
        $this->anunciante = $anunciante;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->data_hora = $data_hora;
        $this->cep = $cep;
        $this->bairro = $bairro; 
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->categoria = $categoria;
    }
}

require_once "../Mysql/MysqlConnect.php";

$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT a.id,
		a.titulo,
		a.descricao,
		a.preco,
		a.data_hora,
		a.cep,
		a.bairro,
		a.cidade,
		a.estado,
		c.nome
	FROM  anuncio a 
		join categoria c on a.categoria_id = c.id
	WHERE a.id = ?
SQL;

try{

    $stmt = $pdo->query($sql);

}catch(Exception $e){
    exit('Ocorreu uma falha: ' . $e->getMessage());
}

$anuncioId = $_GET["anuncioId"] ?? "";

while($row = $stmt->fetch())
{
    $id = $row["id"];
    $anunciante = $row["anuncioante"];
    $titulo = $row["titulo"];
    $descricao = $row["descricao"];
    $preco = $row["preco"];
    $data_hora = $row["data_hora"];
    $cep = $row["cep"];
    $bairro = $row["bairro"]; 
    $cidade = $row["cidade"];
    $estado = $row["estado"];
    $categoria = $row["categoria"];

    if($anuncioId == $id)
    {
        echo json_encode(new Anuncio($anunciante, $titulo, $descricao, $preco, $data_hora, $cep, $bairro, $cidade, $estado, $categoria));
        exit;
    }
}

$data = new DateTime();
echo json_encode(new Endereco(0,"fail","fail",0,$data->format("y-M-dThh:mm"),"00000-000","fail","fail","MG",0));