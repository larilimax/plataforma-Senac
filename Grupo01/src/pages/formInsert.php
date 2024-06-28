<?php
# Inicia as variaveis de sessão
session_start();
$_SESSION['mensagem'] = null;

# Verifica se o usuario logou se não volta pra tela de login
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
  $logado = $_SESSION['msg'];
} else {
  header("Location: formLogin.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inserir Repositorio</title>
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

  <div class="container">
    <div class="row offset-md-2">
      <h2>INSERIR REPOSITORIO</h2>
      <hr>

      <form action="_insert.php" method="POST" enctype="multipart/form-data">

        <label for="original_title" class="col-sm-8 col-form-label">Nome projeto
          <input type="text" name="original_title" class="form-control" autofocus="true" required>
        </label><br>

        <label for="release_date" class="col-sm-8 col-form-label">Data da postagem
          <input type="date" name="release_date" class="form-control" required>
        </label><br>

        <label for="poster_path" class="col-sm-8 col-form-label">Visualizar site
          <input type="file" name="poster_path" class="form-control" accept=".png, .jpg">
        </label><br>

        <label for="link" class="col-sm-8 col-form-label">Github link
          <input type="url" name="linkgithub" class="form-control" required>
        </label><br>

        <label for="overview" class="col-sm-8 col-form-label">Descrição
          <textarea name="overview" class="form-control" rows="5" maxlength="40" required></textarea>
          <small id="charCount" class="form-text text-muted">0/40 caracteres</small>
        </label><br>

        <div class="col-auto mt-4">
          <button type="submit" class="btn btn-custom mb-3">Adicionar projeto</button>
          <?php if (!empty($_POST['link'])) { ?>
          <a href="<?= $_POST['link'] ?>" class="btn btn-primary">Link</a>
          <?php } ?>
        </div>

      </form>
      
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const textarea = document.querySelector('textarea[name="overview"]');
    const charCount = document.getElementById('charCount');

    textarea.addEventListener('input', () => {
      charCount.textContent = `${textarea.value.length}/40 caracteres`;
    });
  </script>
</body>

</html>
