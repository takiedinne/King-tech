<?php

session_start();
include_once('../db.php');
LogInCheck();

require_once('../vendor/autoload.php');
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

function write_invoice($invoice_id, $items_name, $quantities, $unit_price, $customer_name){
  
    
    $templateProcessor = new TemplateProcessor("../PHPWord/invoice_template.docx");
    $templateProcessor->setValue('INVOICENUM', $invoice_id);
    $templateProcessor->setValue('CUSTOMERNAME', $customer_name);
    $templateProcessor->setValue('DATE', date("Y/m/d"));
    $templateProcessor->setValue('CASHIER', $_SESSION['user_name']);

    $templateProcessor->cloneRow('ITEM', count($items_name));
    $i = 1;
    $total = 0;
    
    foreach ($items_name as $item){
        //$templateProcessor->setValue('N#'.$i, $i);
        $templateProcessor->setValue('ITEM#'.$i, $item);
        $templateProcessor->setValue('QUANTITY#'.$i, $quantities[$i-1]);
        $templateProcessor->setValue('UNITPRICE#'.$i, $unit_price[$i-1]);
        $templateProcessor->setValue('UNITQUANTITY#'.$i, $quantities[$i-1] * $unit_price[$i-1]);

        $total += $quantities[$i-1] * $unit_price[$i-1];
        $i+= 1;
    }
    $templateProcessor->setValue('TOTAL', $total);
    $templateProcessor->setValue('PAID', $total);
    $templateProcessor->setValue('REST', '0,0 DA');
    $templateProcessor->setValue('NPROD', count($items_name));
    
    $pathToSave = '../PHPWord/invoice.docx';
    $templateProcessor->saveAs($pathToSave);
    //return 'http://'.$_SERVER['SERVER_ADDR'].'/stock-management/assets/invoice.docx';
    return URLROOT.'/PHPWord/invoice.docx';
} 

if (isset($_SESSION['role'])){
    //var_dump($_POST);
    // Suivi d'études par matière
    if (isset($_POST['get_invoice'])) {
        $items_id = $_POST['items_id'];
        $quantities = $_POST['quantities'];
        $unit_prices = $_POST['unit_prices'];
        $customer_id = $_POST['customer_id'];
        // save the invoice
        //construct the invoice number
        $date = date("Ymd");
        //get the number of invoice today
        $sql_number_invoice = "SELECT COUNT( * ) as nbr FROM `invoice` WHERE `date` = CURDATE()";
        $res_number_invoice =  $conn->query($sql_number_invoice);
        $nbr_invoice= 1 ;
        if( $row = $res_number_invoice->fetch_assoc()){
            $nbr_invoice = $row['nbr'] + 1;
        }
        $invoice_id =  $date . sprintf('%06d', $nbr_invoice);
        
        //save  the invoice
        $sql_insert_invoice = "INSERT INTO `invoice`(`invoice_id`, `customer_id`, `date`, `time`, `user_id`) VALUES ('$invoice_id',$customer_id , CURDATE(), CURRENT_TIME(), " . $_SESSION['user_id'] . " )";
         
        if ($conn->query($sql_insert_invoice) === TRUE) {
            
            //save the invoice_item
            $invoice_item_values = "";
            $first = TRUE;
            for ($i = 0; $i < count($items_id); $i++) {
                if ($first === TRUE) {
                    $first = FALSE;
                } else {
                    $invoice_item_values = $invoice_item_values . ",";
                }
                $invoice_item_values = $invoice_item_values . "($invoice_id, $items_id[$i], $quantities[$i], $unit_prices[$i])";
            }
            $sql_insert_invoice_item = "INSERT INTO `invoice_item`(`invoice_id`, `item_id`, `quantity`, `unit_price`) VALUES" . $invoice_item_values;
            
            if ($conn->query($sql_insert_invoice_item) === TRUE) {
                //update the quantities 
                for ($i = 0; $i < count($items_id); $i++ ){
                    $sql_update = "UPDATE `item` SET `item_quantity`= `item_quantity` - $quantities[$i] WHERE `item_id` = $items_id[$i];";
                    $conn->query($sql_update);
                }
                // generate the invoice documents
                //get the items names
                $ids = "";
                $first = TRUE;
                foreach ($items_id as $item) {
                    if ($first == TRUE) {
                        $first = FALSE;
                    } else {
                        $ids .= ", ";
                    }
                    $ids .= $item;
                }
                
                $sqlItemNames = "SELECT * FROM `item` WHERE `item_id` in ($ids)";
                
                $resItemnames =$conn->query($sqlItemNames);
                $items_names = array();
                while($row = $resItemnames ->fetch_assoc()){
                    
                    array_push($items_names, $row['item_name']);
                }
                //get customer name 
                $sqlCustomerName = "SELECT `customer_firstname`, `customer_surname` FROM `customer` WHERE `customer_id` = $customer_id ";
                $resCustomerName = $conn->query($sqlCustomerName);
                $customerName = "UNKNOWN";

                if($row = $resCustomerName->fetch_assoc()){
                    $customerName = $row['customer_firstname'] .' '. $row['customer_surname'];
                }
                echo write_invoice($invoice_id, $items_names, $quantities, $unit_prices, $customerName); 
                 
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }

        //return the invoice documents
       
    }
    elseif (isset($_POST['edit_invoice'])){
        $invoice_id = $_POST['invoice_id'];
        $item_id = $_POST['item_id'];
        
        // increement the quantity
        $sql = "UPDATE `item` SET `item_quantity`= `item_quantity` + (SELECT `quantity` FROM `invoice_item` 
                                    WHERE ".$invoice_id." AND `item_id` = ".$item_id.") WHERE `item_id` = ".$item_id;
        if($conn ->query($sql)){
            $sql = "DELETE FROM `invoice_item` WHERE `invoice_id` = ".$invoice_id." AND `item_id` = ".$item_id;
            //use for MySQLi OOP
            if($conn->query($sql)){
                echo 1;
                $_SESSION['success'] = 'Item deleted successfully';
            }
            else
            {
                $_SESSION['error'] = 'Something went wrong in deleting member query. You need to delete all the buying and selling operations';
            }
        }else{
            $_SESSION['error'] = 'Something went wrong whene trying to increment the quantity.';
        }
    }
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
