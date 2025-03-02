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

        // Filtrando e escapando os dados 
        $editora = htmlspecialchars(filter_input(INPUT_POST, 'add_editora', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $cidade = htmlspecialchars(filter_input(INPUT_POST, 'add_cidade', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $estado = htmlspecialchars(filter_input(INPUT_POST, 'add_estado', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'add_status', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Query de inserção na tabela 'editora'
        $sql = "INSERT INTO editora (nome_editora, cidade_editora, estado_editora, status_editora, data_registro) 
        VALUES (:editora, :cidade, :estado, :status, NOW())";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração de inserção: " . implode(" | ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros corretamente
        $stmt->bindParam(':editora', $editora);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

    } catch (Exception $e) {
        logMessage("Erro ao processar editora: " . $e->getMessage());
        echo "Erro ao inserir editora. Consulte o suporte técnico.";
        exit();

    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
?>
