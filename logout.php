<?php
require_once 'bootstrap.php';
LogInCheck();
//unset session
unset($_SESSION['user_name']);
unset($_SESSION['user_id']);
unset($_SESSION['role']);
unset($_SESSION['connected']);



//redirect to log in page
$_SESSION['success'] = 'you have successfully logged out';
header('location: '.URLROOT.'/index.php');


