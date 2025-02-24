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

            // Filtrando os dados do formulário 
            $matricula = htmlspecialchars(filter_input(INPUT_POST, 'add_matricula_aluno', FILTER_SANITIZE_NUMBER_INT), ENT_QUOTES, 'UTF-8');
            $turma = htmlspecialchars(filter_input(INPUT_POST, 'add_turma_aluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
            $aluno = htmlspecialchars(filter_input(INPUT_POST, 'add_nome_aluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
            $titulo = htmlspecialchars(filter_input(INPUT_POST, 'add_titulo_livro', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
            $DateEmprestimo = htmlspecialchars(filter_input(INPUT_POST, 'add_data_emprestimo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
            $DateDevolucao = htmlspecialchars(filter_input(INPUT_POST, 'add_data_devolucao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
            $Status = htmlspecialchars(filter_input(INPUT_POST, 'add_status_livro', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

            // Query de inserção tabela 'emprestimo'
            $sql = "INSERT INTO emprestimo (matricula_aluno, turma_aluno, nome_aluno, titulo_livro, data_emprestimo, data_devolucao, status_emprestimo, data_registro)
            VALUES (:add_matricula_aluno, :add_turma_aluno, :add_nome_aluno, :add_titulo_livro, :add_data_emprestimo, :add_data_devolucao, :add_status_livro, NOW())";
            $stmt = $pdo->prepare($sql);

            if (!$stmt) {
                throw new Exception("Erro na preparação da declaração de inserção: " . implode(" | ", $pdo->errorInfo()));
            }

            // Vincula os parâmetros com os valores
            $stmt->bindParam('add_matricula_aluno', $matricula);
            $stmt->bindParam('add_turma_aluno', $turma);
            $stmt->bindParam('add_nome_aluno', $aluno);
            $stmt->bindParam('add_titulo_livro', $titulo);
            $stmt->bindParam('add_data_emprestimo', $DateEmprestimo);
            $stmt->bindParam('add_data_devolucao', $DateDevolucao);
            $stmt->bindParam('add_status_livro', $Status);
            $stmt->execute();
        } catch (Exception $e) {
            logMessage("Erro ao processar emprestimo: " . $e->getMessage());
            echo "Erro ao inserir a emprestimo revise código. Consulte o suporte técnico.";
            exit();
        }


        // Bloco TRY UPDATE
        try {
            // Query para atualizar 'situacao' Obra
            $sqlUpdateObra = "UPDATE obra SET Situacao = :Situacao WHERE Titulo = :AddTitulo";
            $stmtUpdateObra = $pdo->prepare($sqlUpdateObra);

            if (!$stmtUpdateObra) {
                throw new Exception("Erro na preparação da declaração de atualização: " . implode(" | ", $pdo->errorInfo()));
            }

            // Vincula os parâmetros com os valores
            $stmtUpdateObra->bindValue(':Situacao', $Status);
            $stmtUpdateObra->bindValue(':AddTitulo', $titulo);
            $stmtUpdateObra->execute();
        } catch (Exception $e) {
            logMessage("Erro ao processar reserva: " . $e->getMessage());
            echo "Erro ao processar a reserva. Consulte o suporte técnico.";
            exit();
        } finally {
            // Fecha as declarações e a conexão com o banco de dados
            $stmt = null;
            $stmtUpdateObra = null;
            $pdo = null;
        }
    }
    ?>
