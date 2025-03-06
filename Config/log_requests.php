<?php
/**
 * Função para registrar logs formatados corretamente
 *
 * @param string $message A mensagem principal do log
 * @param array|null $data Dados adicionais para o log (exemplo: $_REQUEST)
 */
function logMessage($message, $data = null) {
    // Define o caminho do arquivo de log
    $logFile = __DIR__ . '/../logs/requests.log';

    // Obtém a data e hora atual
    $date = date('Y-m-d H:i:s');

    // Registra a mensagem principal (requisição)
    file_put_contents($logFile, "[$date] " . $message . PHP_EOL, FILE_APPEND);

    // Se houver dados adicionais, formata e grava separadamente
    if (!empty($data)) {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($logFile, $jsonData . PHP_EOL, FILE_APPEND);
    }
}
?>
