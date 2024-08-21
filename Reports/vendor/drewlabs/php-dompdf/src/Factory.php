<?php

namespace Drewlabs\Dompdf;

use Dompdf\Dompdf as PHPDomPdf;

class Factory
{

    /**
     * Creates an instance of {@see \Drewlabs\DomPdfable} using user provided
     * $options parameter.
     * 
     * @param mixed $options 
     * @return DomPdfable 
     */
    public function create($options = null)
    {
        if (!isset($options)) {
            $defaults = require __DIR__ . '/default.php';
            $options = [];
            foreach ($defaults as $key => $value) {
                $key = strtolower(str_replace('DOMPDF_', '', $key));
                $options[$key] = $value;
            }
        }
        return new Dompdf(new PHPDomPdf($options));
    }
}
