<?php
session_start();
require_once __DIR__ . '/../Config/web-extends.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        // Filtrando os dados do formulário usando apenas htmlspecialchars()
        $codEmprestimo = htmlspecialchars(filter_input(INPUT_POST, 'codEmprestimo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $observacao = htmlspecialchars(filter_input(INPUT_POST, 'observacao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Verificando se os campos obrigatórios estão preenchidos
        if (empty($codEmprestimo)) {
            exit();
        }

        // Obtém a matrícula do aluno com base no código do empréstimo
        $sqlMatricula = "SELECT MatriculaAluno FROM emprestimo WHERE codEmprestimo = ?";
        $stmtMatricula = $pdo->prepare($sqlMatricula);
        $stmtMatricula->bindParam(1, $codEmprestimo, PDO::PARAM_INT);
        $stmtMatricula->execute();

        $matricula = $stmtMatricula->fetchColumn();

        if (!$matricula) {
            // Se não encontrar a matrícula, encerre o processo
            exit();
        }

        // Verifica se o campo 'observacao' não está vazio antes de realizar a atualização
        if (!empty($observacao)) {
            // Atualiza a observação na tabela alunos
            $sqlUpdateObservacao = "UPDATE alunos SET observacao = ? WHERE matricula = ?";
            $stmtUpdateObservacao = $pdo->prepare($sqlUpdateObservacao);

            // Vincula os parâmetros com os valores
            $stmtUpdateObservacao->bindParam(1, $observacao);
            $stmtUpdateObservacao->bindParam(2, $matricula, PDO::PARAM_INT);

            // Execute a consulta
            if ($stmtUpdateObservacao->execute()) {
                // Redireciona o usuário para a página de origem com uma mensagem de sucesso
                echo '<script>alert("Observação salva com sucesso!"); window.location.href = "http://localhost/schoollibrary/views/Emprestimo.php";</script>';
                exit();
            } else {
                // Se ocorreu algum erro, exibe uma mensagem de erro
                echo "Ocorreu um erro durante o cadastro da observação. Tente novamente mais tarde.";
            }
        } else {
            // Se o campo 'observacao' estiver vazio, exiba um alerta no navegador e redirecione
            echo '<script>alert("O campo \'observação\' não pode estar vazio."); window.location.href = "http://localhost/schoollibrary/views/Emprestimo.php";</script>';
            exit();
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();

    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmtMatricula = null;
        $stmtUpdateObservacao = null;
        $pdo = null;
    }
}
?>
