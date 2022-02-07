<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
        
  

        <!-- Navigation -->
 
        <?php include "includes/admin_navigation.php" ?>
        
        
    <style>

    .frind_request {

        font-size: 20px;
        border: 3px solid;
        border-radius: 10px;
        width: max-content;
        padding: 10px;
        margin: 10px;

    }

    .b {
        width:35%;
        display:inline-table;
        margin-bottom: 10px;
        }


    img {
        border-radius: 50%;
        width: 75px;
        height: 75px;
        object-fit: cover;
        margin-right: 10px;

    }

    </style>






<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <h1 class="page-header">
                Welcome to friends
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
            
            



            
    
            

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php include "includes/admin_footer.php" ?>
