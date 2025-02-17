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

        // Filtrando os dados do formulário usando apenas htmlspecialchars()
        $matricula = htmlspecialchars(filter_input(INPUT_POST, 'AddMatricula', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $aluno = htmlspecialchars(filter_input(INPUT_POST, 'AddAluno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'AddTitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $subtitulo = htmlspecialchars(filter_input(INPUT_POST, 'AddSubtitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $DataReserva = htmlspecialchars(filter_input(INPUT_POST, 'DataReserva', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $DataExpiracao = htmlspecialchars(filter_input(INPUT_POST, 'DataExpiracao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $Status = htmlspecialchars(filter_input(INPUT_POST, 'Situacao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Verificando se os campos obrigatórios estão preenchidos
        if (empty($matricula) || empty($aluno) || empty($titulo) || empty($DataReserva) || empty($DataExpiracao) || empty($Status)) {
            exit();
        }

        // Cria a query de inserção usando Prepared Statements
        $sqlInsertReserva = "INSERT INTO reservas (Matricula, NomeAluno, Titulo, SubTitulo, DataReserva, DataExpiracao, Situacao, data_registro)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmtInsertReserva = $pdo->prepare($sqlInsertReserva);

        if (!$stmtInsertReserva) {
            echo "Erro na preparação da declaração: " . $pdo->errorInfo()[2];
            exit();
        }

        // Vincula os parâmetros com os valores
        $stmtInsertReserva->bindParam(1, $matricula);
        $stmtInsertReserva->bindParam(2, $aluno);
        $stmtInsertReserva->bindParam(3, $titulo);
        $stmtInsertReserva->bindParam(4, $subtitulo);
        $stmtInsertReserva->bindParam(5, $DataReserva);
        $stmtInsertReserva->bindParam(6, $DataExpiracao);
        $stmtInsertReserva->bindParam(7, $Status);

        if ($stmtInsertReserva->execute()) {
            // Atualiza a Situacao na tabela obra
            $sqlUpdateObra = "UPDATE obra SET Situacao = ? WHERE Titulo = ?";
            $stmtUpdateObra = $pdo->prepare($sqlUpdateObra);

            if (!$stmtUpdateObra) {
                echo "Erro na preparação da declaração de atualização da obra: " . $pdo->errorInfo()[2];
                exit();
            }

            // Executa a query de atualização na tabela obra
            if ($stmtUpdateObra->execute()) {
                // Redireciona o usuário para a página de reservas com uma mensagem de sucesso
                header("Location: http://localhost/schoollibrary/views/Reservas.php");
                exit();
            } else {
                throw new Exception("Erro na atualização da tabela obra");
            }
        } else {
            // Se ocorreu algum erro na inserção, exibe uma mensagem de erro
            echo "Ocorreu um erro durante o cadastro. Tente novamente mais tarde.";
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();
    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmtInsertReserva = null;
        $stmtUpdateObra = null;
        $pdo = null;
    }
}
?>
