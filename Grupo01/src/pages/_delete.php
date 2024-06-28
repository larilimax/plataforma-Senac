<?php
# Inicia as variáveis de sessão
session_start();

# Verifica se o usuário está logado, se não volta para a tela de login
if (!isset($_SESSION['msg']) || empty($_SESSION['msg'])) {
    header("Location: formLogin.php");
    exit(); // Garante que a execução do script pare aqui
}

# Estabelece a conexão com o banco de dados
require_once("../data/conexao.php");

# Verifica se existe o ID do projeto
if (!isset($_POST['id']) || empty($_POST['id'])) {
    $_SESSION['mensagem'] = "ID inválido.";
    header("Location: formSelect.php");
    exit();
} else {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); // Sanitiza o ID
}

#-------------------------------------------------------------------------------
# Exclui o projeto pelo ID
#-------------------------------------------------------------------------------
$sql = "DELETE FROM projetos WHERE id = :id";
$resultado = $conexao->prepare($sql);
$resultado->bindParam(':id', $id, PDO::PARAM_INT); // Define o tipo de dado como INT

try {
    $resultado->execute();
    if ($resultado->rowCount() > 0) {
        $_SESSION['mensagem'] = "Exclusão realizada com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir o projeto.";
    }
} catch (PDOException $e) { 
    $_SESSION['mensagem'] = "Erro: " . $e->getMessage();
}

# Fecha a conexão com o banco de dados
unset($conexao);

# Redireciona para a página de seleção
header("Location: formSelect.php");
exit(); // Garante que a execução do script pare aqui
?>
