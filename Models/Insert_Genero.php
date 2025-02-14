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

        // Filtrando os dados do formulário usando apenas htmlspecialchars()
        $genero = htmlspecialchars(filter_input(INPUT_POST, 'addGenero', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'addStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Verificando se os campos obrigatórios estão preenchidos
        if (empty($genero) || empty($status)) {
            exit();
        }

        // Cria a query de inserção usando Prepared Statements
        $sql = "INSERT INTO genero (NomeGenero, StatusGenero, data_registro) VALUES (:genero, :status, NOW())";
        // Prepara a declaração SQL
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            echo "Erro na preparação da declaração: " . $pdo->errorInfo()[2];
            exit();
        }

        // Vincula os parâmetros com os valores.
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            // Redireciona o usuário para a página de origem.
            header("Location: http://localhost/schoollibrary/views/Genero.php");
            exit();
        } else {
            // Se ocorreu algum erro na inserção, exibe uma mensagem de erro
            echo "Ocorreu um erro durante o cadastro. Tente novamente mais tarde.";
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
?>
