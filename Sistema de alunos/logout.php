<?php

function logout() {

session_start();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login ou outra página após o logout
header("Location: index.php");
exit();
    
    }
?>
