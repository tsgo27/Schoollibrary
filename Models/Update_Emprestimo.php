<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// Registra no log o tipo de requisição (POST) e a URL acessada
logMessage("Requisição recebida: " . $_SERVER['REQUEST_METHOD'] . " - " . $_SERVER['REQUEST_URI'], $_REQUEST);


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
        $matricula = htmlspecialchars(filter_input(INPUT_POST, 'editaMatricula', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $turma = htmlspecialchars(filter_input(INPUT_POST, 'editaTurma', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $aluno = htmlspecialchars(filter_input(INPUT_POST, 'editaAluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'editaTitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $emprestimo = htmlspecialchars(filter_input(INPUT_POST, 'editaEmprestimo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $devolucao = htmlspecialchars(filter_input(INPUT_POST, 'editaDevolucao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'Status_Livro', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');


        // Query atualizar dados da tabela emprestimo
        $sql = "UPDATE emprestimo SET matricula_aluno = :editaMatricula, turma_aluno = :editaTurma, nome_aluno = :editaAluno, titulo_livro = :editaTitulo, 
        data_emprestimo = :editaEmprestimo, data_devolucao = :editaDevolucao, status_emprestimo = :Status_Livro WHERE id_emprestimo = :codEmprestimo";
        $stmt = $pdo->prepare($sql);


        // Vincula os parâmetros com os valores
        $stmt->bindValue(':codEmprestimo', $codEmprestimo);
        $stmt->bindValue(':editaMatricula', $matricula);
        $stmt->bindValue(':editaTurma', $turma);
        $stmt->bindValue(':editaAluno', $aluno);
        $stmt->bindValue(':editaTitulo', $titulo);
        $stmt->bindValue(':editaEmprestimo', $emprestimo);
        $stmt->bindValue(':editaDevolucao', $devolucao);
        $stmt->bindValue(':Status_Livro', $status);
        $stmt->execute();

        // Query para atualiza situção da obra
        $sqlUpdateObra = "UPDATE obra SET Situacao = :Situacao WHERE Titulo = :editaTitulo";
        $stmtUpdateObra = $pdo->prepare($sqlUpdateObra);

        $stmtUpdateObra->bindValue(':Situacao', $status);
        $stmtUpdateObra->bindValue(':editaTitulo', $titulo);
        $stmtUpdateObra->execute();

    } finally {
        // Fecha as declarações e a conexão com o banco de dados
        $stmt = null;
        $stmtUpdateObra = null;
        $pdo = null;
    }
}
?>
