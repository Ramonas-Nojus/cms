<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <?php 
    
        if(isset($_GET['username'])){
            $username = $_GET['username'];
        } else {
            redirect("/cms/");
        }
    
    ?>


    <div>
        <h1 align='center'>
            Report user (<?php echo $username; ?>)
        </h1>
    </div>


        <hr>



<?php include "includes/footer.php";?>
