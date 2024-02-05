<?php

include 'verificalogin.php';
verificalogin();

// Verifique se foi enviado um formulário via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obter os dados enviados pelo formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $usuario = $_POST['usuario'];

    // Query SQL para atualizar os dados do usuário na tabela (substitua "tabela" pelo nome correto da sua tabela)
    $sql = "UPDATE alunos SET nome='$nome', endereco='$endereco', telefone='$telefone', usuario='$usuario' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Dados atualizados com sucesso!";
        header('Location: listagem.php');
    } else {
        echo "Erro na atualização: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Erro: método incorreto de envio de dados";
}
?>
