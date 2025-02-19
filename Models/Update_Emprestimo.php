<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// Registra no log o tipo de requisição (GET, POST, etc.) e a URL acessada
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
        $aluno = htmlspecialchars(filter_input(INPUT_POST, 'editaAluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'editaTitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $emprestimo = htmlspecialchars(filter_input(INPUT_POST, 'editaEmprestimo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $devolucao = htmlspecialchars(filter_input(INPUT_POST, 'editaDevolucao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars(filter_input(INPUT_POST, 'Status_Livro', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Atualiza a tabela emprestimo
        $sqlUpdateEmprestimo = "UPDATE emprestimo SET nome_aluno = :editaAluno, titulo_livro = :editaTitulo, data_emprestimo = :editaEmprestimo, data_devolucao = :editaDevolucao, 
        status_emprestimo = :Status_Livro WHERE id_emprestimo = :codEmprestimo";
        $stmtUpdateEmprestimo = $pdo->prepare($sqlUpdateEmprestimo);

        $stmtUpdateEmprestimo->bindValue(':codEmprestimo', $codEmprestimo);
        $stmtUpdateEmprestimo->bindValue(':editaAluno', $aluno);
        $stmtUpdateEmprestimo->bindValue(':editaTitulo', $titulo);
        $stmtUpdateEmprestimo->bindValue(':editaEmprestimo', $emprestimo);
        $stmtUpdateEmprestimo->bindValue(':editaDevolucao', $devolucao);
        $stmtUpdateEmprestimo->bindValue(':Status_Livro', $status);

        $stmtUpdateEmprestimo->execute();

        // Atualiza a tabela obra
        $sqlUpdateObra = "UPDATE obra SET Situacao = :Situacao WHERE Titulo = :editaTitulo";
        $stmtUpdateObra = $pdo->prepare($sqlUpdateObra);

        $stmtUpdateObra->bindValue(':Situacao', $status);
        $stmtUpdateObra->bindValue(':editaTitulo', $titulo);

        $stmtUpdateObra->execute();

    } finally {
        // Fecha as declarações e a conexão com o banco de dados
        $stmtUpdateEmprestimo = null;
        $stmtUpdateObra = null;
        $pdo = null;
    }
}
?>
