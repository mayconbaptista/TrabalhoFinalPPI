<?php

session_start();
require "../ConexaoMySQL/MysqlConnect.php";
$pdo = mysqlConnect();

$imagePath = $_GET['imagePath'] ?? "";

try {
    $sql = <<<SQL

        SELECT anuncio.* FROM anuncio, foto
        WHERE foto.nomeArqFoto = ? and
            foto.codAnuncio = anuncio.codigo

    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$imagePath]);
    $anuncio = $stmt->fetch();

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
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/exibeAnuncio.css">
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
            $descricao = $anuncio['descricao'];

            echo <<<HTML
                <h1 id="titulo">$nome</h1>
                <h3 id="preco">$preco</h3>
                <p id="descricao">$descricao</p>
            HTML;

            $imagePath = "../" . $imagePath;
        ?>
        <img id="imagem" src="<?php echo $imagePath; ?>" width="300" height="300" alt="Imagem do anúncio">

        <form action="../PHP/registraInteresse.php?cod=<?php echo $anuncio['codigo']; ?>" method="post">

            <div>
                <label for="mensagem">Messagem de Interesse</label>
                <textarea name="mensagem" id="messagem" placeholder="Envie uma menssagem" required></textarea>
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

        <p>
            <img src="../Images/logo.png" alt="Logo marca" width="30" height="30">
            Copyright &copy; 2022 - Todos direitos reserados.
        </p>

    </footer>
</body>
</html>