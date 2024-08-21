# Library Documentation

This library is build on top of [https://github.com/dompdf/dompdf] PHP library for converting html document to PDF. It provides users with API for reading document from file path, psr7 stream object or even PHP SplFileInfo class. It also provides developpers with a response object that inherit from symfony HTTP response object for returns PDF as response.

## Installation

The library is build with composer requirements in mind and requires `composer` package manager for installation. To install the library to your PHP project:

> composer require drewlabs/php-dompdf

## Usage

To create a PDF instance, use the proxy function provides by the package:

```php
use function  Drewlabs\Dompdf\Proxy\DomPdf;

const pdf = DomPdf([/* DOMPdf otpions */]);
```

The package provides a factory class for creating DOMPdf instances. For Object Oriented enthousiast, creating a dom-pdf instance is simply as:

```php
use Drewlabs\Dompdf\Factory;

$factory = new Factory;

const pdf = $factory->create([/* DOMPdf otpions */]);
```

- Reading DOM string

The `Dompdf` provides developper with various method for loading DOM string from system path, `SplFileInfo` instance, psr7 compatible stream object or inline string.

-- Generic method

For all mentionned above types, the library provide a single method for reading dom string:

```php
use function  Drewlabs\Dompdf\Proxy\DomPdf;
use Nyholm\Psr7\Factory\Psr17Factory;

const pdf = DomPdf([/* DOMPdf otpions */]);

// Reading DOM string from \SplFileInfo
$document = new \SplFileInfo;
$pdf = $pdf->read($document);

// Reading from Psr7 compatible stream
$document = (new Psr17Factory)->createStreamFromFile($pathOrStream);
$pdf = $pdf->read($document);

// Reading from disk path
$pdf = $pdf->read('/home/users/dev/documents/document.pdf');

// Read from raw string
$pdf = $pdf->read("
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
        <title>Document</title>
    </head>
    <body></body>
    </html>"
);

// Read from URI resource
$pdf = $pdf->read("https://www.google.com");
```

Aside the generic method `Domdfp::read`, the library provides a 2 additional method for reading raw string or url resource.

```php
use function  Drewlabs\Dompdf\Proxy\DomPdf;

$pdf = DomPdf([/* DOMPdf otpions */]);
$pdf->html(" ... html string");


// To load content from URI resource
$pdf = $pdf->resource('file:///home/users/dev/documents/document.pdf');
```

### Utility methods

- Set pdf orientation

`setPaperOrientation($size, $orientation)` is the API provided to modify the paper size and orientation.

> size : Drewlabs\Dompdf\Size::LETTER, Drewlabs\Dompdf\Size::LEGAL, Drewlabs\Dompdf\Size::A4
> orientation : Drewlabs\Dompdf\Orientation::LANDSCAPE, Drewlabs\Dompdf\Orientation::PORTRAIT

```php
// ...
$pdf = DomPdf([/* DOMPdf otpions */]);

$pdf->constraints(Drewlabs\Dompdf\Size::A4, \Drewlabs\Dompdf\Orientation::PORTRAIT);
```

- Print PDF content

The library provides developper with a method to return the generated PDF string through the `Dompdf::print` API. To print a raw document:

```php
$pdf = DomPdf([/* DOMPdf otpions */]);

$pdf->print(); // Returns a raw string
```

- Http response

The `Dompdf::download(string $name)` API allows developper to create a response object from the PDF content.

```php

$pdf = DomPdf([/* DOMPdf otpions */]);
// It's a late content read, meaning it does not send content to request client unless
// user code manually call send() on the response object
$response = $pdf->download(); // Symfony HTTP response

// To send the response to request client, developper must call $response->send() method
$response->prepare(new Request::createFromGlobals())->send();
```

- Streaming content

The library provides developper with method to streaming pdf content to request client.

```php

$pdf = DomPdf([/* DOMPdf otpions */]);

$pdf->stream(); // Internally uses PHP echo method to write to the output buffer
```
