<?php
# Inicia as variaveis de sessão
session_start();

# Verifica se existe alguma variavel de sessao e se não está vazia
if (isset($_SESSION['mensagem']) && !empty($_SESSION['mensagem'])) {
  $mensagem = $_SESSION['mensagem'];
} else {
  $_SESSION['mensagem'] = null;
};


 ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Login</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;1,200&display=swap');
    
    body {
      background: #003366;
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 100vh;
      padding: 20px;
      box-sizing: border-box;
    }

    .form-container {
      background: white;
      border-radius: 10px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      max-width: 500px;
      width: 100%;
    }

    .form-image {
      width: 100%;
      display: flex;
      justify-content: center;
      padding: 20px;
    }

    .form-image img {
      width: 100px; /* Aumenta um pouco o tamanho da imagem */
      height: auto;
      object-fit: cover;
    }

    .form-content {
      padding: 20px;
      width: 100%;
      text-align: center;
    }

    .formLogin {
      width: 100%;
    }

    .formLogin h1 {
      font-size: 24px;
      margin-bottom: 15px;
      color: #333;
      font-weight: 500;
    }

    .formLogin p {
      margin-bottom: 15px;
      color: #666;
      font-size: 14px;
    }

    .formLogin label {
      display: block;
      margin-bottom: 5px;
      color: #333;
      text-align: left;
      font-size: 14px;
      font-weight: 400;
      padding-left: 20px;
    }

    .formLogin input[type="text"],
    .formLogin input[type="password"] {
      width: calc(100% - 40px);
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 14px;
      margin-left: 20px;
      margin-right: 20px;
    }

    .formLogin input[type="text"]:focus,
    .formLogin input[type="password"]:focus {
      border-color: #004A8D;
      outline: none;
    }

    .formLogin .btn {
      width: calc(100% - 40px);
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #004A8D;
      color: white;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-bottom: 10px;
      font-weight: 500;
      margin-left: 20px;
      margin-right: 20px;
    }

    .formLogin .btn:hover {
      background-color: #003366;
    }

    .mensagem {
      color: red;
      margin-top: 15px;
    }

    @media (min-width: 768px) {
      .form-container {
        flex-direction: column;
        align-items: center;
      }

      .form-content {
        padding: 40px;
      }

      .formLogin .btn {
        width: calc(50% - 10px);
        display: inline-block;
        margin-right: 10px;
      }

      .formLogin .btn:last-child {
        margin-right: 0;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="form-container">
      <div class="form-image">
        <img src="../../poster/senac.png" alt="Senac Logo">
      </div>
      <div class="form-content">
        <form class="formLogin" action="_cadastrarLogin.php" method="POST">
          <h1>Cadastrar Login</h1>
          <p>Preencha os campos para cadastrar um novo login</p>
          <label for="email">Email</label>
          <input type="text" name="email" placeholder="Digite seu e-mail" autofocus="true" required>
          <label for="password">Senha</label>
          <input type="text" name="password" placeholder="Digite sua senha" required>
          <button type="submit" class="btn">Cadastrar</button>
        
          <!-- <div class="mensagem">
            <?php if (isset($mensagem)) { ?>
              <h3 class="alert alert-success"><?= $mensagem ?></h3>
            <?php } ?>
          </div> -->
        </form>
      </div>
    </div>
  </div>
</body>

</html>
