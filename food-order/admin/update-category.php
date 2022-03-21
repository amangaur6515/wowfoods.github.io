<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_category WHERE id=$id";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                //get all the data
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

            }
            else{
                //redirect
                $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else{
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        ?>
    


        <!-- update category starts here-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table width="100%">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                                if($current_image!="")
                                {
                                   //display
                                   ?>
                                   <img src="<?php echo SITEURL;  ?>Images/category/<?php echo $current_image ?>" width="150px"> 
                                   <?php
                                }
                                else{
                                   echo " <div class='error'>image  not added</div>" ;
                                }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "Checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "Checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="actice" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="actice" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo  $current_image; ?>" >
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" style="background-color:green;">
                    </td>
                </tr>
                
            </table>
        </form>

         
        <!-- update category ends here-->
        <?php
            //check if submit is clicked
            if(isset($_POST['submit']))
            {
                            // echo "clicked";
                            //1. get value from form
                            $id=$_POST['id'];
                            $title=$_POST['title'];
                            $current_image=$_POST['current_image'];
                            $featured=$_POST['featured'];
                            $active=$_POST['active'];

                            //2. updat new image
                            if(isset($_FILES['image']['name']))
                            {
                                $image_name=$_FILES['image']['name'];
                                if($image_name!="")
                                {
                                    $ext=end(explode('.',$image_name));

                                        //rename the image
                                        $image_name="Food_category_".rand(000,999).'.'.$ext; //eg food_category_834.jpg
            
                                        
                                        $source_path=$_FILES['image']['tmp_name'];
                                        $destination_path="../Images/category/".$image_name;
                                        //upload image
                                        $upload=move_uploaded_file($source_path,$destination_path);
            
                                        //check whether uploaded
                                        if($upload==FALSE)
                                        {
                                            $_session['upload']="<div class='error'>Failed.</div>";
                                            //redirect to add category
                                            header('location:'.SITEURL.'admin/manage-category.php');
                                            //stop the process
                                            die();

                                        }
                                        //remove current image if available
                                        if($current_image!="")
                                        {
                                            $remove_path="../Images/category/".$current_image;
                                            $remove=unlink($remove_path);
                                            //check if removed and stop process
                                            if($remove==false)
                                            {
                                                $_SESSION['failed-remove']="<div class='error'>Failed to remove</div>";
                                                header('location:'.SITEURL.'admin/manage-category.php');
                                                die();
                                            }

                                        }
                                        

                                    else
                                    {
                                         $image_name=$current_image; 
                                    }
                                }
                                
                                        else
                                {
                                    $image_name=$current_image;
                                }   
                                

                                        //3.update the database
                                        $sql2="UPDATE tbl_category SET 
                                        title='$title',
                                        image_name='$image_name',
                                        featured='$featured',
                                        active='$active'
                                        WHERE id='$id'
                                        ";
                                        //execute sql 
                                        $res2=mysqli_query($conn,$sql2);

                                            //check sql executed
                                                if($res2==TRUE)
                                                {
                                                    //
                                                    $_SESSION['update']="<div class='success'>Category update Successfully.</div> ";
                                                    //redirect
                                                    header('location:'.SITEURL.'admin/manage-category.php');

                                                }
                                                else{
                                                    //failed
                                                    $_SESSION['update']="<div class='error'>Failed to update Category.</div> ";
                                                    //redirect
                                                    header('location:'.SITEURL.'admin/manage-category.php');
                                                    

                                
                                        }  
                            }

                            } 
                            
            
        

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>