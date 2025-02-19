<?php
require_once __DIR__ . '/../Config/bootstrap.php';


if (isset($_POST['obra_id']) && isset($_POST['status'])) {
    $obraId = $_POST['obra_id'];
    $status = trim($_POST['status']);

    try {
        if ($status === 'Reservado') {
            $sql = "SELECT nome_aluno, data_reserva, data_expiracao FROM reservas WHERE titulo_livro = (SELECT Titulo FROM obra WHERE CodObra = :obra_id) 
            AND TRIM(situacao_reserva) = 'Reservado'";

        } elseif ($status === 'Emprestado') {
            $sql = "SELECT nome_aluno, data_emprestimo, data_devolucao FROM emprestimo WHERE Titulo_livro = (SELECT Titulo FROM obra WHERE CodObra = :obra_id) 
            AND TRIM(status_emprestimo) = 'Emprestado'";
        } else {
            echo json_encode(['error' => 'Obra Disponível']);
            exit;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':obra_id', $obraId, PDO::PARAM_INT);
        $stmt->execute();

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
