<?php
session_start();

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
    $loginUsername = $_POST["loginUsername"];
    $loginPassword = $_POST["loginPassword"];

    $usuariopadrao = 'admin';
    $senhapadrao = 'admin';

    if ($loginUsername === $usuariopadrao && $loginPassword === $senhapadrao) {
        $_SESSION["id"] = 1; // Defina o ID do usuário padrão
        $_SESSION["username"] = $usuariopadrao;

        header('Location: dashboard.php'); // Redirecionar para a página de dashboard após o login bem-sucedido
        exit();
    }

    // Procurar usuário na tabela alunos
    $sql = "SELECT id, usuario, senha FROM alunos WHERE usuario = '$loginUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $saved_password = $row["senha"]; // Obtendo a senha salva no banco (sem criptografia)
        if ($loginPassword === $saved_password) { // Comparação direta das senhas (sem criptografia)
            echo "Login bem-sucedido!";
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["usuario"];

            // Redirecionar para a página de dashboard após o login bem-sucedido
            header('Location: dashboard.php');
            exit(); // Terminar a execução do script após o redirecionamento
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $conn->close();
}
?>
