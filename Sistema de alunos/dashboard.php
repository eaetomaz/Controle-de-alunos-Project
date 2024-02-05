<?php
include 'menu.html';
include 'verificalogin.php';

verificalogin();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<?php if ($_SESSION['username'] === 'admin') : ?>
        <p>Bem-vindo, administrador!</p>
    <?php else : ?>
        <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
    <?php endif; ?>
</body>
</html>
