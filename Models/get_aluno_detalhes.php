<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// Verificando se o ID do aluno foi passado
if (isset($_GET['id_Aluno'])) {
    $idAluno = $_GET['id_Aluno'];

    // Preparando a consulta PDO para buscar os dados do aluno
    $sql = "SELECT id_Aluno, matricula, nome, telefone, email, user_status FROM alunos WHERE id_Aluno = :id_Aluno";
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
