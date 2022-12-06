<?php
//login helper
/**
 * @author rofi
 * @desc redirects to login page
 *       if not logged in.
 */
function LogInCheck()
{
   //if user is not logged in through them to index
    if(!isset($_SESSION['user_id'])){
        $_SESSION['error'] = 'please log in first';
        header('location: '.URLROOT.'/');
    }
}
