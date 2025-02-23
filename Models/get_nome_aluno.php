<?php
require_once __DIR__ . '/../Config/bootstrap.php';

/*
* Buscar nome e turma do aluno pela matricula
*
*/

try {
    if ($pdo->errorCode() != "0000") {
        die("Erro na conexão com o banco de dados: " . implode(", ", $pdo->errorInfo()));
    }

    $matricula = $_POST["matricula"];
    $sql = "SELECT nome, turma, user_status FROM alunos WHERE matricula = :matricula";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":matricula", $matricula, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $row["nome"];
        $turma = $row["turma"];
        $status = $row["user_status"];

        if ($status == 'Ativo') {
            // Retorna nome e turma no formato JSON
            echo json_encode(["nome" => $nome, "turma" => $turma]);
        } else {
            echo json_encode(["nome" => "Aluno com pendência", "turma" => ""]);
        }
    } else {
        echo json_encode(["nome" => "Aluno não encontrado", "turma" => ""]);
    }
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro na consulta SQL: " . $e->getMessage()]);
}
?>
