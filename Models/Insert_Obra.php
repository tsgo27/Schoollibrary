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
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            throw new Exception('Token CSRF inválido');
        }


        // Filtrando os dados do formulário usando apenas htmlspecialchars()
        $isbn = htmlspecialchars(filter_input(INPUT_POST, 'AddIsbn', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(filter_input(INPUT_POST, 'AddTitulo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $autor = htmlspecialchars(filter_input(INPUT_POST, 'AddAutor', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $edicao = htmlspecialchars(filter_input(INPUT_POST, 'AddEdicao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $ano = htmlspecialchars(filter_input(INPUT_POST, 'AddAno', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $copia = htmlspecialchars(filter_input(INPUT_POST, 'AddCopia', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $acervo = htmlspecialchars(filter_input(INPUT_POST, 'AddAcervo', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $genero = htmlspecialchars(filter_input(INPUT_POST, 'AddGenero', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $editora = htmlspecialchars(filter_input(INPUT_POST, 'AddEditora', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');
        $situacao = htmlspecialchars(filter_input(INPUT_POST, 'AddSituacao', FILTER_DEFAULT), ENT_QUOTES, 'UTF-8');

        // Cria a query de inserção
        $sql = "INSERT INTO obra (Isbn, Titulo, Autor, Edicao, Ano, Copia, Acervo, Genero, Editora, Situacao, data_registro)
        VALUES (:isbn, :titulo, :autor, :edicao, :ano, :copia, :acervo, :genero, :editora, :situacao, NOW())";
        $stmt = $pdo->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da declaração de inserção: " . implode(" | ", $pdo->errorInfo()));
        }

        // Vincula os parâmetros com os valores
        $stmt->bindParam(":isbn", $isbn);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":autor", $autor);
        $stmt->bindParam(":edicao", $edicao);
        $stmt->bindParam(":ano", $ano);
        $stmt->bindParam(":copia", $copia);
        $stmt->bindParam(":acervo", $acervo);
        $stmt->bindParam(":genero", $genero);
        $stmt->bindParam(":editora", $editora);
        $stmt->bindParam(":situacao", $situacao);
        $stmt->execute();

    } catch (Exception $e) {
        logMessage("Erro ao processar obra: " . $e->getMessage());
        echo "Erro ao inserir obra. Consulte o suporte técnico.";
        exit();

    } finally {
        // Fecha a declaração e a conexão com o banco de dados
        $stmt = null;
        $pdo = null;
    }
}

