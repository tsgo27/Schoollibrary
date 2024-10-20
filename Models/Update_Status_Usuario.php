<?php
session_start();
require_once __DIR__ . '/../Config/web_extends.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recebendo os dados do formulário
        $matricula = htmlspecialchars(filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $novoStatus = htmlspecialchars(filter_input(INPUT_POST, 'novo_status'), ENT_QUOTES, 'UTF-8');

        // Verificar se o usuário existe no banco de dados
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $_SESSION['error'] = 'Usuário não encontrado.';
            header('Location: /schoollibrary/views/Login.php');
            exit();
        }

        // Atualizar o status do usuário no banco de dados
        $stmt = $pdo->prepare("UPDATE usuarios SET user_status = ? WHERE matricula = ?");
        $stmt->execute([$novoStatus, $matricula]);

        $_SESSION['success'] = 'Status do usuário atualizado com sucesso.';
        echo 'success'; // Resposta de sucesso
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Erro ao atualizar o status do usuário: ' . $e->getMessage();
        echo 'error'; // Resposta de erro
        exit();
    }
} else {
    header('Location: /schoollibrary/views/Login.php');
    exit();
}
?>
