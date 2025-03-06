<?php
define('VIEW_PATH', __DIR__ . '/views/');
define('ERROR_PATH', __DIR__ . '/error/');
require_once __DIR__ . '/Config/log_error.php';

// Obtém e sanitiza a URL
$url = filter_var($_GET['url'] ?? '', FILTER_SANITIZE_URL);

// Verifica se o usuário está tentando acessar a pasta raiz ou URL inválida
if ($url === '' || $url === 'schoollibrary') {
    include ERROR_PATH . '403.php';
    exit;
}

// Filtra o nome seguro da URL
$safe_url = basename($url);

// Define o caminho do arquivo correspondente à URL
$file = VIEW_PATH . $safe_url . '.php';

// Verifica se o arquivo existe, é um arquivo PHP e é válido
if (!file_exists($file) || !is_file($file) || pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
    // Formata a mensagem de erro para o log
    $error_message = "Erro 404: Página '$safe_url' não encontrada.";

    // Caminho do arquivo de log
    $logFilePath = __DIR__ . '/../logs/error.log';

    // Verifica se o arquivo de log é acessível e escreve no log
    if (is_writable($logFilePath) || is_writable(dirname($logFilePath))) {
        $formatted_error_message = sprintf('[%s %s] %s' . "\n", date('d-M-Y H:i:s'), date_default_timezone_get(), $error_message);
        error_log($formatted_error_message, 3, $logFilePath);
    }

    // Registra o erro como um aviso
    trigger_error($error_message, E_USER_WARNING);

    // Redireciona para a página de erro 404
    include ERROR_PATH . '404.php';
} else {
    // Inclui o arquivo da URL se for válido
    include $file;
}
?>
