<?php
session_start();

# Verifica se o usuario logou se não volta pra tela de login
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
  $logado = $_SESSION['msg'];
  $iduser = $_SESSION["iduser"];
} else {
  header("Location: formLogin.php");
}

# Estabelece a Conexao banco de dados
require_once("../data/conexao.php");

# Verifica se existe alguma variavel de sessao e se não está vazia
if (isset($_SESSION['mensagem']) && !empty($_SESSION['mensagem'])) {
  $mensagem = $_SESSION['mensagem'];
} else {
  $_SESSION['mensagem'] = null;
};

# Gera o SELECT para mostras todos os dados da tabela Filems
$sql = "SELECT p.* FROM projetos p INNER JOIN login l ON p.iduser = l.id WHERE p.iduser = $iduser";
$resultado = $conexao->query($sql);
$projeto = $resultado->fetchAll(PDO::FETCH_ASSOC);



# Fecha a Conexao banco de dados e destroi as sessoes
unset($conexao);
unset($_SESSION['mensagem']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultar Projetos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    .card-img-top {
      width: 40%;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      position: absolute;
      top: 10px;
      left: 10px;
    }

    .card-body {
      text-align: center;
      position: relative;
      padding-top: 50px;
    }

    .card-title {
      margin-top: 30px;
    }

    .btn-center {
      display: block;
      margin: 20px auto 0;
      width: auto;
      padding: 10px 20px;
    }

    .btn-visualizar {
      background-color: #004A8D;
      color: white;
    }

    .btn-visualizar:hover {
      background-color: #f7941d;
      color: black;
    }

    .btn-github {
      background-color: #f7941d;
      color: black;
    }

    .btn-github:hover {
      background-color: #004A8D;
      color: white;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <img src="../../poster/senac.png" alt="Site" style="height: 80px; width: 100px">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="./formInsert.php">Criar Repositorio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./formSelect.php">Visualizar Projetos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./_logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <hr>
    <div class="row">
      <?php foreach ($projeto as $projeto) { ?>
      <div class="col-sm-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?= $projeto["original_title"] ?></h5>
            <p class="card-text"><?= $projeto["overview"] ?></p>
            <p class="card-text"><small class="text-muted"><?= date('d/m/Y', strtotime($projeto["release_date"])) ?></small></p>
            <a href="<?= $projeto["linkgithub"] ?>" class="btn btn-github btn-center" target="_blank">Link Projeto Github</a>
            <?php if (($projeto["poster_path"] != '')) { ?>
            <a href='../../poster/<?= $projeto["poster_path"] ?>' class="btn btn-visualizar btn-center text-white">Visualizar Imagem Projeto</a>
            <?php } else {
              echo "<p class='text-muted'>Sem Imagem</p>";
            } ?>
            <div class="mt-3">
              <a class="btn btn-lapis" role="button" href="formUpdate.php?id=<?= $projeto["id"] ?>"><i class="bi bi-pencil"></i></a>
              <a class="btn btn-danger" role="button" href="formDelete.php?id=<?= $projeto["id"] ?>"><i class="bi bi-trash3-fill"></i></a>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
