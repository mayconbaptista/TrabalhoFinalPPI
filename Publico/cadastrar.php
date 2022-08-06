<?php

session_start();
if($_SESSION['email']) {
    header('Location: ../Privado/logado.php');
    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncie Já - Cadastrar</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/cadastrar.css">
</head>
<body>
    <header>

        <nav>
            <a href="cadastrar.html">Cadastrar</a>
            <a href="login.html">Login</a>
        </nav>

    </header>

    <main>
        <form action="../CRUDs/CadAnunciante.php" method="post">

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
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Registre seu E-mail">
                </div>
                <div>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Registre sua senha">
                </div>
            </fieldset>

            <div class="form-btn">
                <button>Cadastrar</button>
            </div>

            <div class="div-login">
                <p id="p-login">Já possui conta?</p>
                <a href="login.html" class="link-login">Faça Login</a>
            </div>
        </form>
    </main>

    <footer>

        <p>Copyright &copy; 2022 - Todos direitos reserados.</p>

    </footer>
</body>
</html>