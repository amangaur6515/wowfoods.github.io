<?php
        //Start Session
        session_start();
        


        //create   constant to store non-repeating values
        define('SITEURL','http://localhost/food-order/');
        define('LOCALHOST','localhost');
        define('DB_USERNAME','root');
        define('DB_PASSWORD','');
        define('DB_NAME','food-order');



        
        //establish connection  ('localhost','username','password')
        $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        //         mysqli_select_db($conn,'DBNAME')
        $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
        //$res=mysqli_query($conn,$sql) or die(mysqli_error());

?>