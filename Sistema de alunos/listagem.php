<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem</title>
</head>
<body>
    
<?php
include 'menu.html';

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
?>

<div class='container container-listagem'>

<?php

// Consulta no conteúdo da tabela 
$consulta = "SELECT * FROM alunos";
$result = $conn->query($consulta);

if ($result->num_rows > 0) {
    echo "<ul>";

    while ($row = $result->fetch_assoc()) {
        echo "

        <li>
        
            <div class='dados'>
                <a href='atualiza-cadastro.php?id={$row["id"]}&nome={$row["nome"]}&endereco={$row["endereco"]}&telefone={$row["telefone"]}&usuario={$row["usuario"]}'>
                    <span class='titulo-item-listagem'>
                        {$row["nome"]}
                    </span> <br>
                    <div class='descricao-item-listagem'>
                        <ul>
                            <li>Telefone: {$row["telefone"]}</li>
                            <li>Endereço: {$row["endereco"]}</li>
                            <li>Usuário: {$row["usuario"]}</li>
                        </ul>
                    </div>
                </a>
            </div>

            <div class='icone-lista'>
                <a href='excluir-cadastro.php?id={$row["id"]}' onclick=\"return confirm('Tem certeza que deseja excluir {$row["nome"]}?'); return false;\">
                    <img src='imagens/excluir.png' alt='Excluir'>
                </a>
            </div>
        </li>";
    }

    echo "</ul>";
} else {
    echo "Nenhum usuário encontrado";
}

$conn->close();
?>

    </body>
</html>
