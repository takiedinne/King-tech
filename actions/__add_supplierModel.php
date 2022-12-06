<?php
require_once '../bootstrap.php';
LogInCheck();
//only POST request is accepted

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //print_r($_POST);


    //trim the values
    $supplier_firstname = trim($_POST['supplier_firstname']);
    $supplier_surname = trim($_POST['supplier_surname']);
    $supplier_address = trim($_POST['supplier_address']);
    $supplier_telephone = trim($_POST['supplier_telephone']);
    $supplier_email = trim($_POST['supplier_email']);

    //connect to db
    require_once '../db.php';

    // check if there is no supplier in the data base with the same name 
    $sql = "SELECT * FROM `supplier` WHERE  LOWER(`supplier_firstname`) = LOWER(\"".$supplier_firstname."\") AND LOWER(`supplier_surname`) = LOWER(\"".$supplier_surname."\") ";
    $query = $conn->query($sql);
    if(mysqli_num_rows($query)>0)
    {
        $_SESSION['error'] = 'Warning: there is a supplier with the same name '.$supplier_name;
        //redirect to item home
        if(isset($_POST['add_new_supplier'])){
            echo -1;
            return;
        }else{
            header('location: '.URLROOT.'/suppliers.php');
        }
    }
    
    $sql = "INSERT INTO `supplier` (`supplier_firstname`, `supplier_surname`, `supplier_address`, `supplier_telephone`, `supplier_mail`) 
                VALUES ('" . $supplier_firstname . "', '" . $supplier_surname . "',' " . $supplier_address . "',' " . $supplier_telephone . "',' " . $supplier_email . "')";
    $query = $conn->query($sql);
    //var_dump($query);

    if($query == true)
    {
        $_SESSION['success'] = 'supplier added successfully';
        //redirect to item home
        if(isset($_POST['add_new_supplier'])){
            echo 1;
            return;
        }else{
            header('location: '.URLROOT.'/suppliers.php');
        }
    }
    else
    {
        $_SESSION['error'] = 'Something went wrong while adding supplier';
        //redirect to item home
        if(isset($_POST['add_new_supplier'])){
            echo -2;
            return;
        }else{
            header('location: '.URLROOT.'/suppliers.php');
        }
    }
    

}
else
{
    $_SESSION['error'] = 'Something went wrong while adding supplier';
    header('location: '.URLROOT.'/suppliers.php');
}
