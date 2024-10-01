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


        .videos {
                display: none;
            }
        .posts {
            display: block;
        }
</style>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
    
            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               
               <?php
            if(isset($_GET['search'])){
                
            $search = $_GET['search'];

            echo "<h1>Search results for <<<b>$search</b>>></h1>";

            ?>    

            <div style="height: 25px;"></div>
            <button type="button" onclick="showPosts();" id="posts-btn" class="btn btn-primary">Posts</button>
            <button type="button" onclick="showVideos();" id="videos-btn" class="btn btn-outline-secondary">Videos</button>
            <div style="height: 25px;"></div>

<?php

            $Search = new search\Search;
            $search_posts = $Search->searchPosts($search);
            $search_videos = $Search->searchVideos($search);

            ?>
            <div class="videos" id='videos'>
            <?php
               
               foreach($search_videos as $row){
                $video_id = $row['video_id'];
                $video_title = $row['video_title'];
                $video_author = $row['video_author'];
                $video_author_id = $row['video_author_id'];
                $video_date = $row['video_date'];
                $video_image = $row['video_image'];
                $video_description = $row['video_description'];
                $video_resources = $row['video_resources'];

            ?>
            
                
                <div class="media">
                
                    <a class="pull-left" href="/watch/<?php echo $video_id; ?>">
                        <?php if(!empty($video_image)){ ?>
                            <img class="media-object img" width="350px"  height="200px" style="border-radius: 5px; " src="/images/<?php  echo $video_image; ?>" alt="">
                        <?php } else { ?>
                            <video class="media-object vid" style="border-radius: 5px;"  src="./all_videos/<?php echo $video_resources; ?>" ></video>
                        <?php } ?>
                    </a>
                    <div class="media-body">
                        <h3 class="media-heading"><?php echo $video_title;?>
                            <?php $img = new Comments; ?> 
                            </br>
                            </br><a href="/user_profile/<?php echo $video_author; ?>"><img class="profilie_image" border-radius="50%" src="/images/<?php echo $img->authorImage($video_author_id)['user_image'] ?>" alt="author_image"></a>
                            <small>
                                <a href="/user_profile/<?php echo $video_author; ?>"><?php echo $video_author; ?></a>
                            </small>    
                        </h3>
                        </br>
                        <p><?php echo $video_description; ?></p>
                        </br>
                    </div>
                </div>
                <?php } ?>
            </div>      
            <div class="posts" id='posts'>

            <?php  
            
            foreach($search_posts as $row){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_user'];
                $post_author_id = $row['post_user_id'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_status = $row['post_status'];
            ?>
            
                <div class="media">
                    </br>
                    <h2>
                        <a href="post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author/<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?>
                    </p>
                    <hr>
        
                    <a href="/post/<?php echo $post_id; ?>">
                        <img class="img-responsive" src="/images/<?php if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
                    </a>
        
                    <hr>
                    <p>
                        <?php echo $post_content ?>
                    </p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">
                        Read More 
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
        
                    <hr>
                </div>
                <?php } ?>
            </div>
                    
            <?php }  ?>
                   </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
            </div>

        <!-- /.row -->
        <hr>

        <script>

        var posts = document.getElementById("posts");
        var postsBtn = document.getElementById("posts-btn");
        var videosBtn = document.getElementById("videos-btn");
        var videos = document.getElementById("videos");

        function showPosts() {
            posts.style.display = "block";
            videos.style.display = "none";
            postsBtn.classList.add("btn-primary")
            postsBtn.classList.remove("btn-outline-secondary")
            videosBtn.classList.add("btn-outline-secondary")
            videosBtn.classList.remove("btn-primary")
        }

        function showVideos() {
            videos.style.display = "block";
            posts.style.display = "none";
            videosBtn.classList.add("btn-primary")
            videosBtn.classList.remove("btn-outline-secondary")
            postsBtn.classList.add("btn-outline-secondary")
            postsBtn.classList.remove("btn-primary")
        }
</script>

<?php include "includes/footer.php";?>