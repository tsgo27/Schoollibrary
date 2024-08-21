<?php

namespace Drewlabs\Dompdf;

use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Psr\Http\Message\StreamInterface;

class Response extends BaseResponse
{

    /**
     * 
     * @var DomPdfable
     */
    private $pdf;

    /**
     * 
     * @var StreamInterface
     */
    private $stream;

    /**
     * Response content type header
     * 
     * @var string
     */
    private $mimeType;

    /**
     * Creates and instance of {@see Response} class
     * 
     * @param null|string $name 
     *
     * @throws InvalidArgumentException 
     */
    public function __construct(?string $name = 'document.pdf', ?string $disposition = 'attachment')
    {
        parent::__construct(null, 200, ['Content-Type' => 'application/pdf']);
        $this->withContentType('application/pdf')
            ->setContentDisposition($name ?? 'document.pdf', $disposition ?? 'attachement');
    }

    /**
     * Creates a new response
     * 
     * @param DomPdfable $content 
     * @param string $name 
     * @param string $disposition 
     * @return Response 
     */
    public static function new(
        DomPdfable $dompdf,
        string $name = 'document.pdf',
        string $disposition = 'attachment'
    ) {
        $object = new self($name, $disposition);
        $object->pdf = $dompdf;
        return $object;
    }

    /**
     * Resolves the psr7 stream object
     * 
     * @return StreamInterface
     */
    public function getStream()
    {
        if (null === $this->stream) {
            $this->stream = (new Psr17Factory)->createStream($this->pdf->print());
        }
        return $this->stream;
    }

    /**
     * Sets the Content-Disposition header with the given filename.
     *
     * @param string $filename Use this UTF-8 encoded filename instead of the real name of the file
     * @param string $disposition ResponseHeaderBag::DISPOSITION_INLINE or ResponseHeaderBag::DISPOSITION_attachment
     *
     * @return static
     */
    public function setContentDisposition($filename, $disposition = 'attachment')
    {
        $value = $this->headers->makeDisposition($disposition, $filename);
        $this->headers->set('Content-Disposition', $value);
        return $this;
    }

    /**
     * Set the request content type header
     * 
     * @param string $mimeType 
     * @return static 
     * @throws InvalidArgumentException 
     */
    public function withContentType(string $mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function prepare(Request $request)
    {
        $this->headers->set('Content-Length', $this->getStream()->getSize());
        if (!$this->headers->has('Accept-Ranges')) {
            // Only accept ranges on safe HTTP methods
            $this->headers->set('Accept-Ranges', $request->isMethodSafe(false) ? 'bytes' : 'none');
        }
        if (!$this->headers->has('Content-Type')) {
            $this->headers->set('Content-Type', $this->mimeType ?? 'application/octet-stream');
        }
        if ('HTTP/1.0' !== $request->server->get('SERVER_PROTOCOL')) {
            $this->setProtocolVersion('1.1');
        }
        $this->ensureIEOverSSLCompatibility($request);
        $this->offset = 0;
        $this->maxLength = -1;
        $this->processRequestRange($request);
        return $this;
    }

    /**
     * Sends the file.
     *
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function sendContent()
    {
        if (!$this->isSuccessful()) {
            return parent::sendContent();
        }
        if (0 === $this->maxLength) {
            return $this;
        }
        $this->getStream()->seek($this->offset);
        $this->maxLength = $this->maxLength === -1 ? $this->getStream()->getSize() - $this->offset : $this->maxLength;
        $this->content = $this->getStream()->read($this->maxLength);
        return parent::sendContent();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \LogicException when the content is not null
     */
    #[\ReturnTypeWillChange]
    public function setContent($content)
    {
        if (null !== $content) {
            throw new \LogicException('The content cannot be set on a Psr7StreamResponse instance.');
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return false
     */
    #[\ReturnTypeWillChange]
    public function getContent()
    {
        return false;
    }


    /**
     * Processes request range & set the request ranges header
     * 
     * @param Request $request 
     * @return void 
     * @throws RuntimeException 
     * @throws InvalidArgumentException 
     */
    private function processRequestRange(Request $request)
    {
        if (!$request->headers->has('Range')) {
            return;
        }
        if (!(!$request->headers->has('If-Range') || $this->hasValidIfRangeHeader($request->headers->get('If-Range')))) {
            return;
        }
        $range = $request->headers->get('Range');
        $size = $this->getStream()->getSize();
        [$start, $end] = explode('-', substr($range, 6), 2) + array(0);
        $end = '' === ($value = trim($end)) ? $size - 1 : intval($value);
        if ('' === trim($start)) {
            $start = $size - $end;
            $end = $size - 1;
        } else {
            $start = (int)$start;
        }
        if ($start <= $end) {
            return;
        }
        if ($start < 0 || $end > $size - 1) {
            $this->setStatusCode(416);
            $this->headers->set('Content-Range', sprintf('bytes */%s', $size));
            return;
        }
        if (0 !== $start || $end !== $size - 1) {
            $this->maxLength = $end < $size ? $end - $start + 1 : -1;
            $this->offset = $start;
            $this->setStatusCode(206);
            $this->headers->set('Content-Range', sprintf('bytes %s-%s/%s', $start, $end, $size));
            $this->headers->set('Content-Length', $end - $start + 1);
        }
    }

    /**
     * Check is the request header hav valid range
     * 
     * @param mixed $header 
     * @return bool 
     * @throws RuntimeException 
     */
    private function hasValidIfRangeHeader($header)
    {
        if ($this->getEtag() === $header) {
            return true;
        }
        if (null === ($lastModified = $this->getLastModified())) {
            return false;
        }
        return $lastModified->format('D, d M Y H:i:s') . ' GMT' === $header;
    }

    public function __destruct()
    {
        if ($this->stream) {
            $this->stream->close();
        }
    }
}
