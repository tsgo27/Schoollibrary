<?php
/*
* Load variables 
*
*/

function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception("O arquivo .env não foi encontrado.");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignora linhas de comentários
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        // Define uma variável global
        $_ENV[$name] = $value;
    }
}


loadEnv(__DIR__ . '/.env');
?>
