<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php include "includes/class.autoload.php"; ?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
<style> 
            .profile-img {
                border-radius: 50%;
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 300px;
                height: 300px;
                object-fit: cover;
            }

            .input {
                width: 40%;
            }

            .del-btn{
                margin-top: 18px;
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 300px;
                object-fit: cover;
            }

            .add_friend {
                object-fit: cover;
                margin-top: 5px;
            }

            .remove_friend {
                object-fit: cover;
                margin-top: 130px;
            }

            .center {
                display: flex;
                justify-content: center;
                align-items: center;
            
            }


            .report_a {
                color: hotpink;
            }
            .report  {
                margin-top: 145px;
            }
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
    <div class="container">
        <div class="row">

    <!-- Blog Entries Column -->
    
    <div class="col-md-8">
    <div id="wrapper">
        <!-- Navigation -->

    <div id="page-wrapper">

    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

        <?php

    if(isset($_GET['username'])) {
 
        $username = $_GET['username'];

        $getUser = new Users();
        $user = $getUser->getUser($username);
 
        foreach($user as $row){
            $db_username = $row['username'];
            $db_user_id = $row['user_id'];
            $user_password= $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $db_user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_date = $row['date'];
        }
    }
 ?>
      
            <div class="form-group img">
                <img class="profile-img" src="<?php echo BASE_URL; ?>/images/<?php 

                if(empty($db_user_image)){
                    echo "person-placeholder.jpg";
                } else { echo $db_user_image; }
                
                ?>"> 
<?php  

    if(isLoggedIn()){
            $user_id = $_SESSION['user_id'];
            $the_username = $_SESSION['username'];


        if(isset($_POST['add_friend'])){
            $friends_id = $_POST['add_friend'];

            $query = "INSERT INTO requests(from_id, to_id, from_username, to_username) VALUES('{$user_id}' ,'{$friends_id}' ,'{$the_username}' ,'{$db_username}')";
            $add_friend_request_query = mysqli_query($connection, $query);  
            redirect("./user_profile/$db_username");  
        }

        if(isset($_POST['remove_friend'])){
                $friends_id = $_POST['remove_friend'];

            $remove_friend_query = query("DELETE FROM friends WHERE friend1_id = $friends_id AND friend2_id =  $user_id OR  friend2_id = $friends_id AND friend1_id =  $user_id");
            redirect("./user_profile/$db_username");  
        }
        $query = "SELECT * FROM requests WHERE from_id = '{$user_id}' AND to_username = '$db_username' ";
        $get_request_query = mysqli_query($connection, $query);   

        $row = mysqli_fetch_array($get_request_query);

        $signed_in_user = $_SESSION['username'];  
        $select_friends_query = query("SELECT * FROM friends WHERE friend1_username = '$db_username' AND friend2_username = '$signed_in_user' OR friend2_username = '$db_username' AND friend1_username = '$signed_in_user'");

        $slect_specific_request_query = query("SELECT * FROM requests WHERE from_username = '$db_username' AND to_username = '$signed_in_user' "); 
                if($user_role == 'banned'){ ?>

                    <form action="" method="post">
                        <div class="center">
                            <button class="add_friend btn btn-danger">This user was banned</button>
                        </div>

                    </form>
                    </div>
                <?php 
                } else {

                 if($db_username == $_SESSION['username']){ ?>

                <form action="<?php echo BASE_URL; ?>/admin/profile" method="post">
                        <div class="center">
                            <button class="add_friend btn btn-primary">Profile</button>
                        </div>
                    </form>
                    </div>

                 <?php 

                 } else if(mysqli_num_rows($get_request_query) > 0){
                    ?>
                    
                        <div class="center">
                            <button class="add_friend btn btn-primary">friend request sent</button>
                        </div>
                    
                    </div>
                
                <?php }
                
                 else if(mysqli_num_rows($select_friends_query) > 0){
                    ?> 
                    
               <div class="center">
                <button type="button" class="add_friend btn btn-outline-success">
                   already friends
                </button>
                </div>
                </div>
                <form action="" method="post">
                <div class="center">
                <button type="submit" name="remove_friend" class="remove_friend btn btn-danger" value="<?php echo $db_user_id; ?>">
                   Remove Friend
                </button>
                </div>
                </form>
                    <?php } else if(mysqli_num_rows($slect_specific_request_query) > 0){ ?> 
                    
                        <form action="<?php echo BASE_URL; ?>/admin/notifications.php" method="post">
               <div class="center">
                <button class="add_friend btn btn-primary" type="submit"  ?>
                  see request
                </button>
                </div>
                </form>
                </div>
                    
<?php 
                    } else { ?>
                
           <form action="" method="post">
               <div class="center">
                <button class="add_friend btn btn-primary" type="submit" name="add_friend" value="<?php echo $db_user_id; ?>">
                   add friend
                </button>
                </div>
                </form>
                </div>
<?php 
                } }  }  else { ?>  
                    <form action="<?php echo BASE_URL; ?>/login" method="post">
               <div class="center">
                <button class="add_friend btn btn-primary" type="submit"?>
                   you need to log in to add friends
                </button>
                </div>
                </form>
                </div>
                
                <?php
                }
   
                ?>

                <?php
                
                if(isLoggedIn()){
                
                if($_SESSION['username'] == $username ||  $user_role == 'banned'){} else{ ?>
                <center class=" <?php if(mysqli_num_rows($select_friends_query) > 0){ echo ""; } else{ echo "report"; } ?>">
                <a class="report_a" href="<?php echo BASE_URL; ?>/report/<?php echo $username; ?>" >Report</a>
                </center>
                    <?php } } ?>

      <div class="form-group input">
         <label for="firstname">Firstname:</label>
         <?php echo $user_firstname; ?>
      </div>
       <div class="form-group ">
         <label for="lastname">Lastname:</label>
         <?php echo $user_lastname; ?>
      </div>
      <div class="form-group ">
         <label for="username">Username:</label>
         <?php echo $db_username; ?>
      </div>
      <div class="form-group ">
         <label for="email">Email:</label>
         <?php echo $user_email; ?>
      </div>
      <div class="form-group ">
         <label for="email">joined:</label>
         <?php echo $user_date; ?>
        </div>
        </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

            <h2><?php echo $db_username."'s"; ?> activity</h2>

            </div>   
            </div>
            <?php include "includes/sidebar.php" ?>
            </div>

<div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <button type="button" onclick="showPosts();" id="posts-btn" class="btn btn-primary">Posts</button>
            <button type="button" onclick="showVideos();" id="videos-btn" class="btn btn-outline-secondary">Videos</button>
            <div style="height: 25px;"></div>

        <?php 
            $getPosts = new Posts();
            $getVideos = new Videos();

            $usersPosts = $getPosts->usersPosts($db_username);
            $userVideos = $getVideos->getUsersVideos($db_username);
        ?>

        <div class="videos" id="videos">
        <?php  foreach($userVideos as $row){
            
            $video_id = $row['video_id'];
            $video_title = $row['video_title'];
            $video_author = $row['video_author'];
            $video_resources = $row['video_resources'];

            $video_author_id = $row['video_author_id'];
            $video_date = $row['video_date'];
            $video_image = $row['video_image'];
            $video_description = $row['video_description'];
            $video_status = $row['video_status'];
            ?>
            
            <div class="media">

                <a class="pull-left" href="/watch/<?php echo $video_id; ?>">
                    <?php if(!empty($video_image)){ ?>
                        <img class="media-object img" width="350px"  height="200px" style="border-radius: 5px; " src="<?php echo BASE_URL; ?>/images/<?php  echo $video_image; ?>" alt="">
                    <?php } else { ?>
                        <video class="media-object vid" style="border-radius: 5px;"  src="<?php echo BASE_URL; ?>/all_videos/<?php echo $video_resources; ?>" ></video>
                    <?php } ?>
                </a>
                <div class="media-body">
                    <h3 class="media-heading"><?php echo $video_title;?>
                    <?php $img = new Comments; ?> 
                        </br>
                    </br><a href="<?php echo BASE_URL; ?>/user_profile/<?php echo $video_author; ?>"><img class="profilie_image" border-radius="50%" src="<?php echo BASE_URL; ?>/images/<?php if(empty($img->authorImage($video_author_id)['user_image'])){ echo "person-placeholder.jpg"; } else {  echo $img->authorImage($video_author_id)['user_image']; } ?>" alt="author_image"></a>
                    <small><a href="<?php echo BASE_URL; ?>/user_profile/<?php echo $video_author; ?>"><?php echo $video_author; ?></a></small>
                </h3>
                    </br>
                <p>
                    <?php echo $video_description; ?>
                </p>
                </br>
                </div>
            </div>
            <?php } ?>

        </div>
        <div class="posts" id="posts">

                  <?php  foreach($usersPosts as $row){

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_author_id = $row['post_user_id'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_status = $row['post_status'];

                    ?>
            
                <div class="media posts" id="posts">
                    
                    </br>
                    <h2>
                        <a href="<?php echo BASE_URL; ?>/post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="<?php echo BASE_URL; ?>/author/<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                    <a href="<?php echo BASE_URL; ?>/post/<?php echo $post_id; ?>">
                        <img class="img-responsive" src="<?php echo BASE_URL; ?>/images/<?php if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
                    </a>
        
                        <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                    <hr>
                </div>
            
               <?php } ?>
            </div>
</div>

</div>

</div>
<script>

var posts = document.getElementById("posts");
var postsBtn = document.getElementById("posts-btn");
var videosBtn = document.getElementById("videos-btn");
var videos = document.getElementById("videos");

function showPosts() {
  posts.style.display = "block";
  postsBtn.classList.add("btn-primary")
  postsBtn.classList.remove("btn-outline-secondary")
  videos.style.display = "none";
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
<!-- /#page-wrapper -->
        
<?php include "includes/footer.php" ?>
