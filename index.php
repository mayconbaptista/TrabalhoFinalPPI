<?php

session_start();

?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncie Já - HOME</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/home.css">

    <script src="JavaScript/homeBusca.js"></script>
    <script src="JavaScript/abrirAnuncio.js"></script>
</head>
<body>
    <header>


        <?php
        
            if(!isset($_SESSION['email']))
                echo <<<HTML
                    <nav>
                        <a href="Publico/cadastrar.php">Cadastrar</a>
                        <a href="Publico/login.php">Login</a>
                    </nav>
                HTML;

            else
                echo <<<HTML
                    <nav>
                        <a href=".">HOME</a>
                        <a href="Privado/logado.php">PERFIL</a>
                        <a href="PHP/desloga.php">SAIR</a>
                    </nav>
                HTML;
        
        ?>

    </header>

    <main>

        <form id="busca-form">
            <div class="busca-anuncios">
                <label for="busca" class="busca-label">Busca</label>
                <input type="text" id="busca" class="busca-input" placeholder="Busque com palavras chaves">
                <span class="busca-mensagem"></span>
            </div>
        </form>
        <hr>


        <section id="prod-section">
        </section>

    </main>

    <footer>

        <p>Copyright &copy; 2022 - Todos direitos reserados.</p>

    </footer>
</body>
</html>