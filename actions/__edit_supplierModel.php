<?php
require_once '../bootstrap.php';
LogInCheck();
    //only POST request is accepted
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //print_r($_POST);
    
    //trim the values
    $supplier_id = $_POST['supplier_id'];
    $supplier_firstname = trim($_POST['supplier_firstname']);
    $supplier_surname = trim($_POST['supplier_surname']);
    $supplier_address = trim($_POST['supplier_address']);
    $supplier_telephone = trim($_POST['supplier_telephone']);
    $supplier_email = trim($_POST['supplier_email']);

    //connect to db
    require_once '../db.php';
    $sql = " UPDATE `supplier` SET `supplier_firstname` = '" . $supplier_firstname. "', `supplier_surname` = '" . $supplier_surname. "', `supplier_address` = '" .$supplier_address. "',
                     `supplier_telephone` = '" .$supplier_telephone. "', `supplier_mail` = '" .$supplier_email. "'
                      WHERE `supplier`.`supplier_id` = '" .$supplier_id. "'";

    
    $query = $conn->query($sql);
    
    if($query === true)
    {
        $_SESSION['success'] = 'supplier updated successfully';
    }
    else
    {
        $_SESSION['error'] = 'Something went wrong while updating supplier';
    }

    //redirect to item home
    header('location: ../suppliers.php');
}
else
{
    $_SESSION['error'] = 'Something went wrong while updating item';
    header('location: '.URLROOT.'/suppliers.php');
}
