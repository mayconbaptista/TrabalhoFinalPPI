<?php

session_start();
if(!isset($_SESSION['email'])) {
    header("Location: ../PHP/desloga.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar perfil</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/cadastrar.css">
    <script src="../JavaScript/preencheAlterarPerfil.js"></script>
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

        <form action="../PHP/cadastrar.php" method="post">

            <fieldset>
                <legend>Informaçẽs Pessoais</legend>
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome Completo">
                </div>
                <div>
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" placeholder="CPF">
                </div>
                <div>
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" placeholder="Telefone">
                </div>
            </fieldset>

            <fieldset>
                <legend>Informaçẽs de Login</legend>
                <div>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Registre sua senha">
                </div>
            </fieldset>

            <div class="form-btn">
                <button>Alterar</button>
            </div>
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