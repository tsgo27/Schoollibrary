<?php
// Verifica se nenhuma sessão foi iniciada. Caso nenhuma sessão esteja ativa, inicia uma nova.
if (session_status() == PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true, // Impede o acesso do cookie via JavaScript.
        'cookie_secure' => isset($_SERVER['HTTPS']), // Assegura que o cookie seja transmitido apenas em conexões seguras.
        'cookie_samesite' => 'Strict' // Evita que o cookie seja enviado em solicitações de terceiros.
    ]);
}

// Verifica e registra o User-Agent e o IP para vincular a sessão ao dispositivo original.
if (!isset($_SESSION['user_agent']) || !isset($_SESSION['user_ip'])) {
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
} else {
    if ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] || $_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) {
        // Se houver discrepância, destruir a sessão.
        session_unset();
        session_destroy();
        $loginUrl = '/schoollibrary/views/Login.php';
        header("Location: $loginUrl");
        exit();
    }
}

// Regenera o ID da sessão para aumentar a segurança.
session_regenerate_id(true);

if (!isset($_SESSION['idUsuario'])) {
    $loginUrl = '/schoollibrary/views/Login.php';
    header("Location: $loginUrl");
    exit();
}

$idUsuario = $_SESSION['idUsuario'];
?>
