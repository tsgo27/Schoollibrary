<?php
// Verifica se nenhuma sessão foi iniciada. Caso nenhuma sessão esteja ativa, inicia uma nova.
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia uma nova sessão ou retoma a sessão existente.
}

if (!isset($_SESSION['idUsuario'])) {
    $loginUrl = '/schoollibrary/views/Login.php';
    header("Location: $loginUrl");
    exit();
}

$idUsuario = $_SESSION['idUsuario'];
?>
