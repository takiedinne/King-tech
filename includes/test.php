<?php
echo 'Hello World';
$var =  tempnam('../PHPWord/PhpWordTemp', 'PHPWord');
var_dump($var);

/* require_once '../vendor/autoload.php'; // Path to autoload.php

use PhpOffice\PhpWord\TemplateProcessor;

// Create a new TemplateProcessor object
$templateProcessor = new TemplateProcessor('../PHPWord/invoice_template.docx');

// Generate a random barcode value
$barcodeValue = '123456789';

// Add the barcode value to the template document
$templateProcessor->setValue('barcode', $barcodeValue);

// Save the modified Word document
$templateProcessor->saveAs('output.docx');

echo 'Barcode Word document generated successfully!'; */
?>
