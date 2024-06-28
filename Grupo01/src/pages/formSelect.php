<?php
# Inicia as variaveis de sessão
session_start();
 
# Verifica se o usuario logou se não volta pra tela de login
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
  $logado = $_SESSION['msg'];
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
 
 
#-------------------------------------------------------------------------------
# Gera o SELECT para mostras todos os dados da tabela Filems
#-------------------------------------------------------------------------------
$sql = "SELECT * FROM projetos";
$resultado = $conexao->query($sql);
$projetos = $resultado->fetchAll(PDO::FETCH_ASSOC);
 
 
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
            <a class="nav-link" href="./formInsert.php">Criar Repositorio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./_logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 
  <hr>
  <div>
    <?php if (isset($mensagem)) { ?>
    <h3 class="alert alert-success">
      <?= $mensagem ?>
    </h3>
    <?php } ?>
  </div>
 
  <table class="table table-striped">
    <tr>
      <th>projeto</th>
      <th>GitHub</th>
      <th>Descrição</th>
      <th></th>
    </tr>
    <?php foreach ($projetos as $projeto) { ?>
    <tr>
     
      <td><?= $projeto["original_title"] ?></td>
      <td><?= $projeto["linkgithub"] ?></td>
      <td><?= $projeto["overview"] ?></td>
      <td><?= date('d/m/Y', strtotime($projeto["release_date"])) ?></td>
      <td>
 
 
        <?php if (($projeto["poster_path"] != '')) { ?>
        <a href='../../poster/<?= $projeto["poster_path"] ?>'>Visualizar</a>
        <?php } else {
            echo "Sem Imagem";
          } ?>
 
      </td>
      <td>
        <a class="btn btn-warning" role="button" href="formUpdate.php?id=<?= $projeto["id"] ?>"><i
            class="bi bi-pencil"></i></a>
        <a class="btn btn-danger" role="button" href="formDelete.php?id=<?= $projeto["id"] ?>"><i
            class=" bi bi-trash3-fill"></i></a>
      </td>
    </tr>
    <?php } ?>
 
  </table>
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
 
</html>