<?php

# Variáveis para acessar o do Banco de Dados
#---------------------------------------------------------------------------------------------------------
$db_host = 'localhost';
$db_nome = 'grupo_1';
$db_user = 'root';
$db_senha = '';

try {
  $conexao = new PDO("mysql:host=$db_host; dbname=$db_nome; charset=utf8", $db_user, $db_senha);
} catch (PDOException $e) {
  echo 'Erro ao conectar com o Banco de Dados: ' . $e->getMessage();
}