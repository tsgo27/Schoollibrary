<?php
require_once __DIR__ . '/../Config/bootstrap.php';



// Gera o token CSRF se ainda não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verifica o token CSRF
        if (!verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Token CSRF inválido');
        }

        // Obtém e filtra os dados do formulário Autor
        $codAutor = htmlspecialchars(filter_input(INPUT_POST, 'codAutor', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $autor = htmlspecialchars(filter_input(INPUT_POST, 'editaAutor', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $statusAutor = htmlspecialchars(filter_input(INPUT_POST, 'editaStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE autor SET NomeAutor = :autor, StatusAutor = :statusAutor WHERE codAutor = :codAutor";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração: " . $pdo->errorInfo()[2]);
        }

        // Vincula os parâmetros com os valores
        $stmt->bindValue(':codAutor', $codAutor);
        $stmt->bindValue(':autor', $autor);
        $stmt->bindValue(':statusAutor', $statusAutor);

        // Executa a query de atualização
        if (!$stmt->execute()) {
            throw new Exception("Erro na atualização");
        }
        
    } catch (Exception $e) {
        // Exibe erro genérico
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
        
    } finally {
        // Libera recursos, fechando a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
?>
