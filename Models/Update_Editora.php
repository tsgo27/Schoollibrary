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
        $codEditora = filter_input(INPUT_POST, 'codEditora', FILTER_SANITIZE_NUMBER_INT);
        $editora = htmlspecialchars(filter_input(INPUT_POST, 'editaEditora', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $cidade = htmlspecialchars(filter_input(INPUT_POST, 'editaCidade', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $estado = htmlspecialchars(filter_input(INPUT_POST, 'editaEstado', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $editaStatus = htmlspecialchars(filter_input(INPUT_POST, 'editaStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');


        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE editora SET nome_editora = :editora, cidade_editora = :cidade, estado_editora = :estado, status_editora = :editaStatus 
        WHERE id_editora = :codEditora";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração: " . implode(" | ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros com os valores
        $stmt->bindValue(':codEditora', $codEditora, PDO::PARAM_INT);
        $stmt->bindValue(':editora', $editora, PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':editaStatus', $editaStatus, PDO::PARAM_STR);

        // Executa a query de atualização
        $stmt->execute();
        logMessage("Editora atualizada com sucesso: ID $codEditora");
        exit();

    } catch (Exception $e) {
        logMessage("Erro ao atualizar editora: " . $e->getMessage());
        echo "Ocorreu um erro. Consulte o suporte técnico.";
        exit();
        
    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
