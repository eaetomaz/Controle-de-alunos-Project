<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização cadastral</title>
</head>
<body>
    <?php
include 'menu.html';
include 'verificalogin.php';

verificalogin();

// Verifique se foi enviado um ID de usuário para atualização
if(isset($_GET['id'])) {
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

    // Obtenha o ID do usuário a ser atualizado
    $id = $_GET['id'];

    // Consulta para selecionar os dados do usuário específico
    $sql = "SELECT * FROM alunos WHERE id = $id"; // Substitua "tabela" pelo nome correto da sua tabela

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Formulário para atualização dos dados
        echo '<div class="container container-cadastro"><form action="processa-atualizacao.php" method="post">
                <input type="hidden" name="id" value="'.$row["id"].'">
                Nome: <input type="text" name="nome" value="'.$row["nome"].'"><br>
                Endereço: <input type="text" name="endereco" value="'.$row["endereco"].'"><br>
                Telefone: <input type="text" name="telefone" value="'.$row["telefone"].'"><br>
                Nome de Usuário: <input type="text" name="usuario" value="'.$row["usuario"].'"><br>
                <input type="submit" value="Atualizar">
              </form></div>';
    } else {
        echo "Nenhum usuário encontrado";
    }

    $conn->close();
} else {
    echo "ID de usuário não fornecido";
}
?>

    
</body>
</html>

