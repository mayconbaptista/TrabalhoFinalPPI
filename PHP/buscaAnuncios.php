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

try {
    $sql = <<<SQL

        SELECT codigo
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

        ORDER BY DataHora DESC

    SQL;
    $sql = $sql . $aux;

    $stmt->prepare($sql);
    $stmt->execute($palavras);

    // TODO: buscar caminhos das imagens

} catch(Exception $e) {
    exit('Erro: ' . $e->getMessage());
}

// TODO: Retorna JSON

?>