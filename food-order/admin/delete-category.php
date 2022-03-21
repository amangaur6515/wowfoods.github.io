<?php
//include constants folder
include('../config/constants.php');
//echo "Delete Page";
//check if id and image name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
  //get the value and delete
  //echo "get value and de;e";
  $id=$_GET['id'];
  $image_name=$_GET['image_name'];
  //remove image
  if($image_name!="")
  {
      //name available remove it
      $path="../Images/category/".$image_name;
      $remove=unlink($path);
      if($remove==false){
          //set the session msg
          $_SESSION['remove']="<div class='error'>Failed to remove.</div>";
          //redirect
          header('location:'.SITEURL.'admin/manage-category.php');
          //stop the process
          die();
      }
  }

  //delete data from db
  $sql="DELETE FROM tbl_category WHERE id=$id";
  //execute
  $res=mysqli_query($conn,$sql);
  if($res==true)
  {
      //success
      $_SESSION['delete']="<div class='success'>Deleted Successfully</div>";
      //redirect
      header('location:'.SITEURL.'admin/manage-category.php');
  }
  else{
      //msg not succ
      $_SESSION['delete']="<div class='error'>Failed</div>";
      //redirect
      header('location:'.SITEURL.'admin/manage-category.php');


  }


  //redirect 

}
else{
    //redirect
    header('location:'.SITEURL.'admin/manage-category.php');

}



?>