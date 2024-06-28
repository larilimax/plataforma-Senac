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

# Estabelece a Conexao banco de dados
require_once("../data/conexao.php");

/*
sReferência para tipos Filtros - https://www.w3schools.com/php/php_ref_filter.asp
filter_var() - https://www.w3schools.com/php/php_filter.asp
*/

$email = filter_var(trim($_POST["email"], FILTER_SANITIZE_SPECIAL_CHARS));
$password = filter_var(trim($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS));


//------------------------------------------------------------------------------------------------------------------------
// CODIGO PARA REALIZAR A INSERÇÃO DOS DADOS NO BANCO DE DADOS
//------------------------------------------------------------------------------------------------------------------------
$sql = "INSERT INTO login (email, password) VALUES(:email, :password)";

$insert = $conexao->prepare($sql);

$insert->bindParam(':email', $email);
$insert->bindParam(':password', $password);

# executa o comando de INSERT e verifica se houve alguma alteração no banco de dados
if ($insert->execute() && $insert->rowCount() > 0) {
  # Adiciona a mensagem na sessão  se OK
  $_SESSION['mensagem'] = "Inserção realizada com sucesso!";
  # Redireciona para a pagina de Seleção
  header("Location: formLogin.php");
} else {
  # Adiciona a mensagem na sessão se deu erro
  $_SESSION['mensagem'] = "Ocorreu um problema ao inserir os dados.";
  # Redireciona para a pagina de Seleção
  header("Location: formCadLogin.php");
}

# Fecha a Conexao banco de dados e destroi as sessoes
unset($conexao);