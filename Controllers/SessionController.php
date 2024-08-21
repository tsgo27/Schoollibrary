<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idUsuario'])) {
    // Redirecionar para página de login
    $loginUrl = '/schoollibrary/views/Login.php';
    header("Location: $loginUrl");
    exit();
}

$idUsuario = $_SESSION['idUsuario'];
?>
