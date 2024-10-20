<?php
require_once __DIR__ . '/web_app.php';

/*
* Database Connections
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
        $error_message = urlencode($e->getMessage());
        header("Location: ../Error/web_db.php?error=$error_message");
    } else {
        header('Location: ../Error/web_db.php');
    }
    exit();
}
?>
