<?php
require_once __DIR__ . '/../Config/web-extends.php';

try {
    if (!isset($pdo)) {
        throw new Exception('A conexão com o banco de dados não foi estabelecida.');
    }

    // Pega a matrícula da sessão
    $matricula = $_SESSION['matricula'] ?? null;

    if ($matricula) {
        // Consultar o nome do usuário no banco de dados
        $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $userName = $user['nome'];
        } else {
            // Caso o nome do usuário não seja encontrado
            throw new Exception('Usuário não encontrado.');
        }
    } else {
        // Caso a matrícula não esteja definida na sessão
        throw new Exception('Sessão de matrícula não encontrada.');
    }
} catch (PDOException $e) {
    // Tratar exceções de conexão PDO
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
} catch (Exception $e) {
    // Tratar outras exceções
    echo "Erro: " . $e->getMessage();
    exit();
}
