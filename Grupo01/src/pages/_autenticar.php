<?php
session_start();
$_SESSION['mensagem'] = '';

#conexao com o Banco de dados
require_once("../data/conexao.php");

# verifica se esta recebendo os dados
// var_dump($_POST);
// die;

# recebe os dados pelo metodo POST e realiza a filtragem para prevenir o SQl Injection e XSS injection
// $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
// $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);


// if ($email == 'admin@email.com' && $password == '123456') {

//   $_SESSION['msg'] = 'LOGADO';
//   header("Location: dashboard.php");
// } else {
//   $_SESSION['mensagem'] = "Usuário ou Senha Inválido!";
//   header("Location: formLogin.php");
// }

if (isset(($_POST['email'])) && isset($_POST['password'])) {

  $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);


  $sql = "SELECT * FROM login WHERE email = :email";
  $dados = $conexao->prepare($sql);
  $dados->bindParam(':email', $email);
  $dados->execute();

  if ($dados->rowCount() > 0) {
    $login = $dados->fetch(PDO::FETCH_ASSOC);

    if ($login['email'] == $email && $login['password'] == $password) {
      $_SESSION['msg'] = 'LOGADO';
      $_SESSION['iduser'] = $login['id'];
      header("Location: dashboard.php");
    } else {
      $_SESSION['mensagem'] = "Usuário ou Senha Inválido!";
      header("Location: formLogin.php");
    }
  } else {
    $_SESSION['mensagem'] = "Usuário ou Senha Inválido!";
    header("Location: formLogin.php");
  }
}