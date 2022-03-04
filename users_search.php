<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php include "includes/class.autoload.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <style>

        img {
            object-fit: cover;
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }


    </style>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               
               <?php

            if(isset($_POST['submit'])){
                
            $search = $_POST['user_search'];

            if(empty($search)){
                echo "<h1> NO RESULT</h1>";
            } else {

            echo "<h1>Search results for <<<b>$search</b>>></h1>";

            $searchUsers = new Users($search);
            $users = $searchUsers->searchUsers($search);

            if(empty($users)){
                echo "<h1> NO RESULT</h1>";
            } else {
            foreach($users as $row){

                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_image = $row['user_image'];
                $user_fisrstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
            
        ?>
                <!-- users -->
                <div class="media">
         
        <a class="pull-left" href="user_profile/<?php echo $username; ?>">
            <img class="media-object profilie_image" width="150px" border-radius="50%" src="/cms/images/<?php if(empty($user_image)){ echo "person-placeholder.jpg"; } else { echo $user_image; }
            ?>" alt="">
        </a>
        <div class="media-body">
            <h3 class="media-heading"><?php echo $username;   ?>
               <small><?php echo "</br>".$user_fisrstname." ".$user_lastname; ?></small>
            </h3>
            </br>
            </br>
            <a class="btn btn-primary" href="user_profile/<?php echo $username; ?>">see More <span class="glyphicon glyphicon-chevron-right"></span></a>

        </div>
    </div>

   <?php        }
            }
        }
    }

?>

    

                
                
                
                
                

              
    

            </div>
            
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php include "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>

   

<?php include "includes/footer.php";?>
