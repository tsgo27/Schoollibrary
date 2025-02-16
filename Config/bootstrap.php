<?php
/*
* Bootstrap do sistema
*/

// Define o caminho base do sistema para a construção das URLs
define('BASE_URL', '/schoollibrary');

// Inclui os arquivos necessários antes de chamar qualquer função
require_once __DIR__ . '/../Config/config_database.php';
require_once __DIR__ . '/../Config/config_csrf.php';
require_once __DIR__ . '/../Config/log_error.php';
require_once __DIR__ . '/../Config/log_requests.php'; 

// Inclui outros arquivos necessários
require_once __DIR__ . '/../Controllers/SessionController.php';
require_once __DIR__ . '/../Models/get_user_name.php';
require_once __DIR__ . '/../Models/get_dados_cards.php';
require_once __DIR__ . '/../Models/get_dados_graficos.php';
?>
