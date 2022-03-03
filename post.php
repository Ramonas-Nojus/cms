<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php  include "includes/class.autoload.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

<?php if(isset($_POST['liked'])){
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id"; 
    $postResultQuery = mysqli_query($connection,$query);
    $post = mysqli_fetch_array($postResultQuery);
    $likes = $post['likes'];

    mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id = $post_id");
    mysqli_query($connection, "INSERT INTO likes(user_id,post_id) VALUES($user_id,$post_id)");

} 

if(isset($_POST['unliked'])){
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id"; 
    $postResultQuery = mysqli_query($connection,$query);
    $post = mysqli_fetch_array($postResultQuery);
    $likes = $post['likes'];

    mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id = $post_id");
    mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
 
} 


?>

    <style>

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

    if(isset($_GET['p_id'])){
    
       $the_post_id = $_GET['p_id'];

        // $update_statement = mysqli_prepare($connection, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");

        // mysqli_stmt_bind_param($update_statement, "i", $the_post_id);

        // mysqli_stmt_execute($update_statement);

        // mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
        $update_statement = mysqli_prepare($connection, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");
        mysqli_stmt_bind_param($update_statement, "i", $the_post_id);
        mysqli_stmt_execute($update_statement);
        
    


     if(!$update_statement) {

        die("query failed" );
    }


    if(isset($_SESSION['user_id']) && is_admin($_SESSION['username']) ) {


         $stmt1 = mysqli_prepare($connection, "SELECT post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_id = ?");


    } else {
        $stmt2 = mysqli_prepare($connection , "SELECT post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_id = ? AND post_status = ? ");

        $published = 'published';



    }



    if(isset($stmt1)){

        mysqli_stmt_bind_param($stmt1, "i", $the_post_id);

        mysqli_stmt_execute($stmt1);

        mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_image, $post_content);

      $stmt = $stmt1;


    }else {


        mysqli_stmt_bind_param($stmt2, "is", $the_post_id, $published);

        mysqli_stmt_execute($stmt2);

        mysqli_stmt_bind_result($stmt2, $post_title, $post_author, $post_date, $post_image, $post_content);

     $stmt = $stmt2;

    }




    while(mysqli_stmt_fetch($stmt)) {



        ?>
        
          <h1 class="page-header">
                    Posts
                    
                  
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <?php echo $post_title ?>
                </h2>
                <p class="lead">
                    by <a href="/cms/author/<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                
               

                
                
<?php } ?>


                <?php   
// if(UserLikedPost($the_post_id)){ echo "<h1>HAHAHAHA</h1>"; }


                if(isLoggedIn()){
                if(UserLikedPost($the_post_id)){  ?>
                        <div class="row">
                            <p class="pull-left"><a href="/cms/post/<?php echo $the_post_id ?>" class="unlike"><span class="glyphicon glyphicon-thumbs-down"></span>Unlike</a></p>
                        </div>

                        <?php } else { ?>
                        <div class="row">
                            <p class="pull-left"><a href="/cms/post/<?php echo $the_post_id ?>" class="like"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a></p>
                           
                        </div>
                         <?php }  } else { echo "<p class='pull-left'>You need to <a href='/cms/login'>Log In</a> to leave like</p>"; } ?>
                        
                        <div class="row ">

                            <?php 
                            
                            $stmt = mysqli_prepare($connection, "SELECT likes FROM posts WHERE post_id = ?");

                            mysqli_stmt_bind_param($stmt, "i", $the_post_id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $likes);

                            while(mysqli_stmt_fetch($stmt)){
                                echo "</br><p class='pull-right'>Likes: $likes</p>";
                            }
                            
                            
                            ?>

                            
                        </div>
                       
                        <hr>

                            
<!-- Blog Comments -->

<?php 

    if(isset($_POST['create_comment'])) {

        $the_post_id = $_GET['p_id'];
        $comment_author = $_SESSION['username'];
        $comment_author_id = $_SESSION['user_id'];
        $comment_email = $_SESSION['user_email'];
        $comment_content = $_POST['comment_content'];


        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

            $setComment = new SetComments($the_post_id, $comment_author,$comment_author_id,$comment_email,$comment_content);
            $setComment->addComments();

        }


    }




?> 


                <!-- Posted Comments -->



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


            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query) {

                die('Query Failed' . mysqli_error($connection));
             }
            while ($row = mysqli_fetch_array($select_comment_query)) {
            $comment_date = $row['comment_date']; 
            $comment_content = $row['comment_content'];
            $comment_author = $row['comment_author'];
            $author_id = $row['author_id'];
                
                ?>
                
                
                           <!-- Comment -->
                <div class="media">

            <?php
                $query = "SELECT user_image, username FROM users WHERE user_id = '$author_id' ";
                $image_select = mysqli_query($connection,$query);
                $row = mysqli_fetch_array($image_select);
            ?>
                     
                    <a class="pull-left" href="#">
                        <img class="media-object profilie_image" width="50px" border-radius="50%" src="/cms/images/<?php if(empty($row['user_image'])){ echo "person-placeholder.jpg"; } else { echo $row['user_image']; }
                        ?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $row['username'];   ?>
                            <small><?php echo $comment_date;   ?></small>
                        </h4>
                        
                        <?php echo $comment_content;   ?>
 
                    </div>
                </div>
     
                
  

           <?php } }    else {


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

                var post_id = <?php echo $the_post_id; ?>;
                var user_id = <?php echo $_SESSION['user_id']; ?>;

                // like

                $(".like").click(function(){
                   $.ajax({
                       url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                       type: "post",
                       data: {
                           'liked': 1,
                           'post_id': post_id,
                           'user_id': user_id
                       }
                   });
                });

                // unlike

                $(".unlike").click(function(){
                   $.ajax({
                       url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                       type: "post",
                       data: {
                           'unliked': 1,
                           'post_id': post_id,
                           'user_id': user_id
                       }
                   });
                });
            });

</script>
