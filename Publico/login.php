<?php

session_start();
if(isset($_SESSION['email'])) {
    header('Location: ../Privado/logado.php');
    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncie Já - Login</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <header>

        <nav>
            <a href="cadastrar.html">Cadastrar</a>
            <a href="login.html">Login</a>
        </nav>

    </header>
    
    <main>
        <div class="login-container" id="login-container">
            <h1 id="login-title">Login</h1>
            <form action="../PHP/initLogin.php" method="post" class="form-login">
                <div class="div-login">
                    <label for="email" class="label-login">Usuário</label>
                    <input type="email" name="email" id="email" class="input-login" required placeholder="Example@example.com">
                </div>
                <div class="div-login">
                    <label for="senha" class="label-login">Senha</label>
                    <input type="password" name="senha" id="senha" class="input-login" required placeholder="digite sua senha">
                </div>
                <div class="div-login-btn">
                    <button>Entrar</button>
                    <span id="resposta"></span>
                </div>
            </form>
            <div class="div-login">
                <p id="p-login">Não possui conta?</p>
                <a href="cadastrar.php" class="link-login">Cadastre-se</a>
            </div>
        </div>
    </main>

    <footer>

        <p>Copyright &copy; 2022 - Todos direitos reserados.</p>

    </footer>
</body>
</html>