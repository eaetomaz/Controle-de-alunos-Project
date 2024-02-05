<!DOCTYPE html>
<html>
<head>
    <title>Sistema de alunos - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container container-login">
    <h2>Login</h2>
    <form id="loginForm" action="login.php" method="post">
        <label for="loginUsername">Nome de usuário:</label>
        <input type="text" id="loginUsername" name="loginUsername" required>
        <br>
        <label for="loginPassword">Senha:</label>
        <input type="password" id="loginPassword" name="loginPassword" required>
        <br>
        <input type="submit" value="Login">
    </form>

</div>

</body>
</html>
