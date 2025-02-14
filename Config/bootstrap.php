<?php
/*
* extends 
*
*/
// Define o caminho base do sistema para a construção das URLso
define('BASE_URL', '/schoollibrary');

// Inclui os arquivos necessários para a configuração e funcionamento do sistema.
require_once __DIR__ . '/../Config/config_database.php';
require_once __DIR__ . '/../Config/config_csrf.php';
require_once __DIR__ . '/../Controllers/SessionController.php'; 
require_once __DIR__ . '/../Models/get_user_name.php'; 
require_once __DIR__ . '/../Models/get_dados_cards.php';
require_once __DIR__ . '/../Models/get_dados_graficos.php';

?>