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

        .img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 350px;
            height: 200px;
            object-fit: cover;
            border-radius: 5px; 
        }

        .vid{
            width: 350px;
            height: 200px;
            background-color: black
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
                
            if(empty($src)){
                echo "<h1> NO RESULT</h1>";
            } else {
               
                    foreach($src as $row){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_user = $row['post_author'];
                        $post_author_id = $row['post_user_id'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];
                
                        if(!empty($post_user)){ ?>
                
                
                <div class="media">
                
                            <a class="pull-left" href="/cms/watch/<?php echo $post_id; ?>">
                            <?php if(!empty($video_image)){ ?>
                            <img class="media-object img" width="350px"  height="200px" style="border-radius: 5px; " src="/cms/images/<?php  echo $post_image; ?>" alt="">
                            <?php } else { ?>
                            <video class="media-object vid" style="border-radius: 5px;"  src="/cms/all_videos/<?php echo $post_user; ?>" ></video>
                            <?php } ?>
                            </a>
                            <div class="media-body">
                            <h3 class="media-heading"><?php echo $post_title;?>
                            <?php $img = new Comments; ?> 
                            </br>
                            </br><a href="/cms/user_profile/<?php echo $post_author; ?>"><img class="profilie_image" border-radius="50%" src="/cms/images/<?php if(empty($img->authorImage($post_author_id)['user_image'])){ echo "person-placeholder.jpg"; } else {  echo $img->authorImage($post_author_id)['user_image']; } ?>" alt="author_image"></a>
                            <small><a href="/cms/user_profile/<?php echo $post_author; ?>"><?php echo $post_author; ?></a></small>
                            </h3>
                            </br>
                            <p><?php echo $post_content; ?></p>
                            </br>
                            </div>
                            </div>
                            

                            
                
                       <?php } else {?>
                
                            <div class="media">
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
                    



                
                
                
                   <?php } }  }} ?>
                   </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
            </div>

        <!-- /.row -->
        <hr>
<?php include "includes/footer.php";?>
