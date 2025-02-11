<?php
session_start();
require_once __DIR__ . '/../Config/bootstrap.php';
require_once __DIR__ . '/../Config/verify_csrf.php';



// Gera o token CSRF se ainda não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verifica o token CSRF
        if (!verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Token CSRF inválido');
        }

        // Filtrando os dados do formulário usando apenas htmlspecialchars()
        $matricula = htmlspecialchars(filter_input(INPUT_POST, 'AddMatricula', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $aluno = htmlspecialchars(filter_input(INPUT_POST, 'AddAluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'AddTitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $subtitulo = htmlspecialchars(filter_input(INPUT_POST, 'AddSubtitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $DateEmprestimo = htmlspecialchars(filter_input(INPUT_POST, 'DataEmprestimo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $DateDevolucao = htmlspecialchars(filter_input(INPUT_POST, 'DataDevolucao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $Status = htmlspecialchars(filter_input(INPUT_POST, 'AddStatus_Livro', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Verificando se os campos obrigatórios estão preenchidos
        if (empty($matricula) || empty($aluno) || empty($titulo) || empty($DateEmprestimo) || empty($DateDevolucao) || empty($Status)) {
            exit();
        }

        // Cria a query de inserção usando Prepared Statements
        $sql = "INSERT INTO emprestimo (MatriculaAluno, NomeAluno, TituloLivro, SubTituloLivro, DataEmprestimo, DataDevolucao, StatusEmprestimo, data_registro)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);

        // Vincula os parâmetros com os valores
        $stmt->bindParam(1, $matricula);
        $stmt->bindParam(2, $aluno);
        $stmt->bindParam(3, $titulo);
        $stmt->bindParam(4, $subtitulo);
        $stmt->bindParam(5, $DateEmprestimo);
        $stmt->bindParam(6, $DateDevolucao);
        $stmt->bindParam(7, $Status);

        if ($stmt->execute()) {
            // Redireciona o usuário para a página de origem.
            header("Location: http://localhost/schoollibrary/views/Emprestimo.php");
            exit();
        } else {
            // Se ocorreu algum erro na inserção, exibe uma mensagem de erro
            echo "Ocorreu um erro durante o cadastro. Tente novamente mais tarde.";
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt = null;
    $pdo = null;
}
?>
