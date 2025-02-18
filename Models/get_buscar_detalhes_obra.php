<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// Verificando se o ID da obra e o status foram passados corretamente via POST
if (isset($_POST['obra_id']) && isset($_POST['status'])) {
    $obraId = $_POST['obra_id']; // ID da obra
    $status = trim($_POST['status']);

    try {
        if ($status === 'Reservado') {
            $sql = "SELECT NomeAluno, DataReserva, DataExpiracao 
                    FROM reservas 
                    WHERE Titulo = (SELECT Titulo FROM obra WHERE CodObra = :obra_id) 
                    AND TRIM(Situacao) = 'Reservado'";
        } elseif ($status === 'Emprestado') {
            $sql = "SELECT NomeAluno, DataEmprestimo, DataDevolucao 
                    FROM emprestimo 
                    WHERE TituloLivro = (SELECT Titulo FROM obra WHERE CodObra = :obra_id) 
                    AND TRIM(StatusEmprestimo) = 'Emprestado'";
        } else {
            echo json_encode(['error' => 'Obra Disponível']);
            exit;
        }

        // Preparando a consulta PDO
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':obra_id', $obraId, PDO::PARAM_INT);

        // Executando a consulta
        $stmt->execute();

        // Buscando todos os resultados
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($dados)) {
            echo json_encode($dados);
        } else {
            echo json_encode(['error' => 'Nenhum dado encontrado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro na consulta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID da obra ou status não informado.']);
}
?>
