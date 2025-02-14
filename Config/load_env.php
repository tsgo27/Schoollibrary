<?php
require_once __DIR__ . '/config_log.php';

/*
* Carregar variáveis ​​de ambiente do arquivo .env
*
*/

function loadEnv($filePath)
{
    try {
        // Verifica se o arquivo .env existe e é legível
        if (!file_exists($filePath) || !is_readable($filePath)) {
            // Grava o erro no log
            error_log("[" . date('Y-m-d H:i:s') . "] ERROR: Arquivo .env não encontrado ou inacessível.\n", 3, __DIR__ . '/../logs/error.log');

            throw new Exception();
        }

        // Lê as linhas do arquivo .env
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignora linhas de comentários
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Verifica se a linha contém um sinal de igual
            if (strpos($line, '=') === false) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            // Define uma variável global
            $_ENV[$name] = $value;
        }
    } catch (Exception $e) {
        // Exibe uma mensagem mais genérica e segura
        echo "<style>html, body {height: 100%; margin: 0;padding: 0;background-color: #1e1e1e; display: flex; justify-content: center;align-items: center;}</style>

        <div style='display: flex; justify-content: center; align-items: center; height:100vh; font-family: Arial, sans-serif; position: fixed; top: -80px;'>
        <div style='background-color: #4f5b93; padding: 20px; border-radius: 10px; text-align: center; width: 400px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);'>
        <img src='../public/img/logo-php.png' alt='PHP Logo' style='width: 150px; margin-bottom: 20px;'>
        <h2 style='color: #ffffff; margin-bottom: 10px;'>Atenção!</h2> <p style='color:rgb(255, 255, 255);'>Erro ao carregar variáveis de ambiente.</p>
        </div></div>";
        exit();
    }
}

// Caminho do arquivo .env
$envFilePath = __DIR__ . '/../.env';

// Carrega as variáveis do arquivo .env
loadEnv($envFilePath);
