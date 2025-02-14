<?php
require_once __DIR__ . '/../Config/bootstrap.php';



// Gera o token CSRF se ainda não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verifica se o token CSRF foi enviado e é válido
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Token CSRF inválido ou ausente.');
        }

        // Verifica se os campos necessários foram enviados
        $required_fields = ['codEditora', 'editaEditora', 'editaCidade', 'editaEstado', 'editaStatus'];
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field])) {
                throw new Exception("O campo '$field' está ausente.");
            }
        }

        // Filtrando e sanitizando os dados do formulário
        $codEditora = trim(htmlspecialchars(filter_input(INPUT_POST, 'codEditora', FILTER_SANITIZE_SPECIAL_CHARS), ENT_QUOTES, 'UTF-8'));
        $editora = trim(htmlspecialchars(filter_input(INPUT_POST, 'editaEditora', FILTER_SANITIZE_SPECIAL_CHARS), ENT_QUOTES, 'UTF-8'));
        $cidade = trim(htmlspecialchars(filter_input(INPUT_POST, 'editaCidade', FILTER_SANITIZE_SPECIAL_CHARS), ENT_QUOTES, 'UTF-8'));
        $estado = trim(htmlspecialchars(filter_input(INPUT_POST, 'editaEstado', FILTER_SANITIZE_SPECIAL_CHARS), ENT_QUOTES, 'UTF-8'));
        $editaStatus = trim(htmlspecialchars(filter_input(INPUT_POST, 'editaStatus', FILTER_SANITIZE_SPECIAL_CHARS), ENT_QUOTES, 'UTF-8'));

        // Verifica se os valores não estão vazios após a sanitização
        if (empty($codEditora) || empty($editora) || empty($cidade) || empty($estado) || empty($editaStatus)) {
            throw new Exception("Todos os campos são obrigatórios e não podem estar vazios.");
        }

        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE editora SET NomeEditora = :editora, Cidade = :cidade, Estado = :estado, StatusEditora = :editaStatus WHERE codEditora = :codEditora";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da consulta SQL: " . implode(" ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros com os valores
        $stmt->bindValue(':codEditora', $codEditora, PDO::PARAM_STR);
        $stmt->bindValue(':editora', $editora, PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':editaStatus', $editaStatus, PDO::PARAM_STR);

        // Executa a query de atualização
        $stmt->execute();
        
   
    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
?>
