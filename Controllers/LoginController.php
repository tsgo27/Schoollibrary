<?php
// Define opções de segurança para cookies
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);

session_start();
require_once __DIR__ . '/../Config/web_database.php';
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

        // Função para buscar nova matrícula
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

        // Sanitização e Validação de Entrada: Matrícula e Senha
        $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);
        $senha     = filter_input(INPUT_POST, 'ss', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($matricula) || empty($senha)) {
            $_SESSION['error'] = 'Por favor, preencha todos os campos';
            header('Location: ../views/Login.php');
            exit();
        }

        // Limitar tentativas de login com bloqueio por tempo
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = time();
        }

        if ($_SESSION['login_attempts'] >= 5) {
            $time_since_last_attempt = time() - $_SESSION['last_attempt_time'];
            if ($time_since_last_attempt < 300) { // 5 minutos
                $_SESSION['error'] = 'Tentativas excedidas.  Aguarde 5 minutos.';
                header('Location: ../views/Login.php');
                exit();
            } else {
                $_SESSION['login_attempts'] = 0; // Reset attempts after timeout
            }
        }

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['user_status'] === 'Ativo') {
                if (password_verify($senha, $user['senha'])) {
                    session_regenerate_id(true);
                    $_SESSION['idUsuario'] = $user['idUsuario'];
                    $_SESSION['matricula'] = $matricula;
                    $novaMatricula = buscarNovaMatricula($pdo, $user['idUsuario']);
                    if ($novaMatricula != $matricula) {
                        $_SESSION['matricula'] = $novaMatricula;
                    }
                    unset($_SESSION['error']);
                    $_SESSION['login_attempts'] = 0; // Reset login attempts on successful login
                    header("Location: ../views/Home.php");
                    exit();
                } else {
                    $_SESSION['login_attempts']++;
                    $_SESSION['last_attempt_time'] = time();
                    $_SESSION['error'] = 'Matrícula ou senha incorretos';
                    header('Location: ../views/Login.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Usuário inativo';
                header('Location: ../views/Login.php');
                exit();
            }
        } else {
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            $_SESSION['error'] = 'Matrícula ou senha incorretos';
            header('Location: ../views/Login.php');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../views/Login.php');
        exit();
    }
}
