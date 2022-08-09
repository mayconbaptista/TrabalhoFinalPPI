<?php

require "../ConexaoMySQL/MysqlConnect.php";

class anuncio {
    public $nome;
    public $descricao;
    public $preco;
    public $imagePath;

    function __construct($nome, $descricao, $preco, $imagePath) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->imagePath = $imagePath;
    }
}

class arrayAnuncios {
    public $anuncios;

    function __construct($anuncios) {
        $this->anuncios = $anuncios;
    }
}


$palavrasChave = $_GET['palavras'] ?? '';
$palavras = explode(';', $palavrasChave);
$size = count($palavras);

$pdo = mysqlConnect();
$arr = [];

if($size == 1){

    $sql = <<<SQL
        SELECT * FROM  anuncio a join foto f on a.codigo = f.codAnuncio
        where a.descricao like ?
    SQL;

}else if($size == 2){

    $sql = <<<SQL
        SELECT * FROM  anuncio a join foto f on a.codigo = f.codAnuncio
            where a.descricao like ?
            or a.descricao like ?
    SQL;

}else if($size == 3){

    $sql = <<<SQL
        SELECT * FROM  anuncio a join foto f on a.codigo = f.codAnuncio
            where a.descricao like ?
            or a.descricao like ?
            or a.descricao like ?
    SQL;
 
}else if($size == 4){

    $sql = <<<SQL
        SELECT * FROM  anuncio a join foto f on a.codigo = f.codAnuncio
            where a.descricao like ?
            or a.descricao like ?
            or a.descricao like ?
            or a.descricao like ?
    SQL;

}else if($size == 5){

    $sql = <<<SQL
        SELECT * FROM  anuncio a join foto f on a.codigo = f.codAnuncio
            where a.descricao like ?
            or a.descricao like ?
            or a.descricao like ?
            or a.descricao like ?
            or a.descricao like ?
    SQL;
}

try {
    $stmt = $pdo->prepare($sql);
    if(!$stmt->execute($palavras)) throw new Exception("Erro ao buscar os nomes");

} catch(Exception $e) {
    exit("Erro " . $e->getMessage());
}

$arr = array();

while($row = $stmt->fetch()) {
    $arr[] = new anuncio ($row['titulo'], $row['descricao'], $row['preco'], $row['nomeArqFoto']);
}

$arrAnun = new arrayAnuncios($arr);
echo json_encode($arrAnun);

?>