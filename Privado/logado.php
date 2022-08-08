<?php

session_start();

if(!isset($_SESSION['email'])) {
    header('Location: ../Publico/login.php');
    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncie Já - Bem vindo, Anunciante!</title>

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
            <a href=".">PERFIL</a>
            <a href="../PHP/desloga.php">SAIR</a>
        </nav>

    </header>

    <main class="container p-3">

        <ul class="list-group">
            <li class="list-group-item"><a href="cadastraAnuncio.php">Fazer Anúncio</a></li>
            <li class="list-group-item"><a href="listarAnuncios.php">Mostrar Meus Anúncios</a></li>
            <li class="list-group-item"><a href="escolherAnuncioAlterar.php">Editar Anúncio</a></li>
            <li class="list-group-item"><a href="excluirAnuncio.php">Excluir Anúncio</a></li>
            <li class="list-group-item"><a href="listarInteresses.php">Ver Menssagens de Interesse</a></li>
            <li class="list-group-item"><a href="excluirInteresse.php">Excluir Menssagens de Interesse</a></li>
            <li class="list-group-item"><a href="alterarPerfil.php">Editar Perfil</a></li>
        </ul>

    </main>

    <footer>

        <p>Copyright &copy; 2022 - Todos direitos reserados.</p>

    </footer>
</body>
</html>