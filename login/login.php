<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $database = "saep_db";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT password FROM users WHERE username = '$user'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user;
            header("Location: menu.php");
            exit;
        } else {
            $error = "Senha incorreta.";
        }
    } else {
        $error = "Usuário não encontrado.";
    }
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Funcionário</title>
      <link rel="stylesheet" href="./login.css">
    
</head>

<body>
    <!--NAVBAR-->
    <ul>
    <li class="menu"><a href="">Menu</a></li>
    <li class="login"><a href="">Login</a></li>
    <li class="cadastroo"><a href="">Cadastro de produtos</a></li>
    <li class="movimentacao"><a href="">Cadastro movimentação</a></li>
    <li class="estoque"><a href="">Estoque</a></li>
    <li class="login"><img src="../imagens/people.png" id="icone-usuario"></li>
    </ul>
    
       <!--CARD GRANDE-->
       <div class="cards">
       <!--CARD CONTAINER PARA IMAGEM/CARD FICAREM JUNTOS-->
        <div class="form-container">
            <!--FORMULARIO LOGIN-->
            <form id="formulario-login">
            <!--DIV PARA O CARD COM INPUT-->
            <div class="loginn">
            <label for="nome-input">Nome:</label>
            <input type="text" name="name" id="nome-input">

            <label for="email-input">E-mail:</label>
            <input type="email" name="email" id="email-input">

            <label for="senha-input">Senha:</label>
            <input type="password" name="senha" id="senha-input" required>

             <button type="submit" id="btn-login">ENTRAR</button>
            </div>  
        </form></div>
       </div>



       <!--INFORMAÇÕES DO USUARIO-->
       <div id="info-usuario" class="info-painel"> 
        <p>Nome: <span id="display-nome"></span></p>
        <p>E-mail: <span id="display-email"></span></p>
        </div>
        
        
    <script src="./login.js"></script>

    
</body>
</html>