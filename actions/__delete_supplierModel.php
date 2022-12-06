<?php
require_once '../bootstrap.php';

/**
 * do not let anyone play with your URLs :>
 *
 */
LogInCheck();

if(isset($_POST['supplier_id'])){
    require_once '../db.php';
    $sql = "DELETE FROM `supplier` WHERE `supplier_id` = '".$_POST['supplier_id']."'";
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
    $_SESSION['error'] = 'Select supplier to delete first';
}
