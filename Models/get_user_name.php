<?php
/*
* Exibir nome do usuário logado
*
*/

try {
    // Verifica se a matrícula está presente na sessão
    $matricula = $_SESSION['matricula'] ?? null;
    if (!$matricula) {
        header("Location:/schoollibrary/views/Login.php");
        exit();
    }

    // Consulta o nome do usuário no banco de dados
    $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE matricula = ?");
    $stmt->execute([$matricula]);
    $user = $stmt->fetchColumn();

    if (!$user) {
        session_destroy(); // Destroi a sessão para evitar inconsistências
        header("Location:/schoollibrary/views/Login.php");
        exit();
    }

    $userName = $user;
} catch (Exception $e) {
    session_destroy(); // Garante que a sessão será encerrada em caso de erro
    header("Location:/schoollibrary/views/Login.php");
    exit();
}
