<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// Registra no log o tipo de requisição (POST) e a URL acessada
logMessage("Requisição recebida: " . $_SERVER['REQUEST_METHOD'] . " - " . $_SERVER['REQUEST_URI'], $_REQUEST);


// Gera o token CSRF se ainda não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verifica o token CSRF
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Token CSRF inválido');
        }


        // Filtrando os dados do formulário
        $autor = htmlspecialchars(filter_input(INPUT_POST, 'addAutor', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'addStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Query de inserção na tabela 'autor'
        $sql = "INSERT INTO Autor (nome_autor, status_autor, data_registro) VALUES (:autor, :status, NOW())";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração de inserção: " . implode(" | ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros com os valores
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

    } catch (Exception $e) {
        logMessage("Erro ao processar autor: " . $e->getMessage());
        echo "Erro ao inserir autor. Consulte o suporte técnico.";
        exit();

    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
