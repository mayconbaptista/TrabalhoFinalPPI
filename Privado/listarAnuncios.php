<?php

session_start();
if(!isset($_SESSION['email'])) {
    header("Location: ../PHP/desloga.php");
    exit;
}

require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

$codigo = $_SESSION['id'];
if(!$codigo)
    exit;

$sql = <<<SQL

    SELECT codigo, titulo, descricao, preco, data_hora
    FROM anuncio
    WHERE codAnunciante = ?

SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codigo]);

} catch (Exception $e) {
    exit('ERRO: ' . $e->getMessage());
}

?>

<!doctype html>

<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meus Anúncios</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>

    <header>

        <nav>
            <a href="../.">HOME</a>
            <a href="../Privado/logado.php">PERFIL</a>
            <a href="../PHP/desloga.php">SAIR</a>
        </nav>

    </header>

    <main class="container">

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>

                <?php

                    while($row = $stmt->fetch()) {
                        $codigo = htmlspecialchars($row['codigo']);
                        $nome = htmlspecialchars($row['titulo']);
                        $descricao = htmlspecialchars($row['descricao']);
                        $preco = htmlspecialchars($row['preco']);
                        $data = htmlspecialchars($row['data_hora']);
                        
                        echo <<<HTML

                            <tr>
                                <td>$codigo</td>
                                <td>$nome</td>
                                <td>$descricao</td>
                                <td>$preco</td>
                                <td>$data</td>
                            </tr>

                        HTML;
                    }

                ?>

            </tbody>
        </table>

    </main>

    <footer>

        <p>Copyright &copy; 2022 - Todos direitos reserados.</p>

    </footer>
</body>
</html>