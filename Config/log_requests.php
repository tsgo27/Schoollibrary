<?php
/**
 * Função para registrar mensagens personalizadas no log
 *
 * @param string $message A mensagem que será registrada no log
 */

function logMessage($message) {
    // Define novamente o caminho do arquivo de log dentro da função
    $logFile = __DIR__ . '/../Logs/requests.log';

    // Obtém a data e hora atual no formato 'YYYY-MM-DD HH:MM:SS'
    $date = date('Y-m-d H:i:s');
    
    // Monta a mensagem do log com a data e a mensagem recebida
    $logMessage = "[$date] " . $message . PHP_EOL;
    
    // Escreve a mensagem no arquivo de log, adicionando ao final do arquivo
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}


?>