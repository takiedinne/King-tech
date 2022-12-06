<?php
require_once '../bootstrap.php';

/**
 * do not let anyone play with your URLs :>
 *
 */
LogInCheck();

if(isset($_POST['item_id'])){
    require_once '../db.php';
    $sql_delete_item_price = "DELETE FROM `item_price` WHERE `item_id` = '".$_POST['item_id']."' AND `item_id` NOT IN (SELECT item_id FROM item_supply);";
    $sql = "DELETE FROM `item` WHERE `item_id` = '".$_POST['item_id']."' AND `item_id` NOT IN (SELECT item_id FROM item_supply)";
    //use for MySQLi OOP
    try{
        $conn->query($sql_delete_item_price);
        $conn->query($sql);
        if (mysqli_affected_rows($conn)!=0){
            echo 0;
        }else {
            echo -2;
        }
    }catch (Exception $e){
        echo -1;
    }
}
else{
    $_SESSION['error'] = 'Select member to delete first';
}

//header('location: ../items.php');