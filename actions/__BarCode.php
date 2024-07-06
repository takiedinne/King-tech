<?php

session_start();
include_once('../db.php');
LogInCheck();

require_once('../vendor/autoload.php');

use PhpOffice\PhpWord\TemplateProcessor;
use Picqer\Barcode\BarcodeGeneratorPNG;


function generateRandomBarcode($length) {
    // Generate a random number of specified length
    return str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
}

if (isset($_SESSION['role'])){
    //var_dump($_POST);
    // Suivi d'études par matière
    if (isset($_POST['BarCode'])) {
        
        //look up for the code bar from the item table
        $sql_item = "SELECT barre_code FROM `item`  WHERE `item_id` = ".$_POST['item_id'];
        $item_query = $conn->query($sql_item);
        $row_item = $item_query->fetch_assoc();
        if ($row_item['barre_code'] == null){
            
            $barcodeLength = 18;
            
            $barcode = generateRandomBarcode($barcodeLength);
            
            $sql_update = "UPDATE `item` SET `barre_code` = '$barcode' WHERE `item_id` = ".$_POST['item_id'];
            $conn->query($sql_update);
            
            $row_item['barre_code'] = $barcode;
        }

        $barcodeGenerator = new BarcodeGeneratorPNG();
       
        // Generate the barcode image
        $barcodeImage = $barcodeGenerator->getBarcode($row_item['barre_code'], $barcodeGenerator::TYPE_CODE_128);
        
        file_put_contents('../PHPWord/barcode.png', $barcodeImage);
        
        
        $templateProcessor = new TemplateProcessor("../PHPWord/bar_code_template.docx");
    
        // Add the barcode image to the Word document
        $templateProcessor->setImageValue('image.jpg', array('path' => '../PHPWord/barcode.png', 'width' => 100, 'height' => 50));
        $templateProcessor->setValue('code_bar', $row_item['barre_code']);
        // Save the modified Word document
        $templateProcessor->saveAs('../PHPWord/barcode.docx');
        
        echo URLROOT.'/PHPWord/barcode.docx';
    }
    elseif (isset($_POST['GetRandomBarCode'])){
        $barcodeLength = 18;
            
        $barcode = generateRandomBarcode($barcodeLength);

        //check that the generated bar code is not used before
        $sql = "SELECT * FROM `item` WHERE `barre_code` = '$barcode'";
        $query = $conn->query($sql);
        //echo $query->num_rows;
        while ($query->num_rows != 0){
            $barcode = generateRandomBarcode($barcodeLength);
            $sql = "SELECT * FROM `item` WHERE `barre_code` = '$barcode'";
            $query = $conn->query($sql);
        }
        echo $barcode;
    }
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
