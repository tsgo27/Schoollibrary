<?php
// Verifica se nenhuma sessão foi iniciada. Caso nenhuma sessão esteja ativa, inicia uma nova.
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia uma nova sessão ou retoma a sessão existente.
}

// Regenera o ID da sessão para aumentar a segurança, criando um novo identificador para a sessão atual.
session_regenerate_id(true);

// Remove todas as variáveis de sessão armazenadas. Isso limpa qualquer dado associado à sessão atual.
session_unset();

// Destrói a sessão atual, apagando todas as informações relacionadas à sessão, como cookies e dados armazenados no servidor.
session_destroy();

// Remove o cookie de sessão no navegador para garantir que a sessão será efetivamente destruída do lado do cliente.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Redireciona o usuário para a página de login após a destruição da sessão.
header("Location: ../views/Login.php");

// Garante que o código após o redirecionamento não será executado, encerrando o script.
exit();
?>
