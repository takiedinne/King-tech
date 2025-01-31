<?php
require_once '../bootstrap.php';

/**
 * do not let anyone play with your URLs :>
 *
 */
LogInCheck();

if(isset($_POST['customer_id'])){
    require_once '../db.php';
    $sql = "DELETE FROM `customer` WHERE `customer_id` = '".$_POST['customer_id']."'";
    try{
        if($conn->query($sql) == true){
            echo 0;
        }
        else {
            echo -2;
        }
    }catch (Exception $e){
        echo -1;
    }
}
else{
    $_SESSION['error'] = 'Select customer to delete first';
}
