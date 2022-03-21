<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
         <br>
         <br>
         <?php
            //get id 
            //create sql query to get detaisl
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            $res=mysqli_query($conn,$sql);

            if($res==TRUE)
            {
                //data available:
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    //get details
                    //echo "admin available";
                    $row=mysqli_fetch_assoc($res);
                    $full_name=$row['full_name'];
                    $username=$row['username'];
                }
                else{
                    //redirect to manage
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
         ?>
        <form action="" method='post'>
            <table class='tbl-30'>
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name='full_name' value='<?php echo $full_name;?>'>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name='username' value='<?php echo $username; ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
  //chech if submit is clicked
  if(isset($_POST['submit']))
  {
      //echo "dones";
      // get values from form to update
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];

        //create sql query to update admin

        $sql="UPDATE tbl_admin SET
        full_name='$full_name',
        username='$username'
        WHERE id='$id'
        ";
        //execute query 
        $res=mysqli_query($conn,$sql);

        //check if executed

        if($res=TRUE)
        {
            //success
            $_SESSION['update']="<div class='success' >Admin Updated Successfully</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            //failed
            $_SESSION['update']="<div class='error' >Failed to update</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
  }
?>

<?php include('partials/footer.php')?>