<?php
require_once __DIR__ . '/../Config/web-extends.php';

/** @var PDO $pdo */

try {
    // Verifique a conexão (já configurada no arquivo database_server.php)
    if ($pdo->errorCode() != "0000") {
        die("Erro na conexão com o banco de dados: " . implode(", ", $pdo->errorInfo()));
    }

    // Obtenha a matrícula fornecida pelo AJAX
    $matricula = $_POST["matricula"];

    // Consulta SQL para buscar o nome e o status do aluno com base na matrícula
    $sql = "SELECT nome, user_status FROM alunos WHERE matricula = :matricula";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":matricula", $matricula, PDO::PARAM_INT);
    $stmt->execute();

    // Verifique se a consulta foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        // Se encontrou resultados, obtenha o nome e o status do aluno
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $row["nome"];
        $status = $row["user_status"];

        // Verifique o status do aluno
        if ($status == 'Ativo') {
            // Se o aluno estiver ativo, retorne o nome do aluno
            echo $nome;
        } else {
            // Se o aluno estiver inativo, exiba a mensagem "Aluno com pendência"
            echo "Aluno com pendência";
        }
    } else {
        // Se não encontrou resultados, retorne uma mensagem de erro
        echo "Aluno não encontrado";
    }
} catch (PDOException $e) {
    // Tratamento de exceção para consultas preparadas
    echo "Erro na consulta SQL: " . $e->getMessage();
}
?>
