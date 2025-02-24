<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// Registra no log o tipo de requisição e os dados recebidos
logMessage("Requisição recebida: " . $_SERVER['REQUEST_METHOD'] . " - " . $_SERVER['REQUEST_URI'], $_REQUEST);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Obtém e filtra os dados do formulário Editar
        $idAluno = filter_input(INPUT_POST, 'idAluno', FILTER_SANITIZE_NUMBER_INT);
        $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);
        $turma = htmlspecialchars(filter_input(INPUT_POST, 'editaTurma', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $nome = htmlspecialchars(filter_input(INPUT_POST, 'editarNome', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $telefone = filter_input(INPUT_POST, 'editarTelefone', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'editarEmail', FILTER_VALIDATE_EMAIL);
        $status = htmlspecialchars(filter_input(INPUT_POST, 'editarStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE Alunos SET matricula = :matricula, turma = :turma, nome = :nome, telefone = :telefone, email = :email, user_status = :status 
                WHERE id_Aluno = :idAluno";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração: " . $pdo->errorInfo()[2]);
        }

        // Vincula os parâmetros com os valores
        $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula, PDO::PARAM_INT);
        $stmt->bindParam(':turma', $turma, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        // Executa a query de atualização
        if ($stmt->execute()) {
            // Redireciona o usuário para a página de origem
            header("Location: http://localhost/schoollibrary/views/Aluno.php");
            exit();
        } else {
            throw new Exception("Erro ao atualizar os dados do aluno.");
        }

    } catch (Exception $e) {
        // Tratar outras exceções e exibir erro
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}
?>
