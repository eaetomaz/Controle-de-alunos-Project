<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function verificalogin() {
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit();
    }
}
?>