<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// Verificando se o ID do aluno foi passado
if (isset($_GET['id_aluno'])) {
    $idAluno = $_GET['id_aluno'];

    // Preparando a consulta PDO para buscar os dados do aluno
    $sql = "SELECT id_aluno, matricula, nome, telefone, email, user_status FROM alunos WHERE id_aluno = :id_Aluno";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_Aluno', $idAluno, PDO::PARAM_INT);

    // Executando a consulta
    $stmt->execute();

    // Verificando se o aluno foi encontrado
    if ($stmt->rowCount() > 0) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        // Retornando os dados como JSON
        echo json_encode($user_data);
    } else {
        echo json_encode(['error' => 'Aluno não encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID do aluno não informado']);
}
?>
