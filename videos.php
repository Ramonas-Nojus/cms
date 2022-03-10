<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php include "includes/class.autoload.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

    
 <style>

        .profilie_image {
            object-fit: cover;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

 </style>
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
                <hr>

                <div class="media">
         
         <a class="pull-left" href="/cms/watch/<?php echo $video_id; ?>">
             <img class="media-object" width="150px" style="border-radius: 5px; " src="/cms/images/<?php if(empty($video_image)){ echo "person-placeholder.jpg"; } else { echo $video_image; }
             ?>" alt="">
         </a>
         <div class="media-body">
             <h3 class="media-heading"><?php echo $video_title;?>
             <?php $img = new Comments; ?> 
             
            </br><img class=" profilie_image" width="70px" border-radius="50%" src="/cms/images/<?php if(empty($img->authorImage($video_author_id)['user_image'])){ echo "person-placeholder.jpg"; } else {  echo $img->authorImage($video_author_id)['user_image']; } ?>" alt="author_image"> 
                <small><a><?php echo $video_author; ?></a></small>
             </h3>
             </br>
             </br>
             <a class="btn btn-primary" href="watch/<?php echo $video_id; ?>">watch<span class="glyphicon glyphicon-chevron-right"></span></a>
 
         </div>
         </div>

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
