<?php
//as bootstrap.php loads these helpers the session is started automatically
session_start();
//this is used flush message
//example flash();
function flash()
{
  $error_toast = "";
  $success_toast = "";
  $info_toast = "";
  //display on error
  if (isset($_SESSION['error'])) {
    $error_toast ="create_toast('Error','".$_SESSION['error']."');";
    unset($_SESSION['error']);
  }


  //display on success
  if (isset($_SESSION['success'])) {
    $success_toast ="create_toast('Error','".$_SESSION['success']."');";
    unset($_SESSION['success']);
  }


  //display on info
  if (isset($_SESSION['info'])) {
    $info_toast ="create_toast('Error','".$_SESSION['info']."');"; 
    unset($_SESSION['info']);
  }
  echo "<script>
          $(document).ready(function() {
              ".$error_toast."
              ".$success_toast."
              ".$info_toast."
          });
      </script>";
}
?>
