<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br><br>

    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_session['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_session['upload']);
        }


    ?>
    <br><br>
        <!-- add category starts here-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table width="100%">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="actice" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" style="background-color:green;">
                    </td>
                </tr>
            </table>
        </form>

         
        <!-- add category starts here-->
        <?php
            //check if submit is clicked
            if(isset($_POST['submit'])){
                // echo "clicked";
                //get value from form
                $title=$_POST['title'];
                //for radio input type , we need to check if its selected
                if(isset($_POST['featured']))
                {
                    //get the value from form
                    $featured=$_POST['featured'];

                }
                else{
                    //set default value
                    $featured="No";
                }

                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];

                }
                else{
                    $active="No";
                }

                //check whether is image is selected or not and set th value for imagse namem accordingly

               // print_r($_FILES['image ']);
                //die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                    //upload image
                    //to upload we need image name, source path and destination path
                    $image_name=$_FILES['image']['name'];
                    //upload only if image is selected
                    if($image_name!="")
                    {

                    
                            //auto rename image
                            //get the exenteensiono of image eg food1.jpg end==jpg
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
                                header('location:'.SITEURL.'admin/add-category.php');
                                //stop the process
                                die();
                    }
                }

                   
                }
                else{
                    //dont upload set image name value blank
                    $image_name="";
                }

                //Create sql to insert into database
                $sql="INSERT INTO tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active' 
                ";
                //execute sql 
                $res=mysqli_query($conn,$sql);

                //check sql executed
                if($res==TRUE)
                {
                    //
                    $_SESSION['add']="<div class='success'>Category Added Successfully.</div> ";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                else{
                    //failed
                    $_SESSION['add']="<div class='error'>Failed to add Category.</div> ";
                    //redirect
                    header('location:'.SITEURL.'admin/add-category.php');
                    

                }

            }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>