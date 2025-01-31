<?php
require_once '../bootstrap.php';
require_once '../db.php';
LogInCheck();
    //only POST request is accepted
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //print_r($_POST);
    
    //trim the values
    $customer_id = $_POST['customer_id'];
    $customer_firstname = trim($_POST['customer_firstname']);
    $customer_surname = trim($_POST['customer_surname']);
    $customer_address = trim($_POST['customer_address']);
    $customer_telephone = trim($_POST['customer_telephone']);
    $customer_email = trim($_POST['customer_email']);

    $sql = " UPDATE `customer` SET `customer_firstname` = '" . $customer_firstname. "', `customer_surname` = '" . $customer_surname. "', `customer_address` = '" .$customer_address. "',
                     `customer_telephone` = '" .$customer_telephone. "', `customer_email` = '" .$customer_email. "'
                      WHERE `customer`.`customer_id` = '" .$customer_id. "'";
    
    
    $query = $conn->query($sql);
   
    $affected = $conn->affected_rows;
    if($affected > 0)
    {
        /* $_SESSION['success'] = 'customer updated successfully'; */
        echo 1;
    }
    else
    {
        /* $_SESSION['error'] = 'Something went wrong while updating customer'; */
        echo -1;
    }
}
else
{
    $_SESSION['error'] = 'Something went wrong while updating item';
    header('location: '.URLROOT.'/customers.php');
}
