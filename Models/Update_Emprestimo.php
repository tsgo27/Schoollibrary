<?php
session_start();
require_once __DIR__ . '/../Config/web-extends.php';
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

        // Filtrando os dados do formulário usando htmlspecialchars()
        $codEmprestimo = htmlspecialchars(filter_input(INPUT_POST, 'codEmprestimo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $aluno = htmlspecialchars(filter_input(INPUT_POST, 'editaAluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'editaTitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $subtitulo = htmlspecialchars(filter_input(INPUT_POST, 'editaSubtitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $emprestimo = htmlspecialchars(filter_input(INPUT_POST, 'editaEmprestimo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $devolucao = htmlspecialchars(filter_input(INPUT_POST, 'editaDevolucao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'Status_Livro', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Cria a query de atualização usando Prepared Statements
        $sqlUpdateEmprestimo = "UPDATE emprestimo SET NomeAluno = :editaAluno, TituloLivro = :editaTitulo, SubTituloLivro = :editaSubtitulo, DataEmprestimo = :editaEmprestimo, DataDevolucao = :editaDevolucao, StatusEmprestimo = :Status_Livro WHERE codEmprestimo = :codEmprestimo";
        $stmtUpdateEmprestimo = $pdo->prepare($sqlUpdateEmprestimo);

        if (!$stmtUpdateEmprestimo) {
            throw new Exception("Erro na preparação da declaração de empréstimo: " . $pdo->errorInfo()[2]);
        }

        // Vincula os parâmetros com os valores
        $stmtUpdateEmprestimo->bindValue(':codEmprestimo', $codEmprestimo);
        $stmtUpdateEmprestimo->bindValue(':editaAluno', $aluno);
        $stmtUpdateEmprestimo->bindValue(':editaTitulo', $titulo);
        $stmtUpdateEmprestimo->bindValue(':editaSubtitulo', $subtitulo);
        $stmtUpdateEmprestimo->bindValue(':editaEmprestimo', $emprestimo);
        $stmtUpdateEmprestimo->bindValue(':editaDevolucao', $devolucao);
        $stmtUpdateEmprestimo->bindValue(':Status_Livro', $status);

        // Executa a query de atualização na tabela emprestimo
        if ($stmtUpdateEmprestimo->execute()) {
            // Atualiza a Situacao na tabela obra
            $sqlUpdateObra = "UPDATE obra SET Situacao = :Situacao WHERE Titulo = :editaTitulo";
            $stmtUpdateObra = $pdo->prepare($sqlUpdateObra);

            if (!$stmtUpdateObra) {
                throw new Exception("Erro na preparação da declaração de obra: " . $pdo->errorInfo()[2]);
            }

            // Vincula os parâmetros com os valores
            $stmtUpdateObra->bindValue(':Situacao', $status);
            $stmtUpdateObra->bindValue(':editaTitulo', $titulo);

            // Executa a query de atualização na tabela obra
            if ($stmtUpdateObra->execute()) {
                // Redireciona o usuário para a página de origem
                header("Location: http://localhost/schoollibrary/views/Emprestimo.php");
                exit();
            } else {
                throw new Exception("Erro na atualização da tabela obra: " . $stmtUpdateObra->errorInfo()[2]);
            }
        } else {
            throw new Exception("Erro na atualização da tabela emprestimo: " . $stmtUpdateEmprestimo->errorInfo()[2]);
        }
    } catch (PDOException $e) {
        // Tratar exceções de conexão PDO
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        exit();
    } catch (Exception $e) {
        // Tratar outras exceções
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
    } finally {
        // Fecha as declarações e a conexão com o banco de dados
        $stmtUpdateEmprestimo = null;
        $stmtUpdateObra = null;
        $pdo = null;
    }
}
?>
