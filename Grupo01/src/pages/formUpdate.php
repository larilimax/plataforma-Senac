<?php
# Inicia as variaveis de sessão
session_start();
$_SESSION['mensagem'] = null;
$erro = null;

# Verifica se o usuario logou se não volta pra tela de login
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
  $logado = $_SESSION['msg'];
} else {
  header("Location: formLogin.php");
}

# Estabelece a Conexao banco de dados
require_once("../data/conexao.php");

# verifica se existe o id do projeto
if (!isset($_GET['id'])) {
  $id = null;
} else {
  $id = $_GET['id'];
}

#-------------------------------------------------------------------------------
# Gera o SELECT e FILTRA pelo ID para mostras todos os dados da tabela Filems
#-------------------------------------------------------------------------------
$sql = "SELECT * FROM projetos WHERE id = :id";
$resultado = $conexao->prepare($sql);
$resultado->bindParam(':id', $id);
$resultado->execute();

if ($resultado->rowCount() > 0) {
  $projeto = $resultado->fetch(PDO::FETCH_ASSOC);

  $id = $projeto["id"];
  $original_title = $projeto["original_title"];
  $linkgithub = $projeto["linkgithub"];
  $overview = $projeto["overview"];
  $release_date = $projeto["release_date"];
  $poster_path = $projeto["poster_path"];

  $btnestado = null;
} else {
  $erro = "Não Existe";

  $id = null;
  $linkgithub= null;
  $original_language = null;
  $overview = null;
  $release_date = null;
  $poster_path = null;

  $btnestado = "disabled";
}

# Fecha a Conexao banco de dados e destroi as sessoes
unset($conexao);
unset($_SESSION['mensagem']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atualizar Código</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      margin-top: 30px; /* Adiciona espaçamento acima do conteúdo principal */
    }

    .container h2 {
      font-size: 1.5rem;
      font-weight: 400; /* Define a fonte mais fina */
    }

    .container label {
      font-size: 1rem;
      font-weight: 300; /* Define a fonte mais fina */
    }

    .btn-custom {
      font-size: 1rem;
      font-weight: 400;
      background-color: #004A8D;
      border-color: #004A8D;
      color: white;
    }

    .btn-custom:hover {
      background-color: #003366;
      border-color: #003366;
    }

    .navbar-brand img {
      height: 80px;
      width: 100px;
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
            <a class="nav-link" href="./dashboard.php">Home</a>
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

  <div>
    <h1 class="bg-warning">
      <?= $erro ?>
    </h1>
  </div>
  <div class="container">
    <h2>Atualizar Código</h2>
    <hr>
    <form action="_update.php" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-8">
          <input type="text" name="id" class="form-control" value="<?= $id ?>" hidden>
          <label for="original_title" class="col-sm-8 col-form-label">Nome projeto
            <input type="text" name="original_title" class="form-control" value="<?= $original_title ?>">
          </label><br>

          <label for="overview" class="col-sm-8 col-form-label">Descrição
            <textarea name="overview" class="form-control" rows="5" required><?= $overview ?></textarea>
          </label><br>

          <label for="release_date" class="col-sm-8 col-form-label">Data Lançamento
            <input type="date" name="release_date" class="form-control" value="<?= $release_date ?>" required>
          </label><br>
          <label for="link" class="col-sm-8 col-form-label">Github link
          <input type="url" name="linkgithub" class="form-control" value="<?= $linkgithub ?>" required>
        </label><br>
        </div>
        <div class="col-4">
          <label for="img" class="col-sm-8 col-form-label">Poster
            <div class="">
              <img src="../../poster/<?= $poster_path ?>" name="impPoster" alt="" class="img-thumbnail">
            </div>
          </label><br>
          <label for="poster_path" class="col-sm-8 col-form-label">Carregar Poster
            <input type="file" name="poster_path" class="form-control" accept=".png, .jpg">
          </label><br>
          <input type="text" name="poster_name" value="<?= $poster_path ?>" hidden>
        </div>
        <div class="col-auto mt-4">
          <button type="submit" class="btn btn-custom mb-3" <?= $btnestado ?>>Atualizar Código</button>
        </div>
      </div>
    </form>
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
