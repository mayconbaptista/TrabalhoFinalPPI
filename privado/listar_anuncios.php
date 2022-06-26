<?php

require_once "../Mysql/MysqlConnect.php";

$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT *
  FROM anuncio a join categoria c on a.categoria_id = c.id
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/base.css">
    <title>Document</title>
</head>
<body>
    <header>
      <nav>
        <a href="imgs/logo.png" class="logo">Classificados</a>
        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-list">
            <li><a href="">Busca</a></li>
            <li><a href="">Resultados</a></li>
            <li><a href="">Cria Conta</a></li>
            <li><a href="">login</a></li>
        </ul>
      </nav>
    </header>
    <main>
        <div class="container mt-5">
            <h2 class="text">Lista dos anuncios</h2>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Cod categoria</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contt = 1;
                  
                  while($row = $stmt->fetch())
                  {
                    $titulo = htmlspecialchars($row['titulo']);
                    $descricao = htmlspecialchars($row['descricao']);
                    $preco = htmlspecialchars($row['preco']);
                    $cep = htmlspecialchars($row['categoria_id']);

                    echo <<<HTML
                    <tr>
                      <th scope="row">{$contt}</th>
                      <td>{$titulo}</td>
                      <td>{$descricao}</td>
                      <td>{$preco}</td>
                      <td>{$cep}</td>
                    </tr>

                    HTML;
                    $contt++;
                  }
                  
                  ?>

                </tbody>
              </table>
        </div>
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="../js/base.js"></script>
</body>
</html>