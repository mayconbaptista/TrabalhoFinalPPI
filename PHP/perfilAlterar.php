<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

class anunciante {
    public $codigo;
    public $nome;
    public $cpf;
    public $email;
    public $senhaHash;
    public $telefone;

    function __construct($codigo, $nome, $cpf, $email, $senhaHash, $telefone) {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senhaHash = $senhaHash;
        $this->telefone = $telefone;
    }
}

$id = $_SESSION['id'];
$sql = <<<SQL

    SELECT * FROM anunciante WHERE codigo = $id

SQL;

$stmt = $pdo->query($sql);
$row = $stmt->fetch();
if(!$row) {
    echo json_encode(new anunciante("", "", "", "", "", ""));
    exit;
}

echo json_encode(new anunciante($row['codigo'], $row['nome'], $row['cpf'], $row['email'], $row['senhaHash'], $row['telefone']));
exit;

?>