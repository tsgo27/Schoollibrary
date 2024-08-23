<?php
session_start();
require_once __DIR__ . '/../Config/web-config.php';

function buscarNovaMatricula($pdo, $idUsuario) {
    try {
        $stmt = $pdo->prepare("SELECT matricula FROM usuarios WHERE idUsuario = ?");
        $stmt->execute([$idUsuario]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['matricula'];

    } catch (PDOException $e) {
        error_log($e->getMessage()); 
        $_SESSION['error'] = 'Erro ao tentar acessar o banco de dados.';
        header('Location: ../views/Login.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);
    $senha = $_POST['ss'];

    if (empty($matricula) || empty($senha)) {
        $_SESSION['error'] = 'Por favor, preencha todos os campos.';
        header('Location: ../views/Login.php');
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['error'] = 'Erro ao tentar acessar o banco de dados.';
        header('Location: ../views/Login.php');
        exit();
    }

    if ($user) {
        if ($user['user_status'] === 'Ativo') {
            if (password_verify($senha, $user['senha'])) {
                // Regenerar a sessão e definir cookie httponly
                session_regenerate_id(true);
                ini_set('session.cookie_httponly', 1);

                $_SESSION['idUsuario'] = $user['idUsuario'];
                $_SESSION['matricula'] = $matricula;

                $novaMatricula = buscarNovaMatricula($pdo, $user['idUsuario']);
                if ($novaMatricula != $matricula) {
                    $_SESSION['matricula'] = $novaMatricula;
                }

                unset($_SESSION['error']);
                header("Location: ../views/Home.php");
                exit();
            } else {
                $_SESSION['error'] = 'Matrícula ou senha inválidos.';
                header('Location: ../views/Login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Sua conta foi desativada, contate o administrador!';
            header('Location: ../views/Login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Acesso negado. Matrícula ou senha inválidos';
        header('Location: ../views/Login.php');
        exit();
    }   
}
?>
