<?php
session_start();
require_once __DIR__ . '/../Config/web-extends.php';
require_once __DIR__ . '/../Config/verify_csrf.php';

/** @var PDO $pdo */

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
        $codReserva = htmlspecialchars(filter_input(INPUT_POST, 'codReserva', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'editaTitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $subtitulo = htmlspecialchars(filter_input(INPUT_POST, 'editaSubtitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $DataReserva = htmlspecialchars(filter_input(INPUT_POST, 'editaReserva', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $DataExpiracao = htmlspecialchars(filter_input(INPUT_POST, 'editaExpiracao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $situacao = htmlspecialchars(filter_input(INPUT_POST, 'situacao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        
        // Cria a query de atualização usando Prepared Statements
        $sqlUpdateReserva = "UPDATE reservas SET Titulo = :editaTitulo, SubTitulo = :editaSubtitulo, DataReserva = :editaReserva, DataExpiracao = :editaExpiracao, Situacao = :Situacao WHERE CodReserva = :codReserva";
        $stmtUpdateReserva = $pdo->prepare($sqlUpdateReserva);

        if (!$stmtUpdateReserva) {
            throw new Exception("Erro na preparação da declaração: " . $pdo->errorInfo()[2]);
        }

        // Vincula os parâmetros com os valores
        $stmtUpdateReserva->bindParam(':codReserva', $codReserva);
        $stmtUpdateReserva->bindParam(':editaTitulo', $titulo);
        $stmtUpdateReserva->bindParam(':editaSubtitulo', $subtitulo);
        $stmtUpdateReserva->bindParam(':editaReserva', $DataReserva);
        $stmtUpdateReserva->bindParam(':editaExpiracao', $DataExpiracao);
        $stmtUpdateReserva->bindParam(':Situacao', $situacao);

        // Executa a query de atualização na tabela reservas
        if ($stmtUpdateReserva->execute()) {
            // Atualiza a Situacao na tabela obra
            $sqlUpdateObra = "UPDATE obra SET Situacao = :Situacao WHERE Titulo = :editaTitulo";
            $stmtUpdateObra = $pdo->prepare($sqlUpdateObra);

            if (!$stmtUpdateObra) {
                throw new Exception("Erro na preparação da declaração: " . $pdo->errorInfo()[2]);
            }

            // Vincula os parâmetros com os valores
            $stmtUpdateObra->bindParam(':Situacao', $situacao);
            $stmtUpdateObra->bindParam(':editaTitulo', $titulo);

            // Executa a query de atualização na tabela obra
            if ($stmtUpdateObra->execute()) {
                // Redireciona o usuário para a página de origem
                header("Location: http://localhost/schoollibrary/views/Reservas.php");
                exit();
            } else {
                throw new Exception("Erro na atualização da tabela obra");
            }
        } else {
            throw new Exception("Erro na atualização da tabela reservas");
        }
        
    } catch (Exception $e) {
        echo "Ocorreu um erro: " . $e->getMessage();
        exit();

    } finally {
        // Fecha as declarações e a conexão com o banco de dados
        $stmtUpdateReserva = null;
        $stmtUpdateObra = null;
        $pdo = null;
    }
}
?>
