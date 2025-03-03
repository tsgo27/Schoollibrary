<?php
/*
* Configuração de logs
*
*/

// Define o fuso horário para o Brasil
date_default_timezone_set('America/Sao_Paulo');

// Define o caminho do arquivo de log corretamente
$logFile = __DIR__ . '/../Logs/error.log';


ini_set('log_errors', 1);
ini_set('error_log', $logFile);
ini_set('display_errors', 0); 
error_reporting(E_ALL); 


?>
