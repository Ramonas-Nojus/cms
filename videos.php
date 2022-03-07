<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php include "includes/class.autoload.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               
             <?php

            $video = new Videos;

            if(empty($video->getVideos())){
                echo "<h1>NO RESULTS</h1>";
            }

            foreach($video->getVideos() as $row){ 
                $video_id = $row['video_id'];
                $video_title = $row['video_title'];
                $video_author = $row['video_author'];
                $video_author_id = $row['video_author_id'];
                $video_date = $row['video_date'];
                $video_image = $row['video_image'];
                $video_resources = $row['video_resources'];
                $video_status = $row['video_status'];
                $video_description = $row['video_description'];
                
                ?>

                <h2>
                    <a href="post/<?php echo $video_id; ?>"><?php echo $video_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author/<?php echo $video_author; ?>"><?php echo $video_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $video_date ?></p>
                <hr>
                
                
                <a href="/cms/post/<?php echo $video_id; ?>">
                <p><?php echo $video_description; ?></p>
                <img class="img-responsive" src="/cms/images/<?php if($video_image == ""){ echo "y9DpT.jpg"; } else{echo $video_image;}?>" alt="">
                </a>
                
                
                
                <hr>
           <a class="btn btn-primary" href="post.php?p_id=<?php echo $video_id; ?>">Watch <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

             <?php   }

            ?>
              
              </div>

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php include "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>


        <ul class="pager">


        </ul>

   

<?php include "includes/footer.php";?>
