<?php

session_start();

if(!$_SESSION['email']) {
    header('Location: ../Publico/login.php');
    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu anúncio</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <script src="../JavaScript/verificaTitulo.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <header>

        <nav>
            <a href="../.">HOME</a>
            <a href="../PHP/desloga.php">SAIR</a>
        </nav>

    </header>

    <main>
        <div class="container">
            <form id="myForm" action="../CRUDs/cadastraAnuncio.php" method="post">
                <div class="row" hidden>
                    <label for="anunciante" class="form-label">id</label>
                    <input type="number" name="anunciante" id="anunciante" class="form-control" value="1" required readonly>
                </div>
                <div class="row mt-3">
                    <label for="titulo" class="form-label">Titulo</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" maxlength="20" required>
                </div>
                <div class="row form-floating mt-3">
                    <textarea name="descricao" id="descricao" class="form-control" cols="30" rows="5" maxlength="500" placeholder=""></textarea>
                    <label for="descricao">Descrição</label>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" name="preco" id="preco" class="form-control" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="data_hora" class="form-label">Data & Hora</label>
                        <input type="datetime-local" name="data_hora" id="data_hora" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="cep" class="form-label">Cep</label>
                        <input type="text" name="cep" id="cep" class="form-control" onchange="buscaEndereco(value)" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="">Outro</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG" selected>Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernanbuco</option>
                            <option value="PI">Piuaí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            <option value="DF">Distrito federal</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select name="categoria" id="categoria" class="form-select" required>
        
                        </select>
                    </div>
                    <div class="col-sm-8 form-group">
                        <label for="nome_arq_foto" class="form-label">Nome Foto</label>
                        <input type="text" name="nome_arq_foto" id="nome_arq_foto" class="form-control" required>
                    </div>
                </div>
                <div class="align-self-center mx-auto">
                    <button type="submit" class="btn btn-outline-primary mt-3">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>

    <footer>

        <p>Copyright &copy; 2022 - Todos direitos reserados.</p>

    </footer>
    <script src="../JavaScript/buscaCategoria.js"></script>
    <script src="../JavaScript/buscaCep.js"></script>
</body>
</html>