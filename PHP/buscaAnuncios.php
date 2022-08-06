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


function separaPalavras($str) {
    $arr = [];
    $j = 0;
    $numPalavra = 0;

    for($i = 0; $i < strlen($str); ++$i) {
        if($str[$i] == ";") {
            $palavra = '';
            for($z = 0; $j < $i; ++$j, ++$z)
                $palavra[$z] = $str[$j];

            $arr[$numPalavra] = $palavra;
            ++$j;
            ++$numPalavra;

            if($numPalavra >= 5)
                break;
        }
    }

    return $arr;
}


$palavrasChave = $_GET['busca'] ?? '';
$palavras = separaPalavras($palavrasChave);

$pdo = mysqlConnect();
$arr = [];

try {
    $sql = <<<SQL

        SELECT codigo, titulo, descricao, preco
        FROM anuncio
        WHERE 1 = 1 AND

    SQL;

    for($i = 0; $i < count($palavras); ++$i) {
        $aux = <<<SQL
            descricao like ‘%?%’
        SQL;
        $sql = $sql . $aux;
    }

    $aux = <<<SQL

        ORDER BY data_hora DESC

    SQL;
    $sql = $sql . $aux;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($palavras);

    $i = 0;
    while($row = $stmt->fetch()) {
        $codigo = $row['codigo'];

        $sql = <<<SQL
            SELECT nomeArqFoto
            FROM foto
            WHERE codAnuncio = ?
        SQL;

        $stmt2 = $pdo->prepare($sql);
        $stmt2->execute([$codigo]);

        $row2 = $stmt2->fetch();
        $arr[$i] = new anuncio($row['nome'], $row['descricao'], $row['preco'], $row2['nomeArqFoto']);
    }

} catch(Exception $e) {
    exit('Erro: ' . $e->getMessage());
}

$arrAnun = new arrayAnuncios($arr);
echo json_encode($arrAnun);

?>