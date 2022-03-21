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

        <!-- main content starts here-->
        <div class="main-content">
            <div class="wrapper"> 
                <h1>Manage Admin</h1>
                <br> 
                <br>
                <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); //remove session message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['pwd-not-matched'])){
                    echo $_SESSION['pwd-not-matched'];
                    unset($_SESSION['pwd-not-matched']);
                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
                


                ?>
                <br>
                <br>
                <!-- button to add admin-->
                <a href="add-admin.php" style="background-color:#1e90ff; padding:1%; color:white; text-decoration:none; font-weight:bold; " >Add Admin</a>
                <br> 
                <br>
                <table width="100%">
                    <tr>
                        <th >s.No.</th>
                        <th>Full Name </th>
                        <th>User Name</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //query to get all admin

                        $sql='SELECT * FROM tbl_admin';
                        //execute query
                         $res=mysqli_query($conn,$sql);
                        //check whether th query is executed
                        if($res==TRUE)
                        {
                            //count rows to check if data is in databasse
                             $count=mysqli_num_rows($res); //function to count rows
                             $sn=1; //create  and assign vvalue                             
                            //check no. of rows
                            if($count>0)
                            {
                                //we have data in db
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                     //using while loop to get all data from db
                                    //and while loop will run as long as we have data in db
                                    //get indiv. data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                     //display values in tavle
                                     ?>
                                         <tr>
                                            <td> <?php echo $sn++;?> </td>
                                            <td> <?php echo $full_name;?> </td>
                                            <td><?php echo $username; ?> </td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" style="background-color:#1e90ff; padding:1%; color:white; text-decoration:none; font-weight:bold; ">Change Password</a>
                                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?> " style="background-color:#2ed573; padding:1%; color:white; text-decoration:none; font-weight:bold; ">Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?> " style="background-color:#ff6348; padding:1%; color:white; text-decoration:none; font-weight:bold; ">Delete Admin</a>
                                            </td>
                                        </tr>
                                     <?php

                                }
                                
                            }
                            else
                            {
                                //empty
                            }
                        }
                    ?>
                    

                    

                </table>
            </div>
        </div>
        <!-- main content starts here-->

<?php include('partials/footer.php');?>