<?php include('partials/menu.php');?>
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
        <h1>Manage category </h1>
        <br> 
        <br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

    ?>
    <br><br>

                <!-- button to add admin-->
                <a href="<?php echo SITEURL;?>admin/add-category.php" style="background-color:#1e90ff; padding:1%; color:white; text-decoration:none; font-weight:bold; "> Add category</a>
                
                <br> 
                <br>
                <table width="100%">
                    <tr>
                        <th >s.No.</th>
                        <th>Title </th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                    $sql="SELECT * FROM tbl_category";
                    //execute query 
                    $res=mysqli_query($conn,$sql);
                    //count rows
                    $count=mysqli_num_rows($res);

                    //create serial number variable assign 1
                    $sn=1;

                    //check if data in database
                    if($count>0)
                    {
                        //data is
                        //get the data and display
                        while($row=mysqli_fetch_assoc($res)) 
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];

                            ?>
                                        <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?> </td>

                                    <td>

                                        <?php 

                                        //check if image name is availabe
                                        if($image_name!="")
                                        {
                                            ?>

                                            <img src="<?php echo SITEURL;?>Images/category/<?php echo $image_name; ?>" width="100px">

                                            <?php

                                        }
                                        else{
                                            //msg
                                            echo "<div class='error'>No image added.</div>";
                                        }
                                        
                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" style="background-color:#2ed573; padding:1%; color:white; text-decoration:none; font-weight:bold; ">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" style="background-color:#ff6348; padding:1%; color:white; text-decoration:none; font-weight:bold; ">Delete Category</a>
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else{
                        //no data
                        //display msg inside table
                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No category added</div></td>
                        </tr>

                        <?php
                    }


                    ?>

                    

                    

              

                </table>
    </div>
    
</div>


<?php include('partials/footer.php');?>