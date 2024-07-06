<?php
require_once '../bootstrap.php';
LogInCheck();
//only POST request is accepted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //trim values from POST
    $item_name = trim($_POST['item_name']);
    $item_cat = trim($_POST['item_category']);
    $codebar = trim($_POST['BarCode']);
    $threshold = trim($_POST['threshold']);
    $quantity = trim($_POST['quantity']);
    $pricemin = trim($_POST['pricemin']);
    $pricemax = trim($_POST['pricemax']);

    //clean up variables
    $quantity = $quantity == "" ? 0 : $quantity;

    $response_code = 0;
    //connect to db
    require_once '../db.php';

    
    //check if the item alreadu exists:
    $sql = "SELECT * FROM `item` WHERE UPPER(`item_name`) = UPPER('".$item_name."')";
    $sql .= $codebar != "" ? " OR UPPER(`barre_code`) = UPPER('".$codebar."')" : "";
    
    //perform query
    $query = $conn->query($sql);
   
    if ($query->num_rows == 0) {
        //perform query
        $sql = "INSERT INTO `item`(`item_name`, `barre_code`, `item_quantity`, `item_cat`, `threshold`) VALUES 
        ('" . $item_name . "','" . $codebar . "','" . $quantity . "','" . $item_cat . "','" . $threshold . "')";

        //echo $sql . "\n";

        $query = $conn->query($sql);
        
        $affected = $conn->affected_rows;
        if ($affected == 1) {

            if ($pricemax != "" && $pricemin != "") {
                $sql = " INSERT INTO `item_price`(`item_id`, `accreditation_date`, `price_max`, `price_min`) VALUES ( LAST_INSERT_ID(),
                CURDATE()," . $pricemax . "," . $pricemin . ")
                ON DUPLICATE KEY UPDATE price_max = " . $pricemax . ", price_min = " . $pricemin;

                $query = $conn->query($sql);
                
                $affected = $conn->affected_rows;
                
                //echo $sql . "\n";


                if ($query == true) {
                    $_SESSION['success'] = 'item added successfully';
                //header('location: ../items.php');
                }
                else {
                    $_SESSION['error'] = 'Something went wrong while adding prices!';
                    $response_code = -2;
                }
            }
            else {
                $_SESSION['success'] = 'item added successfully';
                $response_code = 0;
            }

        }
        else {
            $_SESSION['error'] = 'something went wrong';
            $response_code = -3;
        }
    }else {
        $_SESSION['error'] = 'There is already an item with the same name or Bare code!';
        $response_code = -1;
    }

}
else {
    $_SESSION['error'] = 'Something went wrong while adding items';

}
if (!isset($_POST['add_new_item'])) {
    header('location: ' . URLROOT . '/items.php');
}
else {
    //unset all sessions messages;
    unset($_SESSION['error']);
    unset($_SESSION['success']);
    echo $response_code;
}