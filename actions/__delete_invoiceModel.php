<?php
require_once '../bootstrap.php';

/**
 * do not let anyone play with your URLs :>
 *
 */
LogInCheck();

if(isset($_POST['invoice_id'])){
    require_once '../db.php';
    // delete all the items for the invoice first
    $sql_invoice_item = "DELETE FROM `invoice_item` WHERE `invoice_id` = '".$_POST['invoice_id']."'";
    $sql = "DELETE FROM `invoice` WHERE `invoice_id` = '".$_POST['invoice_id']."'";
    //use for MySQLi OOP
    try{
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