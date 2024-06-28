<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login do Sistema</title>
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
      max-width: 100%; /* Para garantir que a imagem não ultrapasse o container */
      height: auto; /* Para manter a proporção da imagem */
      object-fit: contain; /* Ajusta a imagem para caber dentro do espaço do container */
      max-width: 200px; /* Tamanho máximo para desktop */
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

    .formLogin input[type="email"],
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

    .formLogin input[type="email"]:focus,
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
        flex-direction: row;
        align-items: center;
        max-width: 900px;
      }

      .form-content {
        padding: 40px;
      }

      .form-image img {
        max-width: 300px; /* Tamanho máximo para desktop */
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
        <form class="formLogin" action="../../src/pages/_autenticar.php" method="POST">
          <h1>Login Sistema</h1>
          <p>Digite os seus dados de acesso</p>
          <label for="email">E-mail</label>
          <input name="email" type="email" placeholder="Digite seu e-mail" autofocus required>
          <label for="password">Senha</label>
          <input name="password" type="password" placeholder="Digite sua senha" required>
          <input type="submit" value="Logar" class="btn">
          <!-- <div class="mensagem">
            <?= $mensagem ?>
          </div> -->
        </form>
      </div>
    </div>
  </div>
</body>

</html>
