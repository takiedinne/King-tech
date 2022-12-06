<?php

session_start();
include_once('../db.php');
LogInCheck();

require_once('../vendor/autoload.php');
use PhpOffice\PhpWord\TemplateProcessor;


if (isset($_SESSION['role'])){
    //var_dump($_POST);
    // Suivi d'études par matière
    if (isset($_POST['set_purchase'])) {
        
        $items_id = $_POST['items_id'];
        $quantities = $_POST['quantities'];
        $unit_prices = $_POST['unit_prices'];
        $supplier_id = $_POST['supplier_id'];
        $supply_invoice_id = isset($_POST['suuplier_invoice_id']) ? $_POST['suuplier_invoice_id'] : -1;
        // save the invoice
        //construct the invoice number
        if($supply_invoice_id === -1){
            $date = date("Ymd");
            //get the number of invoice today
            $sql_number_invoice = "SELECT COUNT( DISTINCT(`supply_invoice_id`) ) as nbr FROM `supply_invoice` WHERE `date` = CURDATE()";
            $res_number_invoice = $conn->query($sql_number_invoice);
            $nbr_invoice = 1;
            if ($row = $res_number_invoice->fetch_assoc()) {
                $nbr_invoice = $row['nbr'] + 1;
            }
            $supply_invoice_id = 'S'.$date . sprintf('%06d', $nbr_invoice);
        }
        
        //save  the invoice
        $sql_insert_invoice = "INSERT INTO `supply_invoice`(`supply_invoice_id`, `supplier_id`, `date`, `time`, `user_id`) VALUES ('$supply_invoice_id',$supplier_id , CURDATE(), CURRENT_TIME(), " . $_SESSION['user_id'] . " )";
         
        if ($conn->query($sql_insert_invoice) === TRUE) {
           
            //save the supply_invoice_item
            $invoice_item_values = "";
            $first = TRUE;
            for ($i = 0; $i < count($items_id); $i++) {
                if ($first === TRUE) {
                    $first = FALSE;
                } else {
                    $invoice_item_values = $invoice_item_values . ",";
                }
                $invoice_item_values = $invoice_item_values . "('$supply_invoice_id', $items_id[$i], $quantities[$i], $unit_prices[$i])";
            }
            $sql_insert_invoice_item = "INSERT INTO `item_supply`(`supply_invoice_id`, `item_id`, `quantity`, `unit_price`)
                             VALUES " . $invoice_item_values;
            if ($conn->query($sql_insert_invoice_item) === TRUE) {
                //increment the quantities in the items store
                for ($i = 0; $i < count($items_id); $i++ ){
                    $sql_update = "UPDATE `item` SET `item_quantity`= `item_quantity` + $quantities[$i] WHERE `item_id` = $items_id[$i];";
                    $conn->query($sql_update);
                }
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }

        //return the invoice documents
       
    }
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
