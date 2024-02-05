<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php   

include "menu.html";

// Verificar se o usuário está logado, caso contrário, redirecionar para a página de login
if (!isset($_SESSION['id'])) {
header("Location: index.php");
exit();
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "masterkey";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error); 
}

// Consulta no conteúdo da tabela 
$consulta = "select * from alunos";

$result = $conn->query($consulta);

if ($result->num_rows > 0) {
    // Exibição dos dados em uma tabela
    echo "<table border='1' class='container container-listagem'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Usuário</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["nome"]."</td>
                <td>".$row["endereco"]."</td>
                <td>".$row["telefone"]."</td>
                <td>".$row["usuario"]."</td>
                <td><a href='atualiza-cadastro.php?id=".$row["id"]."'>Atualizar</a></td>
                <td><a href='excluir-cadastro.php?id=".$row["id"]."&confirmacao=true' onclick='return confirmarExclusao();'>Excluir</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado";
}

$conn->close();
?>


<script>
function confirmarExclusao() {
    return confirm("Tem certeza que deseja excluir este usuário?");
}
</script>

</body>
</html>
