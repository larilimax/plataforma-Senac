<?php
# Inicia as variáveis de sessão
session_start();
$_SESSION['mensagem'] = null;
$erro = null;

# Verifica se o usuário está logado, se não volta para a tela de login
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    $logado = $_SESSION['msg'];
} else {
    header("Location: formLogin.php");
    exit(); // Adicionado exit() para garantir que a execução do script pare aqui
}

# Estabelece a Conexão banco de dados
require_once("../data/conexao.php");

# verifica se existe o id do projeto
if (!isset($_GET['id'])) {
    $id = null;
} else {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); // Sanitização do ID
}

#-------------------------------------------------------------------------------
# Gera o SELECT e FILTRA pelo ID 
#-------------------------------------------------------------------------------
$sql = "SELECT * FROM projetos WHERE id = :id"; // Corrigido para o nome correto da tabela
$resultado = $conexao->prepare($sql);
$resultado->bindParam(':id', $id, PDO::PARAM_INT); // Especificar o tipo de dado como INT
$resultado->execute();

if ($resultado->rowCount() > 0) {
    $projeto = $resultado->fetch(PDO::FETCH_ASSOC); // Corrigido para $projeto

    $id = $projeto["id"];
    $title = $projeto["original_title"];
    $btnestado = null;
} else {
    $erro = "Não Existe";
    $id = null;
    $title = null;
    $btnestado = "disabled";
}

# Fecha a Conexão banco de dados e destrói as sessões
unset($conexao);
unset($_SESSION['mensagem']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Repositório</title>
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
                        <a class="nav-link" href="./formCadLogin.php">Cadastrar Login</a>
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
            <h2>DELETAR REPOSITÓRIO</h2>
            <hr>

            <?php if ($erro): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($erro) ?>
            </div>
            <?php endif; ?>

            <form action="_delete.php" method="POST">
                <input type="text" name="id" class="form-control" value="<?= htmlspecialchars($id) ?>" hidden>

                <label for="title" class="col-sm-8 col-form-label">Título
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($title) ?>" required>
                </label><br>

                <div class="col-auto mt-4">
                    <button type="submit" class="btn btn-custom mb-3" <?= $btnestado ?>>Excluir</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
