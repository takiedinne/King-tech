<?php

    require_once '../bootstrap.php';
    require_once '../db.php';
    //only POST request is accepted
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Sanitize POST array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //print_r($_POST);

        //trim the values
        $item_id = $_POST['item_id'];
        $item_name = trim($_POST['item_name']);
        $item_cat = trim($_POST['item_category']);
        $item_ref = trim($_POST['reference']);
        $pricemin = $_POST['pricemin'];
        $pricemax = $_POST['pricemax'];
        $quantity = $_POST['quantity'];
        
        $sql = " UPDATE `item` SET `item_name` = '" .$item_name. "',`item_cat` = '" .$item_cat."', `item_reference` = '" .$item_ref. "', `item_quantity` = '" .$quantity. "'  WHERE `item`.`item_id` = '" .$item_id. "'";
        $query = $conn->query($sql);
        if($query == true)
        {
            $sql = " INSERT INTO `item_price`(`item_id`, `accreditation_date`, `price_max`, `price_min`) VALUES (".$item_id.", CURDATE(),".$pricemax.",".$pricemin.")
            ON DUPLICATE KEY UPDATE price_max = ".$pricemax.", price_min = ".$pricemin;
            
            $query = $conn->query($sql);
            if($query == true){
                $_SESSION['success'] = 'item updated successfully';
            }
            else{
                $_SESSION['error'] = 'Something went wrong while updating item';
            }
        }

        else
        {
            $_SESSION['error'] = 'Something went wrong while updating item';
        }

        //redirect to item home
        header('location: '.URLROOT.'/items.php');
   }
   else
   {
       //$_SESSION['error'] = 'Something went wrong while updating item';
       //header('location: ../items.php');
   }





