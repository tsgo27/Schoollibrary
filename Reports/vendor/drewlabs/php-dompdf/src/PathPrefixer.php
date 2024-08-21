<?php

namespace Drewlabs\Dompdf;

class PathPrefixer
{
    /**
     * 
     * @var string
     */
    private $base;

    /**
     * Instance initializer
     * 
     * @param string $base 
     * @return self 
     */
    public function __construct(string $base)
    {
        $this->base = $base;
    }

    /**
     * Prefix the path to a given path with the base location
     * 
     * @param string $path 
     * @return string 
     */
    public function prefix(string $path)
    {
        // In case the path starts with / we condider it as an absolue path
        return $path[0] === DIRECTORY_SEPARATOR ? $path : implode(
            DIRECTORY_SEPARATOR,
            [rtrim($this->base ?? sys_get_temp_dir(), DIRECTORY_SEPARATOR),$path]
        );
    }
}