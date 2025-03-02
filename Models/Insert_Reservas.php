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
        $matricula = htmlspecialchars(filter_input(INPUT_POST, 'add_matricula_aluno', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $turma = htmlspecialchars(filter_input(INPUT_POST, 'add_turma_aluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $aluno = htmlspecialchars(filter_input(INPUT_POST, 'add_nome_aluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'add_titulo_livro', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $dataReserva = htmlspecialchars(filter_input(INPUT_POST, 'add_data_reserva', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $dataExpiracao = htmlspecialchars(filter_input(INPUT_POST, 'add_data_expiracao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'add_situacao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Query de inserção tabela 'reservas'
        $sql = "INSERT INTO reservas (matricula_aluno, turma_aluno, nome_aluno, titulo_livro, data_reserva, data_expiracao, situacao_reserva, data_registro) 
        VALUES (:add_matricula_aluno, :add_turma_aluno, :add_nome_aluno, :add_titulo_livro, :add_data_reserva, :add_expiracao, :add_situacao, NOW())";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração de inserção: " . implode(" | ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros com os valores
        $stmt->bindValue('add_matricula_aluno', $matricula);
        $stmt->bindValue('add_turma_aluno', $turma);
        $stmt->bindValue('add_nome_aluno', $aluno);
        $stmt->bindValue('add_titulo_livro', $titulo);
        $stmt->bindValue('add_data_reserva', $dataReserva);
        $stmt->bindValue('add_expiracao', $dataExpiracao);
        $stmt->bindValue('add_situacao', $status);
        $stmt->execute();

    } catch (Exception $e) {
        logMessage("Erro ao precessar reserva: " . $e->getMessage());
        echo "Erro ao inserir reserva. Consulte o suporte técnico.";
        exit();
    }

    // Bloco TRY UPDATE
    try {
        // Query para atualizar 'situacao' Obra
        $sqlUpdateObra = "UPDATE obra SET Situacao = :Situacao WHERE Titulo = :AddTitulo";
        $stmtUpdateObra = $pdo->prepare($sqlUpdateObra);

        if (!$stmtUpdateObra) {
            throw new Exception("Erro na preparação da declaração de atualização: " . implode(" | ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros com os valores
        $stmtUpdateObra->bindValue(':Situacao', $status);
        $stmtUpdateObra->bindValue(':AddTitulo', $titulo);
        $stmtUpdateObra->execute();

    } catch (Exception $e) {
        logMessage("Erro ao processar reserva: " . $e->getMessage());
        echo "Erro ao processar a reserva. Consulte o suporte técnico.";
        exit();
        
    } finally {
        // Fecha as declarações e a conexão com o banco de dados
        $stmt = null;
        $stmtUpdateObra = null;
        $pdo = null;
    }
}
