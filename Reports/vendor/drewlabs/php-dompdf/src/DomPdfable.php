<?php

namespace Drewlabs\Dompdf;

use Symfony\Component\HttpFoundation\Response;

interface DomPdfable
{

    /**
     * Set the paper size (default A4)
     *
     * @param string|array $size
     * @param string $orientation
     * @return self
     */
    public function constraints($size, ?string $orientation = Orientation::PORTRAIT);


    /**
     * Load a HTML string
     *
     * @param string $string
     * @param string|null $encoding Not used yet
     * @return self
     */
    public function html(string $string, ?string $encoding = null);

    /**
     * Load a HTML file
     *
     * @param string $file
     * @param string|null $encoding
     * @return self
     */
    public function resource(string $path, ?string $encoding = null);

    /**
     * Add metadata to the document
     *
     * @param array $infos
     * @return self
     */
    public function addInfo(array $infos = []);

    /**
     * Update the PHP DOM PDF Options
     *
     * @param array $options
     * @return static
     */
    public function setOptions(array $options);

    /**
     * Output the PDF as a string.
     *
     * @return string The rendered PDF as string
     */
    public function print();

    /**
     * Make the PDF downloadable by the user
     *
     * @param string $filename
     * @param string $disposition
     * @return Response
     */
    public function download(string $name = 'document.pdf', string $disposition = 'attachment');

    /**
     * Return a response with the PDF to show in the browser
     *
     * @param string $name
     * @return void
     */
    public function stream(string $name = 'document.pdf');
}
