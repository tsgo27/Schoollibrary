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

        // Filtrando os dados do formulário usando apenas htmlspecialchars()
        $codAcervo = htmlspecialchars(filter_input(INPUT_POST, 'codAcervo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $Acervo = htmlspecialchars(filter_input(INPUT_POST, 'editaAcervo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $Status = htmlspecialchars(filter_input(INPUT_POST, 'editaStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE acervo SET acervo = :Acervo, status_acervo = :Status WHERE id_acervo = :codAcervo";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração: " . $pdo->errorInfo()[2]);
        }

        // Vincula os parâmetros com os valores
        $stmt->bindValue(':codAcervo', $codAcervo);
        $stmt->bindValue(':Acervo', $Acervo);
        $stmt->bindValue(':Status', $Status);

        // Executa a query de atualização
        if ($stmt->execute()) {
            // Redireciona o usuário para a página de origem
            header("Location: http://localhost/schoollibrary/views/Acervo.php");
            exit();
        } else {
            throw new Exception("Erro na atualização");
        }

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