<?php
session_start();
require_once __DIR__ . '/../Config/web-extends.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Obtém e filtra os dados do formulário Editar
        $idAluno = htmlspecialchars(filter_input(INPUT_POST, 'idAluno', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $matricula = htmlspecialchars(filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $nome = htmlspecialchars(filter_input(INPUT_POST, 'editarNome', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $telefone = htmlspecialchars(filter_input(INPUT_POST, 'editarTelefone', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars(filter_input(INPUT_POST, 'editarEmail', FILTER_VALIDATE_EMAIL), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'editarStatus', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Cria a query de atualização usando Prepared Statements
        $sql = "UPDATE Alunos SET matricula = :matricula, nome = :nome, telefone = :telefone, email = :email, user_status = :status WHERE id_Aluno = :idAluno";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração: " . $pdo->errorInfo()[2]);
        }

        // Vincula os parâmetros com os valores
        $stmt->bindParam(':idAluno', $idAluno);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':status', $status);

        // Executa a query de atualização
        if ($stmt->execute()) {
            // Redireciona o usuário para a página de origem com uma mensagem de sucesso
            header("Location: http://localhost/schoollibrary/views/Aluno.php");
            exit();
        } else {
            // Se ocorreu algum erro na atualização, mostra o erro
            throw new Exception("Erro na atualização");
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt = null;
    $pdo = null;

    // Termina o script para evitar saída adicional
    exit();
}
?>
