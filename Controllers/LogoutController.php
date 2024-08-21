<?php
// Verifica se a sessão já está iniciada; se não estiver, inicia uma nova sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Regenera o ID da sessão para evitar ataques de fixação de sessão
session_regenerate_id(true);

// Remove todas as variáveis da sessão
session_unset();

// Encerra a sessão atual e exclui todos os dados associados a ela
session_destroy();

// Redireciona para a página de login
header("Location: ../views/Login.php");
exit();
?>
