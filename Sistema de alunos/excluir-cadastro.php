<?php
// Conectar ao banco de dados (substitua pelos seus dados)
$servername = "localhost";
$username = "root";
$password = "masterkey";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verificar se foi enviado um formulário via método GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Obter o ID do usuário a ser excluído
    $idUsuario = $_GET['id'];

    // Query SQL para excluir o usuário da tabela (substitua "tabela" pelo nome correto da sua tabela)
    $sql = "DELETE FROM alunos WHERE id = $idUsuario";

    if ($conn->query($sql) === TRUE) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro na exclusão: " . $conn->error;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Se a confirmação ainda não foi recebida, redirecione para a mesma página com a confirmação
    $idUsuario = $_GET['id'];
    header("Location: excluir-cadastro.php?id=$idUsuario&confirmacao=true");
} else {
    echo "Erro: parâmetros inválidos";
}

$conn->close();
?>
