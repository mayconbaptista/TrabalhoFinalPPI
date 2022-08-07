<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

$nome = $_GET['nome'] ?? "";

try {
    $sql = <<<SQL

        SELECT * FROM anuncio WHERE titulo = $nome

    SQL;

    $stmt = $pdo->query($sql);
    $anuncio = $stmt->fetch();
    $codAnuncio = $anuncio['codigo'];

    $sql = <<<SQL

        SELECT nomeArqFoto FROM foto WHERE codAnuncio = $codAnuncio;

    SQL;

    $stmt = $pdo->query($sql);
    $caminho = $stmt->fetch();

} catch(Exception $e) {
    exit('ERRO: ' . $e->getMessage());
}

?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Anúncio</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
</head>
<body>
    <header>


        <?php
        
            if(!isset($_SESSION['email']))
                echo <<<HTML
                    <nav>
                        <a href="cadastrar.php">Cadastrar</a>
                        <a href="login.php">Login</a>
                    </nav>
                HTML;

            else
                echo <<<HTML
                    <nav>
                        <a href="../.">HOME</a>
                        <a href="../Privado/logado.php">PERFIL</a>
                        <a href="../PHP/desloga.php">SAIR</a>
                    </nav>
                HTML;
        
        ?>

    </header>

    <main>

        <?php
            $nome = $anuncio['titulo'];
            $preco = $anuncio['preco'];
            $descricao = $anuncio['anuncio'];

            echo <<<HTML
                <h1 id="titulo">$nome</h1>
                <h3 id="preco">$preco</h3>
                <p id="descricao">$descricao</p>
            HTML;
        ?>
        <img id="imagem" src="<?php echo $caminho; ?>" alt="Imagem do anúncio">

        <form action="../PHP/registraInteresse.php?cod=<?php echo $anuncio['codigo']; ?>" method="post">

            <div>
                <textarea name="mensagem" id="messagem" placeholder="Envie uma menssagem" required>
                <label for="mensagem">Messagem de Interesse</label>
            </div>

            <div>
                <label for="data_hora">Data & Hora</label>
                <input type="datetime-local" name="data_hora" id="data_hora" required>
            </div>

            <div>
                <label for="contato">Contato de Telefone</label>
                <input type="tel" name="contato" id="contato" placeholder="Infome telefone para contato" required>
            </div>

            <button>Enviar</button>

        </form>

    </main>

    <footer>

        <p>Copyright &copy; 2022 - Todos direitos reserados.</p>

    </footer>
</body>
</html>