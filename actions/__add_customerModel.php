<?php
require_once '../bootstrap.php';
LogInCheck();
//only POST request is accepted
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //print_r($_POST);


    //trim the values
    $customer_firstname = trim($_POST['firstname']);
    $customer_surname = trim($_POST['surname']);
    $customer_address = trim($_POST['address']);
    $customer_telephone = trim($_POST['telephone']);
    $customer_email = trim($_POST['email']);

    //connect to db
    require_once '../db.php';

    // check if there is no supplier in the data base with the same name 
    $sql = "SELECT * FROM `customer` WHERE  LOWER(`customer_firstname`) = LOWER(\"".$customer_firstname."\") AND LOWER(`customer_surname`) = LOWER(\"".$customer_surname."\") ";
    $query = $conn->query($sql);
    if(mysqli_num_rows($query)>0)
    {
        $_SESSION['error'] = 'Warning: there is a customer with the same name '.$supplier_name;
        //redirect to item home
        echo -1;
        return;
    }
    
    $sql = "INSERT INTO `customer` (`customer_firstname`, `customer_surname`, `customer_address`, `customer_telephone`, `customer_email`) 
                VALUES ('" . $customer_firstname . "', '" . $customer_surname . "',' " . $customer_address . "',' " . $customer_telephone . "',' " . $customer_email . "')";
    $query = $conn->query($sql);
    //var_dump($query);

    if($query == true)
    {
        $_SESSION['success'] = 'customer added successfully';
        //redirect to item home
        echo 1;
        return;
    }
    else
    {
        $_SESSION['error'] = 'Something went wrong while adding supplier';
        //redirect to item home
        echo -2;
        return;
    }
    

}
else
{
    $_SESSION['error'] = 'Something went wrong while adding supplier';
    header('location: '.URLROOT.'/suppliers.php');
}
