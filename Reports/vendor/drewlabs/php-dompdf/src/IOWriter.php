<?php

namespace Drewlabs\Dompdf;

interface IOWriter
{
    /**
     * Save the PDF to a file. $flags parameter modified how the file write operation is performed.
     *
     * @param string $path
     * @param $flags
     * @return int|false
     */
    public function write(string $path, ?int $flags = null);
}