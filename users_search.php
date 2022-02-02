<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


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

            echo "<h1>Search results for <<<b>$search</b>>></h1>";
                
            $query = "SELECT * FROM users WHERE username LIKE '%$search%' ";
            $search_query = mysqli_query($connection, $query);

            if(!$search_query) {

                die("QUERY FAILED" . mysqli_error($connection));

            }

            $count = mysqli_num_rows($search_query);

            if($count == 0) {

                echo "<h1> NO RESULT</h1>";

            } else {

    while($row = mysqli_fetch_assoc($search_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_image = $row['user_image'];
        $user_fisrstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        ?>

        

                <!-- users -->
                <div class="media">
         
        <a class="pull-left" href="#">
            <img class="media-object profilie_image" width="150px" border-radius="50%" src="/cms/images/<?php if(empty($user_image)){ echo "person-placeholder.jpg"; } else { echo $user_image; }
            ?>" alt="">
        </a>
        <div class="media-body">
            <h3 class="media-heading"><?php echo $username;   ?>
               <small><?php echo "</br>".$user_fisrstname." ".$user_lastname; ?></small>
            </h3>
            </br>
            </br>
            <a class="btn btn-primary" href="#">see More <span class="glyphicon glyphicon-chevron-right"></span></a>
            
         

        </div>
    </div>
                <!-- <p class="lead">
                    by <a href="#"><?php //echo $username ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php //echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php //if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
                <hr>
                <p><?php //echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr> -->


   <?php }


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
