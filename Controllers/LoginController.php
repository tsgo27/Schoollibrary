<?php

ini_set('session.cookie_secure', 1);  // Se o site usa HTTPS, ativa cookies seguros
ini_set('session.cookie_httponly', 1); // Impede acesso aos cookies via JavaScript

session_start();
require_once __DIR__ . '/../Config/web_database.php';
require_once __DIR__ . '/../Config/verify_csrf.php';

// Gera o token CSRF se ainda não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Função para buscar a matrícula atualizada do usuário
function buscarNovaMatricula($pdo, $idUsuario)
{
    try {
        $stmt = $pdo->prepare("SELECT matricula FROM usuarios WHERE idUsuario = ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchColumn() ?: null;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verifica o token CSRF
        if (!verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Erro ao tentar efetuar login');
        }

        // Sanitização e validação de entrada
        $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);
        $senha = filter_input(INPUT_POST, 'ss', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$matricula || !$senha) {
            throw new Exception('Por favor, preencha todos os campos');
        }

        // Controle de tentativas de login
        $_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? 0;
        $_SESSION['last_attempt_time'] = $_SESSION['last_attempt_time'] ?? time();

        if ($_SESSION['login_attempts'] >= 5 && (time() - $_SESSION['last_attempt_time']) < 300) {
            throw new Exception('Tentativas excedidas. Aguarde 5 minutos.');
        }

        // Busca usuário no banco
        $stmt = $pdo->prepare("SELECT idUsuario, senha, user_status FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($senha, $user['senha'])) {
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            throw new Exception('Matrícula ou senha incorretos');
        }

        if ($user['user_status'] !== 'ativo') {
            throw new Exception('Usuário inativo. Contate o administrador');
        }

        // Login bem-sucedido
        session_regenerate_id(true);
        $_SESSION['idUsuario'] = $user['idUsuario'];
        $_SESSION['matricula'] = buscarNovaMatricula($pdo, $user['idUsuario']) ?? $matricula;

        $_SESSION['login_attempts'] = 0; // Reset de tentativas
        header("Location: ../views/Home.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../views/Login.php');
        exit();
    }
}
