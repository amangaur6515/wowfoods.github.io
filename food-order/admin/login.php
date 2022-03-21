<?php include("../config/constants.php");
?>


<html>
    <head> 
        <title>Login - Food Order System</title>
        <link rel="stylesheet"  href="..CSS/admin.css">

    </head>
    <body>
        <div style="width: 30%; border: 1px solid grey; margin:10% auto; padding:2%;">
        
            <h1 style="text-align: center;">Login</h1>
            <?php
                if(isset($_SESSION['login']))
                { 
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                if(isset($_SESSION['no-login-message']))
                { 
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
                ?> 
        <br>
            <!--login form starts here-->
            <form action="" method="POST" style="text-align:center;">
            Username:
            <br>
            <input type="text " name="username" placeholder="Enter Username">
            <br>
            
            Password:
            <br>
            <input type="password" name="password" placeholder="Enter Password">
            <br>
            
            <input type="submit" name="submit" value="Login" style="background-color:#3742fa; font-weight:bold;">
            <br>
            </form>
            <!--login form end here-->
            <p style="text-align: center;">Created By-<a href="#" >Aman Gaur</a></p>
        </div>
        

    </body>
</html>

<?php
   //check idf submit is clicked
   if(isset($_POST['submit']))
   {
       //process
       //get thr data from form
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        //sql to check preexist
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //execute
        $res=mysqli_query($conn,$sql);
        //count rows whether user exists
        $count=mysqli_num_rows($res);
        if($count==1){
            //user available
            $_SESSION['login']="<div class='success'> Login Successful.</div>";
            $_SESSION['user']=$username; //to check user is logged in or out logout will 
            //redirect
            header('location:'.SITEURL.'admin/');
                
        }
        else{
            //user not available
            $_SESSION['login']="<div class='error'>Username or Password did not match.</div>";
            //rediredt
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?> 