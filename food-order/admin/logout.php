<?php
//include constants.php for siteurl
    include('../config/constants.php');
     //destroy the session 
     session_destroy(); //unsets $_session['user]

     //redirect to login pagse
     header('location:'.SITEURL.'admin/login.php');

?>