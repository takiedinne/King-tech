<?php

session_start();
include_once('../db.php');
LogInCheck();

require_once('../vendor/autoload.php');

use PhpOffice\PhpWord\TemplateProcessor;
use Picqer\Barcode\BarcodeGeneratorPNG;


if (isset($_SESSION['role'])){
    //var_dump($_POST);
    // Suivi d'études par matière
    if (isset($_POST['ShoopingList'])) {
        
        //get the items
        $sql_item = "SELECT * FROM `item` WHERE `item_quantity` <= `threshold`;";
        //var_dump($sql_item);
        $item_query = $conn->query($sql_item);
        
        
        $items = array();
        $quantity = array();
        while($row = $item_query -> fetch_assoc()){
            array_push($items, $row['item_name']);
            array_push($quantity, $row['item_quantity']);
        }
        
        $templateProcessor = new TemplateProcessor("../PHPWord/shooping_list_template.docx");
    
        //clone rows 
        $templateProcessor->cloneRow('item_name', count($items));
        
        
        // Add the barcode image to the Word document
        for ($i = 1; $i <= count($items); $i++){
            
            $templateProcessor->setValue('N#'.($i), $i);
            $templateProcessor->setValue('item_name#'.($i), $items[$i]);
            $templateProcessor->setValue('available#'.($i), $quantity[$i]);
        }
        // Save the modified Word document
        $templateProcessor->saveAs('../PHPWord/shoopingList.docx');
        
        echo URLROOT.'/PHPWord/shoopingList.docx';
    }
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
