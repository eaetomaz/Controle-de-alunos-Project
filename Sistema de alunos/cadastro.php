<?php
include 'menu.html';

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirecionar se não estiver logado
    exit();
}

// Verificar se o usuário logado é o admin
if ($_SESSION['username'] !== 'admin') {
    echo "Acesso restrito! Você não tem permissão para acessar esta página.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados (substitua os valores pelos seus dados)
    $servername = "localhost";
    $username = "root";
    $password = "masterkey";
    $dbname = "php";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Obter dados do formulário
    $username = $_POST["username"];
    $password = $_POST["password"]; // A senha será salva sem criptografia
    $nome = $_POST["nome"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];

    // Inserir dados na tabela alunos
    $sql = "INSERT INTO alunos (usuario, nome, endereco, telefone, senha) VALUES ('$username', '$nome', '$endereco', '$telefone', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro no cadastro: " . $conn->error;
    }

    $conn->close();
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<script>
        // Verificar se o usuário está logado
        var id = "<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>";
        var username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";

        if (!id || username !== 'admin') {
            alert("Acesso restrito! Você não tem permissão para acessar esta página.");
            window.location.href = 'dashboard.php'; // Redireciona para a página de login
        }
    </script>
<div class="container container-cadastro">
    <form id="cadastroForm" action="cadastro.php" method="post">
        <label for="nome">Nome completo:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>
        <br>
        <label for="telefone">Telefon/Celular:</label>
        <input type="text" id="telefone" name="telefone" required>
        <br>
        <label for="username">Nome de usuário:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
    </div>

</body>
</html>
