<?php
require_once '../bootstrap.php';

/**
 * do not let anyone play with your URLs :>
 *
 */
LogInCheck();

if(isset($_POST['supply_invoice_id'])){
    require_once '../db.php';
    // delete all the items for the invoice first
    $sql = "DELETE FROM `item_supply` WHERE `supply_invoice_id`= '".$_POST['supply_invoice_id']."' AND `item_id`= " . $_POST['item_id'];
    $sql_supply_invoice = "DELETE FROM `supply_invoice` WHERE `supply_invoice_id` = '".$_POST['supply_invoice_id']."'";
    $sql_nbr_item = "SELECT COUNT(*) as nbr FROM `item_supply` WHERE `item_supply`.`supply_invoice_id` =  '".$_POST['supply_invoice_id']."' GROUP BY`supply_invoice_id`";
    try{
        $conn->query($sql);
        //check if the supply invoice is empty now
        $res = $conn->query($sql_nbr_item);
        if( !$res->fetch_assoc()){
            $conn->query($sql_supply_invoice);
        } 
        echo 0;
    }catch (Exception $e){
        echo -1;
    }
}
else{
    $_SESSION['error'] = 'Select member to delete first';
}

//header('location: ../items.php');