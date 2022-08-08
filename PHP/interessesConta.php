<?php

session_start();
if(!isset($_SESSION['email'])) {
    header('Location: desloga.php');
    exit;
}

class interesse {
    public $codigo;
    public $mensagem;
    public $data;
    public $contato;
    public $codAnuncio;

    function __construct($codigo, $mensagem, $data, $contato, $codAnuncio) {
        $this->codigo = $codigo;
        $this->mensagem = $mensagem;
        $this->data = $data;
        $this->contato = $contato;
        $this->codAnuncio = $codAnuncio;
    }
}

class arrayInteresse {
    public $arr;

    function __construct($arr) {
        $this->arr = $arr;
    }
}


require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

try {

    $id = $_SESSION['id'];
    $sql = <<<SQL

        SELECT interesse.* FROM interesse, anuncio
        WHERE anuncio.codAnunciante = $id AND
            interesse.codAnuncio = anuncio.codigo

    SQL;

    $stmt = $pdo->query($sql);

    $arr = [];
    $i = 0;

    while($row = $stmt->fetch()) {
        $arr[$i] = new interesse($row['codigo'], $row['mesagem'], $row['data_hora'], $row['contato'], $row['codAnuncio']);
        ++$i;
    }

    echo json_encode(new arrayInteresse($arr));
    exit;

} catch(Exception $e) {
    exit('Erro: ' . $e->getMessage());
}

?>