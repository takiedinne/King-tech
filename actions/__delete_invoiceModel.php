<?php
require_once '../bootstrap.php';

/**
 * do not let anyone play with your URLs :>
 *
 */
LogInCheck();

if(isset($_POST['invoice_id'])){
    require_once '../db.php';
    // step 1: return the items to the stock
    $sql_return_items ="UPDATE `item` as i SET `item_quantity` = `item_quantity` + (SELECT `quantity` FROM `invoice_item` WHERE `invoice_id`= '".$_POST['invoice_id']."' AND `item_id` = i.`item_id` ) WHERE `item_id` = (SELECT `item_id` FROM `invoice_item` WHERE `invoice_id` = '".$_POST['invoice_id']."');";

    //step 2: delete all the items for the invoice first
    $sql_invoice_item = "DELETE FROM `invoice_item` WHERE `invoice_id` = '".$_POST['invoice_id']."'";

    //step 3: delete the payments
    $sql_payment = "DELETE FROM `invoice_payment` WHERE `invoice_id` = '".$_POST['invoice_id']."'";
    
    //step 4: delete the invoice
    $sql = "DELETE FROM `invoice` WHERE `invoice_id` = '".$_POST['invoice_id']."'";
    //use for MySQLi OOP
    try{
        $conn->query($sql_return_items);
        $conn->query($sql_payment);
        $conn->query($sql_invoice_item);
        $conn->query($sql);
        echo 0;
    }catch (Exception $e){
        echo -1;
    }
}
else{
    $_SESSION['error'] = 'Select member to delete first';
}

//header('location: ../items.php');