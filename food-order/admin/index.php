<?php include('partials/menu.php'); ?>

<!-- above we have included menu.php which contains html of menu section-->
        <!-- menu section ends here-->

        <!-- main content starts here-->
        <div class="main-content">
        <div class="wrapper"> 
               <h1>Dashboard</h1>
               <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }?>
               <div class="col-4 text-center">
                   <h1>5</h1>
                   <br/> 
                   categories
               </div>

               <div class="col-4 text-center">
                   <h1>5</h1>
                   <br/> 
                   categories
               </div>

               <div class="col-4 text-center">
                   <h1>5</h1>
                   <br/> 
                   categories
               </div>

               <div class="col-4 text-center">
                   <h1>5</h1>
                   <br/> 
                   categories
               </div>

               <div class="clearfix"></div>
            </div>
        </div>
        <!-- main content starts here-->
<?php include('partials/footer.php');?>
       