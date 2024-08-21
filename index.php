<?php
// Define o diretório raiz e a pasta de visualizações
define('VIEW_PATH', __DIR__ . '/views/');
define('ERROR_PATH', __DIR__ . '/Error/');

// Obtém a URL da consulta e a sanitiza
$url = isset($_GET['url']) ? filter_var($_GET['url'], FILTER_SANITIZE_URL) : '';

// Remove qualquer caminho de diretório e sanitiza a URL
$safe_url = basename($url); // Remove qualquer caminho de diretório

// Cria o caminho completo para o arquivo solicitado
$file = VIEW_PATH . $safe_url;

// Verifica se a URL é a raiz
if ($url === '') {
    include ERROR_PATH . '403.php';
} elseif (file_exists($file) && is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    // Verifica se o arquivo existe, é um arquivo regular e tem extensão .php
    include $file;
} else {
    // Redireciona para a página de erro 404 se o arquivo não for encontrado ou não for PHP
    include ERROR_PATH . '404.php';
}
?>
