<?php
# Inicia as variaveis de sessão
session_start();
$_SESSION['mensagem'] = null;

# Verifica se o usuario logou se não volta pra tela de login
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
  $logado = $_SESSION['msg'];
  $iduser = $_SESSION["iduser"];
} else {

  header("Location: formLogin.php");
}

# Estabelece a Conexao banco de dados
require_once("../data/conexao.php");



/*
sReferência para tipos Filtros - https://www.w3schools.com/php/php_ref_filter.asp
filter_var() - https://www.w3schools.com/php/php_filter.asp
*/

$original_title = filter_var($_POST["original_title"], FILTER_SANITIZE_SPECIAL_CHARS);
$overview = filter_var($_POST["overview"], FILTER_SANITIZE_SPECIAL_CHARS);
$linkgithub = filter_var($_POST["linkgithub"], FILTER_SANITIZE_SPECIAL_CHARS);
$release_date = filter_var($_POST["release_date"], FILTER_SANITIZE_SPECIAL_CHARS);




//------------------------------------------------------------------------------------------------------------------------
// CODIGO PARA REALIZAR UPLOAD DE IMAGEM  - verifica se variavel existe e se possue um nome de arquivo
//------------------------------------------------------------------------------------------------------------------------
if (isset($_FILES['poster_path']) && !empty($_FILES['poster_path']['name'])) {
  $nameFile = basename($_FILES['poster_path']['name'], $suffix = "jpg"); //Pegando somente o nome do arquivo
  $ext = strtolower(substr($_FILES['poster_path']['name'], -4)); //Pegando extensão do arquivo
  $new_name = hash('md5', $nameFile) . $ext; //Definindo um novo nome para o arquivo
  $dir = '../../poster/'; //Diretório para uploads 
  move_uploaded_file($_FILES['poster_path']['tmp_name'], $dir . $new_name); //Fazer upload do arquivo
} else {

  $new_name = "";
}


//------------------------------------------------------------------------------------------------------------------------
// CODIGO PARA REALIZAR A INSERÇÃO DOS DADOS NO BANCO DE DADOS
//------------------------------------------------------------------------------------------------------------------------
$sql = "INSERT INTO projetos (original_title, overview, release_date, linkgithub, poster_path, iduser)"
  . " VALUES(:original_title,  :overview, :release_date, :linkgithub, :poster_path, :iduser)";

$insert = $conexao->prepare($sql);

$insert->bindParam(':original_title', $original_title);
$insert->bindParam(':overview', $overview);
$insert->bindParam(':release_date', $release_date);
$insert->bindParam(':linkgithub', $linkgithub);
$insert->bindParam(':poster_path', $new_name);
$insert->bindParam(':iduser', $iduser );

# executa o comando de INSERT e verifica se houve alguma alteração no banco de dados
if ($insert->execute() && $insert->rowCount() > 0) {
  # Adiciona a mensagem na sessão  se OK
  $_SESSION['mensagem'] = "Inserção realizada com sucesso!";
  # Redireciona para a pagina de Seleção
  header("Location: formSelect.php");
} else {
  # Adiciona a mensagem na sessão se deu erro
  $_SESSION['mensagem'] = "Ocorreu um problema ao inserir os dados.";
  # Redireciona para a pagina de Seleção
  header("Location: formSelect.php");
}

# Fecha a Conexao banco de dados e destroi as sessoes
unset($conexao);
