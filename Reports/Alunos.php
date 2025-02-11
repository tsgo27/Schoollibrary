<?php
require_once __DIR__ . '/../Config/bootstrap.php';

// AUTOLOAD DO COMPOSER
require __DIR__.'/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// ATIVAR OUTPUT BUFFERING
ob_start();

// Definir o locale para português do Brasil
setlocale(LC_TIME, 'pt_BR.utf-8', 'pt_BR');

// Definir o fuso horário para o horário de Brasília (Ajuste conforme sua necessidade)
date_default_timezone_set('America/Sao_Paulo');

// Obtém a data atual no formato desejado (dia/mês/ano)
$dataFormatada = date('d/m/Y');


// INSTANCIA DE DOMPDF
$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);
$options->set('isPhpEnabled', true); // Habilita a execução de scripts PHP
$dompdf = new Dompdf($options);

// ACESSAR IMAGEM EXTERNA
$logo = "<img src='http://localhost/schoollibrary/public/img/logo-colegio.png' style= 'width:120px'>";

$dompdf = new Dompdf($options);

// CONFIGURAR PAPEL
$dompdf->setPaper('A4', 'landscape'); // Define a orientação para paisagem

// CARREGAR O CONTEÚDO DO ARQUIVO PHP
require_once __DIR__.'/Layout_Alunos.php';
$htmlContent = ob_get_clean(); // OBTÉM E LIMPA O OUTPUT BUFFER

// Concatenar a data formatada com o conteúdo HTML
$htmlContent = "<h4>Documento emitido em: {$dataFormatada}</h4>" . $htmlContent;

// Concatenar a imagem com o conteúdo HTML
$htmlContent = $logo . $htmlContent;

$dompdf->loadHtml($htmlContent);

// RENDERIZAR O ARQUIVO PDF
$dompdf->render();

// IMPRIMIR O CONTEÚDO DO ARQUIVO PDF NA TELA
header('Content-type: application/pdf');
echo $dompdf->output();
?>
