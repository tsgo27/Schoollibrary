<?php
require_once __DIR__ . '/loadEnv.php';

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
    if (filter_var($_ENV['DEBUG_MODE'], FILTER_VALIDATE_BOOLEAN)) {
        $error_message = mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1');
        header("Location: ../page/erro_conexao.php?error=" . urlencode($error_message));
    } else {
        header('Location: ../page/erro_conexao.php');
    }
    exit();
}

?>