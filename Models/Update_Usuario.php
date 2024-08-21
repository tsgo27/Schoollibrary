<?php
session_start();
require_once __DIR__ . '/../Config/web-extends.php';
require_once __DIR__ . '/../Config/verify_csrf.php';

/** @var PDO $pdo */

// Gera o token CSRF se ainda não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verifica o token CSRF
        if (!verify_csrf_token($_POST['csrf_token'])) {
            echo '<script>alert("Token CSRF inválido."); window.location.href = document.referrer;</script>';
            exit();
        }
        // Obtém e filtra os dados do formulário Editar
        $idUsuario = htmlspecialchars(filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $matricula = htmlspecialchars(filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $nome = htmlspecialchars(filter_input(INPUT_POST, 'editarNome', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $telefone = htmlspecialchars(filter_input(INPUT_POST, 'editarTelefone', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars(filter_input(INPUT_POST, 'editarEmail', FILTER_VALIDATE_EMAIL), ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars(filter_input(INPUT_POST, 'editarTipoUser', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE usuarios SET matricula = :matricula, nome = :nome, telefone = :telefone, email = :email, user_tipo = :tipo WHERE idUsuario = :idUsuario";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração: " . $pdo->errorInfo()[2]);
        }

        // Vincula os parâmetros com os valores
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tipo', $tipo);

        // Executa a query de atualização
        if ($stmt->execute()) {
            // Redireciona o usuário para a página de edição
            header("Location: http://localhost/schoollibrary/views/Usuarios.php");
            exit();
        } else {
            throw new Exception("Erro na atualização");
        }
        
    } catch (PDOException $e) {
        // Tratar exceções de conexão PDO
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        exit();
        
    } catch (Exception $e) {
        // Tratar outras exceções
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
        
    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
?>
