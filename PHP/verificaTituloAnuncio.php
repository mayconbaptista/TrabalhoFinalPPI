<?php

require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

class verifica {
    public $naoEsta;

    function __construct($naoEsta) {
        $this->naoEsta = $naoEsta;
    }
}

try {
    $sql = <<<SQL

        SELECT titulo FROM anuncio
        WHERE titulo = ?

    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['titulo']]);

} catch(Exception $e) {
    exit('Erro: ' . $e->getMessage());
}

$row = $stmt->fetch();

if(!$row)
    $resultado = new verifica(true);
else
    $resultado = new verifica(false);

echo json_encode($resultado);
exit;

?>