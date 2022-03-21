<?php
//include constant.php for connection
include('../config/constants.php');
// 1.get the id of admin to be deleted
 $id=$_GET['id'];
//2. create sql to delete
$sql="DELETE FROM tbl_admin WHERE id=$id";
//3. redirect to manage admin page with msg
$res=mysqli_query($conn,$sql);
if ($res==TRUE){
    //success
    //echo 'deleted ';
    //create session var to display success
    $_SESSION['delete']='<div class="success">Admin Deleted</div>';
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
    //failed
    //echo 'failed';
    $_SESSION['delete']='<div class="error">Failed<div>';
    header('location:'.SITEURL.'admin/manage-admin.php');

}
?>