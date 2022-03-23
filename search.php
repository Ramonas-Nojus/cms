<?php
 declare(strict_types = 1);

include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php include "includes/class.autoload.php"; 
 
//  use search\Search;

 ?>
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

             

            if(isset($_POST['submit'])){
                
            $search = $_POST['search'];

            echo "<h1>Search results for <<<b>$search</b>>></h1>";

            $Search = new search\Search;
            $src = $Search->search($search);
                
            $searchPost = new test\Posts();
            $posts = $searchPost->getSearch($search);

            $searchVideo = new Videos();
            $videos = $searchVideo->searchVideo($search);
                
            if(empty($posts)&&empty($videos)){
                echo "<h1> NO RESULT</h1>";
            } else {
           
                if($src){
    
                    foreach($src as $row){
                        $video_id = $row['video_id'];
                        $video_title = $row['video_title'];
                        $video_author = $row['video_author'];
                        $video_author_id = $row['video_author_id'];
                        $video_date = $row['video_date'];
                        $video_image = $row['video_image'];
                        $video_resources = $row['video_resources'];
                        $video_status = $row['video_status'];
                        $video_description = $row['video_description'];
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_author_id = $row['post_user_id'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];
                
                        if(!empty($video_id)){ ?>
                
                <hr>
                
                            <div class="media">
                
                            <a class="pull-left" href="/cms/watch/<?php echo $video_id; ?>">
                            <?php if(!empty($video_image)){ ?>
                            <img class="media-object" width="350px"  height="200px" style="border-radius: 5px; " src="/cms/images/<?php  echo $video_image; ?>" alt="">
                            <?php } else { ?>
                            <video width="350px"  height="200px" style="border-radius: 5px;"  src="/cms/all_videos/<?php echo $video_resources; ?>" ></video>
                            <?php } ?>
                            </a>
                            <div class="media-body">
                            <h3 class="media-heading"><?php echo $video_title;?>
                            <?php $img = new Comments; ?> 
                            </br>
                            </br><a href="/cms/user_profile/<?php echo $video_author; ?>"><img class="profilie_image" border-radius="50%" src="/cms/images/<?php if(empty($img->authorImage($video_author_id)['user_image'])){ echo "person-placeholder.jpg"; } else {  echo $img->authorImage($video_author_id)['user_image']; } ?>" alt="author_image"></a>
                            <small><a href="/cms/user_profile/<?php echo $video_author; ?>"><?php echo $video_author; ?></a></small>
                            </h3>
                            </br>
                            <p><?php echo $video_description; ?></p>
                            </br>
                            </br>
                            </br>

                
                            </div>
                
                       <?php } ?>
                
                            <?php if(!empty($post_id)){ ?>
                            </br>
                            <h2>
                            <a href="post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                            by <a href="author/<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                            <hr>
                
                
                            <a href="/cms/post/<?php echo $post_id; ?>">
                            <img class="img-responsive" src="/cms/images/<?php if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
                            </a>
                
                
    
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                            <hr>
                    </div>
                    

                
                
                
                   <?php } } } else { 
foreach($posts as $x){
        $post_id = $x['post_id'];
        $post_title = $x['post_title'];
        $post_author = $x['post_user'];
        $post_author_id = $x['post_user_id'];
        $post_date = $x['post_date'];
        $post_image = $x['post_image'];
        $post_content = $x['post_content'];
        $post_status = $x['post_status'];
?>



        <!-- First Blog Post -->

    

        <h2>
            <a href="post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
        </h2>
        <p class="lead">
            by <a href="author/<?php echo $post_author; ?>"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
        <hr>
        
        
        <a href="/cms/post/<?php echo $post_id; ?>">
        <img class="img-responsive" src="/cms/images/<?php if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
        </a>
        
        
        
        <hr>
        <p><?php echo $post_content ?></p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
<?php 

            foreach($videos as $row){ 
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
                <?php if(!empty($video_image)){ ?>
                    <img class="media-object" width="350px"  height="200px" style="border-radius: 5px; " src="/cms/images/<?php  echo $video_image; ?>" alt="">
                <?php } else { ?>
                    <video width="350px"  height="200px" style="border-radius: 5px;"  src="/cms/all_videos/<?php echo $video_resources; ?>" ></video>
                <?php } ?>
                </a>
                <div class="media-body">
                    <h3 class="media-heading"><?php echo $video_title;?>
                    <?php $img = new Comments; ?> 
                </br>
                    </br>
                    <a href="/cms/user_profile/<?php echo $video_author; ?>"><img class="profilie_image" border-radius="50%" src="/cms/images/<?php if(empty($img->authorImage($video_author_id)['user_image'])){ echo "person-placeholder.jpg"; } else {  echo $img->authorImage($video_author_id)['user_image']; } ?>" alt="author_image"></a>
                        <small><a href="/cms/user_profile/<?php echo $video_author; ?>"><?php echo $video_author; ?></a></small>
                    </h3>
                </br>
                    <p><?php echo $video_description; ?></p>

                    </div>
                </div>

                <?php   }

        
        
        ?>
        

<?php }  
}
                
                        
                    ?>
                

           <?php }
            }

?>

    

                
                
                
                
                

              
    

            </div>
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php include "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>

   

<?php include "includes/footer.php";?>
