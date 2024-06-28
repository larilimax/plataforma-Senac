<?php
session_start();
$_SESSION['mensagem'] = null;

# Verifica se o usuario logou, se não volta pra tela de login
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    $logado = $_SESSION['msg'];
} else {
    header("Location: formLogin.php");
    exit();
}

# Estabelece a Conexao banco de dados
require_once("../data/conexao.php");

# Sanitização dos dados recebidos do POST
$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
$original_title = filter_var($_POST["original_title"], FILTER_SANITIZE_STRING);
$linkgithub = filter_var($_POST["linkgithub"], FILTER_SANITIZE_URL);
$overview = filter_var($_POST["overview"], FILTER_SANITIZE_STRING);
$release_date = filter_var($_POST["release_date"], FILTER_SANITIZE_STRING);
$poster_name = filter_var($_POST['poster_name'], FILTER_SANITIZE_STRING);

# Código para realizar upload de imagem - verifica se variavel existe e se possui um nome de arquivo
if (isset($_FILES['poster_path']) && !empty($_FILES['poster_path']['name'])) {
    $nameFile = pathinfo($_FILES['poster_path']['name'], PATHINFO_FILENAME); // Nome do arquivo sem extensão
    $ext = strtolower(pathinfo($_FILES['poster_path']['name'], PATHINFO_EXTENSION)); // Extensão do arquivo
    $new_name = hash('md5', $nameFile) . '.' . $ext; // Definindo um novo nome para o arquivo
    $dir = '../../poster/'; // Diretório para uploads 

    if (!is_dir($dir)) {
        mkdir($dir, 0755, true); // Cria o diretório se não existir
    }

    move_uploaded_file($_FILES['poster_path']['tmp_name'], $dir . $new_name); // Fazer upload do arquivo
} else {
    $new_name = $poster_name;
}

# Código para realizar a inserção dos dados no banco de dados
$sql = "UPDATE projetos SET original_title = :original_title, overview = :overview, linkgithub = :linkgithub, release_date = :release_date, poster_path = :poster_path WHERE id = :id";
$update = $conexao->prepare($sql);

$update->bindParam(':id', $id, PDO::PARAM_INT);
$update->bindParam(':original_title', $original_title, PDO::PARAM_STR);
$update->bindParam(':overview', $overview, PDO::PARAM_STR);
$update->bindParam(':linkgithub', $linkgithub, PDO::PARAM_STR);
$update->bindParam(':release_date', $release_date, PDO::PARAM_STR);
$update->bindParam(':poster_path', $new_name, PDO::PARAM_STR);

# Executa o comando de UPDATE e verifica se houve alguma alteração no banco de dados
if ($update->execute()) {
    # Adiciona a mensagem na sessão se OK
    $_SESSION['mensagem'] = "Alteração realizada com sucesso!";
    # Redireciona para a pagina de Seleção
    header("Location: formSelect.php");
    exit();
} else {
    # Adiciona a mensagem na sessão se deu erro
    $_SESSION['mensagem'] = "Ocorreu um problema ao alterar os dados.";
    # Redireciona para a pagina de Seleção
    header("Location: formSelect.php");
    exit();
}

# Fecha a Conexao banco de dados e destroi as sessoes
unset($conexao);
?>
