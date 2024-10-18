<?php
session_start();
require_once __DIR__ . '/../Config/web-config.php';
require_once __DIR__ . '/../Config/verify_csrf.php';


// Gera o token CSRF se ainda não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verifica o token CSRF
        if (!verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Erro ao tentar efetuar login');
        }
        function buscarNovaMatricula($pdo, $idUsuario)
        {
            try {
                $stmt = $pdo->prepare("SELECT matricula FROM usuarios WHERE idUsuario = ?");
                $stmt->execute([$idUsuario]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['matricula'];
            } catch (PDOException $e) {
                error_log($e->getMessage());
                $_SESSION['error'] = 'Erro ao tentar acessar o banco de dados';
                header('Location: ../views/Login.php');
                exit();
            }
        }
        $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);
        $senha     = $_POST['ss'];
        if (empty($matricula) || empty($senha)) {
            $_SESSION['error']           = 'Por favor, preencha todos os campos';
            header('Location: ../views/Login.php');
            exit();
        }
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if ($user['user_status'] === 'Ativo') {
                if (password_verify($senha, $user['senha'])) {
                    session_regenerate_id(true);
                    ini_set('session.cookie_httponly', 1);
                    $_SESSION['idUsuario']               = $user['idUsuario'];
                    $_SESSION['matricula']               = $matricula;
                    $novaMatricula = buscarNovaMatricula($pdo, $user['idUsuario']);
                    if ($novaMatricula != $matricula) {
                        $_SESSION['matricula']               = $novaMatricula;
                    }
                    unset($_SESSION['error']);
                    header("Location: ../views/Home.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Matrícula ou senha inválidos';
                    header('Location: ../views/Login.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Sua conta foi desativada, contate o administrador!';
                header('Location: ../views/Login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Acesso negado. Matrícula ou senha inválida';
            header('Location: ../views/Login.php');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../views/Login.php');
        exit();
    }
}
