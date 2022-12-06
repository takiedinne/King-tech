<?php
require_once '../bootstrap.php';
//only POST request is accepted

if($_SERVER['REQUEST_METHOD'] === 'POST')
{   
    //csrf protection 
    if(!(Token::verify($_POST['token'])))
    {
        $_SESSION['error'] = 'Session Has Expired!!!';
        header('location: '.URLROOT.'/index.php');
    }
    
    // Sanitize POST array
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //var_dump($_POST);
    $_id = $_POST['id'];
    $_password = $_POST['password'];
    
    //connect db
    require_once '../db.php';
    $sql = "SELECT * FROM  `user` WHERE `user_name`='" . $_id . "' AND `password`='" . $_password . "'";
    $result = $conn->query($sql);
     //print_r($result);

    //if result is true
    if($result == true){
        if(!($result->num_rows == 1)) {
            $_SESSION['error'] = 'Wrong Credentials !!!';
            header('location: '.URLROOT.'/index.php');
        }
        else
        {   
            /*if returns single row*/
            $row = $result->fetch_assoc();
            //var_dump($row);
            if($row['user_role'] == 1)
            {
                //set session
                $_SESSION['user_name'] = $row['user_firstname'];
                $_SESSION['user_psudoname'] = $row['user_name'];
                $_SESSION['user_surname'] = $row['user_surname'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = 'admin';
                $_SESSION['success'] = 'welcome ' . $row['user_name'] . ' to admin home page';
                $_SESSION['connected'] = true;

                //if role is admin redirect to admin home=
                header('location: '.URLROOT.'/admin_home.php');
            }
            else
            {   
                //set session
                $_SESSION['user_name'] = $row['user_firstname'];
                $_SESSION['user_psudoname'] = $row['user_name'];
                $_SESSION['user_surname'] = $row['user_surname'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = 'guest';
                $_SESSION['success'] = 'welcome ' . $row['user_firstname'] . ' to admin home page';
                $_SESSION['connected'] = true;

                //redirect to gen user home
                header('location: '.URLROOT.'/admin_home.php');
            }
        }
    }
    //close connection
    $conn->close();
}
else
{
    $_SESSION['error'] = 'Something went wrong';
    //echo '<script>alert("login failed try again");</script>';
    header('location: '.URLROOT.'/index.php');
}
