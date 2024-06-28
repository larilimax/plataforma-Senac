<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa; /* Cor de fundo suave */
            margin: 0;
            padding: 0;
            color: #333; /* Cor geral do texto */
        }

        .container {
            margin-top: 50px; /* Adiciona espaçamento acima do conteúdo principal */
            text-align: center; /* Centraliza o conteúdo */
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

        h1, h2, h3, h4, h5, h6 {
            font-weight: bold; /* Deixa os títulos em negrito */
            color: #004A8D; /* Cor dos títulos */
        }

        p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            color: #666; /* Cor dos parágrafos */
        }

        .features {
            margin-top: 50px;
        }

        .feature {
            margin-bottom: 30px;
        }

        .feature i {
            font-size: 3rem;
            color: #004A8D;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 20px;
            padding: 10px 0;
            background-color: #004A8D;
            color: white;
            text-align: center;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column; /* Alinha os itens verticalmente */
            justify-content: center;
            align-items: center;
        }

        .footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer img {
            height: 25px; /* Tamanho do ícone */
            width: 25px; /* Tamanho do ícone */
            margin: 0 5px; /* Espaçamento entre os ícones */
        }

        .footer p {
            margin: 5px 0;
            color: white; /* Cor do texto do footer */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body> 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <img src="./poster/senac.png" alt="Site" style="height: 80px; width: 100px">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="./src/pages/formCadLogin.php">Cadastrar Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./src/pages/formLogin.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <img src="./poster/senacFundo.png" class="img-fluid"> <!-- Adiciona a classe img-fluid para tornar a imagem responsiva -->
    <div class="container">
        <h1>Junte-se a nós e comece a explorar hoje mesmo!</h1>
        <p>Seja você um iniciante entusiasmado ou um programador experiente em busca de novidades, a Plataforma Senac é o seu destino para descobrir e compartilhar códigos em diversas linguagens. Junte-se a uma comunidade vibrante, onde você pode</p>

        <div class="row features">
            <div class="col-md-4 feature">
                <i class="fas fa-code"></i>
                <h3>Contribuir e Aprender</h3>
                <p>Compartilhe seus próprios códigos e soluções, ajudando outros desenvolvedores a aprender e crescer na programação.</p>
            </div>
            <div class="col-md-4 feature">
                <i class="fas fa-users"></i>
                <h3>Colaboração em Equipe</h3>
                <p>Trabalhe junto com sua equipe e acompanhe o progresso.</p>
            </div>
            <div class="col-md-4 feature">
                <i class="fas fa-tools"></i>
                <h3>Expandir suas Habilidades</h3>
                <p>Encontre soluções criativas e novas técnicas, tudo em um ambiente colaborativo e amigável.</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <img src="./poster/pipa.png">
        <p>&copy; 2024 Sistema de Projetos.</p>
        <p>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
            <a href="#"><i class="fab fa-github-square"></i></a>
            <a href="#"><i class="fab fa-s3schools-square"></i></a>
        </p> 
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
