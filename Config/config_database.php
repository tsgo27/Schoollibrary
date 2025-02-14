<?php
require_once __DIR__ . '/load_env.php';
require_once __DIR__ . '/config_log.php';

/*
* Conexões de banco de dados
*
*/

try {
    $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'];
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ));
} catch (PDOException $e) {
    // Formata a mensagem de erro para o log
    $error_message = "Erro de conexão: " . $e->getMessage();

    // Personaliza o formato de log para remover caminho do arquivo e a linha de erro
    $formatted_error_message = '[' . date('d-M-Y H:i:s') . ' ' . date_default_timezone_get() . '] ' . $error_message . "\n";

    // Registra o erro no log com a mensagem formatada
    error_log($formatted_error_message, 3, __DIR__ . '/../Logs/error.log'); 

    // Redireciona para a página de erro dependendo do modo de depuração
    if (filter_var($_ENV['DEBUG_MODE'], FILTER_VALIDATE_BOOLEAN)) {
        $error_message = mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1');
        header("Location: ../page/erro_conexao.php?error=" . urlencode($error_message));
    } else {
        header('Location: ../page/erro_conexao.php');
    }
    exit();
}
?>
