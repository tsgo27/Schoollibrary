<?php

namespace Drewlabs\Dompdf;

use Psr\Http\Message\StreamInterface;

interface IOReader
{
    /**
     * Read stream content into an in memory variable
     *
     * @param string|\SplFileInfo|StreamInterface $pathorstream
     * 
     * @return mixed
     */
    public function read($pathorstream);
}
