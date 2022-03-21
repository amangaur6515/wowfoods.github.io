<?php include('partials/menu.php'); ?>

<style>
    table tr th{
        border-bottom: 1px solid black;
        padding:1%;
        text-align: left;
    }
    table tr td{
    padding: 1%;

    .btn-primary:hover{
        
        color:black;

}
 

</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br>
        <br>
            <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
            ?>
            <form action="" method="POST">
             <table width="100%">
                 <tr>
                     <td>Current Password:</td>
                     <td>
                         <input type="password" name="current_password" placeholder="Current Password">
                     </td>
                 </tr>

                 <tr>
                     <td>New Password:</td>
                     <td>
                     <input type="password" name="new_password" placeholder="New Password">
                     </td>
                 </tr>

                 <tr>
                     <td>Confirm Password:</td>
                     <td>
                         <input type="password" name="confirm_password" placeholder="Confirm Password">
                     </td>
                 </tr>

                 <tr>
                     <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" style="background-color:#2ed573; font-weight:bold;">
                     </td>
                 </tr>
             </table>
            </form>
    </div>
</div>
<?php 
     //check if submit is clicked
     if(isset($_POST['submit']))
     {
         //get the data 
         $id=$_POST['id'];
         $current_password=md5($_POST['current_password']);
         $new_password=md5($_POST['new_password']);
         $confirm_password=md5($_POST['confirm_password']);
         //check user with current id and pwd exist or not
         $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
         //execute the query
         $res=mysqli_query($conn,$sql);
         if($res==TRUE)
        {
             $count=mysqli_num_rows($res);
             if($count==1)
             {
                 //user exists pwd can be changed
                 //echo "found" ;
                 //check wherthre the new pwd and confirm are equal
                 if($new_password==$confirm_password){
                     $sql2="UPDATE tbl_admin SET 
                     password='$new_password'
                     WHERE id=$id";

                     //execute
                     $res2=mysqli_query($conn,$sql2);
                     //check if exectued
                     if($res==TRUE){
                         //display
                         $_SESSION['change-pwd']="<div class='success'>SUCCESS.</div>";
                 //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                     }
                     else{
                         //error
                         $_SESSION['change-pwd']="<div class='error'>FAILED.</div>";
                 //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                         
                     }

                     //update

                 }
                 else{
                     //redirect
                     $_SESSION['pwd-not-matched']="<div class='error'>Password not match.</div>";
                 //redirect the user
                 header('location:'.SITEURL.'admin/manage-admin.php');
                     
                 }
             }
        
             else
             {
                 //does not
                 $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                 //redirect the user
                 header('location:'.SITEURL.'admin/manage-admin.php');
             }
            
         }

         // check  new and confirm are same
         //update 
     }
?>


<?php include('partials/footer.php'); ?>

