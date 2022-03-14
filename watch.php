<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php  include "includes/class.autoload.php"; ?>
    <!-- Navigation -->  
    <?php  include "includes/navigation.php"; ?>
<?php 
$video = new Videos;
$Likes = new Likes;

if(isset($_POST['liked'])){
    $video_id = $_POST['video_id'];
    $user_id = $_POST['user_id'];
    $Likes->setLikesVideo($video_id,$user_id);
} 
if(isset($_POST['unliked'])){
    echo $post_id = $_POST['video_id'];
    echo $user_id = $_POST['user_id'];
    $Likes->unlikeVideo($post_id,$user_id);
} 
?>
    <style>
    a:link {
        text-decoration: none;
    }
    .profilie_image{
        object-fit: cover;
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }
    </style>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <?php
    if(isset($_GET['v_id'])){
        $the_video_id = $_GET['v_id'];
        $updateViewCount = $video->updateViewCount($the_video_id);
        $vid = $video->getVideosById($the_video_id);

            $video_id = $vid['video_id'];
            $video_title = $vid['video_title'];
            $video_author = $vid['video_author'];
            $video_author_id = $vid['video_author_id'];
            $video_date = $vid['video_date'];
            $video_image = $vid['video_image'];
            $video_resources = $vid['video_resources'];
            $video_status = $vid['video_status'];
            $video_description = $vid['video_description'];
        
     ?> 
        <video width="100%" autoplay controls poster="/cms/images/<?php echo $video_image; ?>">
            <source src="/cms/all_videos/<?php echo $video_resources; ?>" type="video/mp4">
            <source src="/cms/all_videos/<?php echo $video_resources; ?>" type="video/ogg">
            Your browser does not support the video tag.
        </video>
        <h2>
            <?php echo $video_title ?>
        </h2>
        <p class="lead">
            <?php $img = new Comments; ?>
            <a href="/cms/user_profile/<?php echo $video_author; ?>">
             <img  class="profilie_image" border-radius="50%" src="/cms/images/<?php if(empty($img->authorImage($video_author_id)['user_image'])){ echo "person-placeholder.jpg"; } else {  echo $img->authorImage($video_author_id)['user_image']; } ?>">
              <?php echo $video_author ?></a>
              <hr>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $video_date ?></p>
        <hr>
        <p><?php echo $video_description ?></p>
        <hr>
                <?php   
                if(isLoggedIn()){
                if(UserLikedVideo($the_video_id)){  ?>
                        <div class="row">
                            <p class="pull-left"><a href="/cms/watch/<?php echo $the_video_id ?>" class="unlike"><span class="glyphicon glyphicon-thumbs-down"></span>Unlike</a></p>
                        </div>
                        <?php } else { ?>
                        <div class="row">
                            <p class="pull-left"><a href="/cms/watch/<?php echo $the_video_id ?>" class="like"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a></p>
                        </div>
                         <?php }  } else { echo "<p class='pull-left'>You need to <a href='/cms/login'>Log In</a> to leave like</p>"; } ?>
                        <div class="row ">
                        <?php 
                        $likes = $Likes->getLikesVideo($the_video_id)['video_likes'];
                        echo "</br><p class='pull-right'>Likes: $likes </p>";
                        ?>
                        </div>
                        <hr>                        
<!-- Blog Comments -->
<?php 
    if(isset($_POST['create_comment'])) {

        $the_video_id = $_GET['v_id'];
        $comment_author = $_SESSION['username'];
        $comment_author_id = $_SESSION['user_id'];
        $comment_email = $_SESSION['user_email'];
        $comment_content = $_POST['comment_content'];

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
            $setComment = new Comments();
            $setComment->setCommentsVideo($the_video_id, $comment_author,$comment_author_id,$comment_email,$comment_content);
        }
    }
?> 
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <?php if(isLoggedIn()){ ?>
            <form action="#" method="post" role="form">
                <div class="form-group">
                    <textarea name="comment_content" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
            </form>
            <?php } else { echo "you need to <a href='/cms/login'>log in</a> to leave comment"; }  ?>
        </div>
        <hr>
        <?php 
            $the_video_id = $_GET['v_id'];

            $getComments = new Comments();
            $comments = $getComments->getCommetsVideo($the_video_id);

            foreach($comments as $row){
                $comment_date = $row['comment_date']; 
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                $author_id = $row['author_id'];
                ?>
                           <!-- Comment -->
               <div class="media">
            <?php
                $img = $getComments->authorImage($author_id)["user_image"]; ?>
                    <a class="pull-left" href="#">
 <img class="media-object profilie_image" width="50px" border-radius="50%" src="/cms/images/<?php if(empty($img)){ echo "person-placeholder.jpg"; } else { echo $img; ?> " alt="">
                    </a>
                <?php } ?>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;   ?>
                            <small><?php echo $comment_date;   ?></small>
                        </h4>
                        <?php echo $comment_content;   ?>
                    </div>
                </div>
           <?php } }      else {
            header("Location: /cms/");
           }
                ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
        </div>
        <!-- /.row -->
        <hr>
<?php include "includes/footer.php";?>
<script>
            $(document).ready(function(){
                var video_id = <?php echo $the_video_id; ?>;
                var user_id = <?php echo $_SESSION['user_id']; ?>;
                // like
                $(".like").click(function(){
                   $.ajax({
                       url: "/cms/watch.php?v_id=<?php echo $the_video_id; ?>",
                       type: "post",
                       data: {
                           'liked': 1,
                           'video_id': video_id,
                           'user_id': user_id
                       }
                   });
                });
                // unlike
                $(".unlike").click(function(){
                   $.ajax({
                       url: "/cms/watch.php?v_id=<?php echo $the_video_id; ?>",
                       type: "post",
                       data: {
                           'unliked': 1,
                           'video_id': video_id,
                           'user_id': user_id
                       }
                   });
                });
            });
</script>
