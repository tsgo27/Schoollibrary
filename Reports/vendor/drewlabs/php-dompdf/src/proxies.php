<?php

namespace Drewlabs\Dompdf\Proxy;

use Drewlabs\Dompdf\Dompdf;
use Drewlabs\Dompdf\Factory;
use Drewlabs\Dompdf\PathPrefixer;
use Drewlabs\Dompdf\FactoryInterface;
use Drewlabs\Dompdf\DomPdfable;
use Psr\Http\Message\StreamInterface;

/**
 * Proxy function to an instance of {@see PathPrefixer}
 * 
 * @param string $base 
 * @return PathPrefixer 
 */
function PathPrefixer(string $base)
{
    return new PathPrefixer($base);
}

/**
 * Proxy function to an instance of {@see PdfFactory}
 * 
 * @return FactoryInterface 
 */
function PdfFactory()
{
    return new Factory();
}

/**
 * Proxy function to an instance of {@see DomPdfable}
 * 
 * @param array|\Closure|string $optionsorstream 
 * @param string|\SplFileInfo|StreamInterface $pathorstream
 * @return DomPdfable 
 */
function DomPdf($optionsorstream = [], $pathorstream = null)
{
    if (is_string($optionsorstream)) {
        $pathorstream = $optionsorstream;
        $optionsorstream = require __DIR__ . '/../default.php';
    }
    $pdf = DomPdf::new($optionsorstream);
    if (null !== $pathorstream) {
        $pdf = $pdf->read($pathorstream);
    }
    return $pdf;
}