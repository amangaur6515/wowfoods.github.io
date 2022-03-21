<?php include('partials/menu.php'); ?>

<div  class="main-content">
    <div class="wrapper">
    <h1>Add Admin</h1>
    <br>
    <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    ?>

    <form action="" method="post">
            <table style="width:30%;">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input style="margin:1%; padding:2%; " type="text" name="full_name" placeholder="Enter your name..">
                    </td>
                    <br>
                </tr>
                
                <tr>
                    <td>Username:</td>
                    <td>
                        <input style=" padding:2%; margin:1%;" type="text" name="username" placeholder="Enter your username.." >
                    </td>
                    <br>
                </tr>
               
                <tr>
                    <td>Password:</td>
                    <td>
                        <input style=" padding:2%; margin:1%;" type="password" name="password" placeholder="your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input style=" padding:2%; margin:1%; background-color:#2ed573;" type="submit" name="submit" value="Add Admin" >
                    </td>
                </tr>
            </table>

    </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php
   //process the value from form and save it in database
   //check whether submit button is clicked is not
   if(isset($_POST['submit']))
   {
       //button clicked
       //echo "Button Clicked";
       // get data from form
        $full_name=$_POST['full_name']; 
        $username=$_POST['username']; 
        $password=md5($_POST['password']); //Password encryption with md5

        //sql query to save data in database

        $sql="INSERT INTO tbl_admin SET
               full_name= '$full_name',
               username= '$username',
               password='$password'
         ";
        //inside constant.php
        //establish connection  ('localhost','username','password')
        //$conn=mysqli_connect('localhost','root','') or die(mysqli_error());
        //         mysqli_select_db($conn,'DBNAME')
        //$db_select=mysqli_select_db($conn,'food-order') or die(mysqli_error());


        ////Execute query and save data in database
        $res=mysqli_query($conn,$sql) or die(mysqli_error());

        //check whether the query is executed or not dsplay msg
         if($res==TRUE){
             //data inserted
             //echo "data inserted";
             //session variable to display msg
             $_SESSION['add']='Admin Added successfully';
             //redirect page TO MANAGE ADMIN
             header('location:'.SITEURL.'admin/manage-admin.php');
         }
         else{
             //echo "failed";
              //session variable to display msg
              $_SESSION['add']='failed';
              //redirect page TO MANAGE ADMIN
              header('location:'.SITEURL.'admin/add-admin.php');
         }

   }
   
?>