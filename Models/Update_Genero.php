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
        if (!verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Token CSRF inválido');
        }

        // Filtrando e sanitizando os dados do formulário
        $codGenero = htmlspecialchars(filter_input(INPUT_POST, 'codGenero', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $genero = htmlspecialchars(filter_input(INPUT_POST, 'editaGenero', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $statusGenero = htmlspecialchars(filter_input(INPUT_POST, 'editaStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');


        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE genero SET nome_genero = :genero, status_genero = :statusGenero WHERE id_genero = :codGenero";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração: " . implode(" | ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros com os valores
        $stmt->bindValue(':codGenero', $codGenero, PDO::PARAM_INT);
        $stmt->bindValue(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindValue(':statusGenero', $statusGenero, PDO::PARAM_STR);

        // Executa a query de atualização
        $stmt->execute();
        logMessage("gênero atualizada com sucesso: ID $codGenero");
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
?>
