<?php
   //authorization access control
   //check whether the user is logged in or not
   if(!isset($_SESSION['user'])) //if useer session is not set 
   {
        //user is not logged in 
        //redirect to login pages
        $_SESSION['no-login-message']="<div style='color:red;'>Please login to access admin panel.</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
   }
?>

