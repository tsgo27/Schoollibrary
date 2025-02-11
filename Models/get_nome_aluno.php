<?php
require_once __DIR__ . '/../Config/bootstrap.php';

/*
* Buscar nome do aluno pela matricula
*
*/

try {
    if ($pdo->errorCode() != "0000") {
        die("Erro na conexão com o banco de dados: " . implode(", ", $pdo->errorInfo()));
    }

    $matricula = $_POST["matricula"];
    $sql = "SELECT nome, user_status FROM alunos WHERE matricula = :matricula";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":matricula", $matricula, PDO::PARAM_INT);
    $stmt->execute();

    // Verifique se a consulta foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $row["nome"];
        $status = $row["user_status"];

        // Verifique o status do aluno
        if ($status == 'ativo') {
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
