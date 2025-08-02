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
             $per_page = 10;

            if(isset($_GET['page'])) {

            $page = $_GET['page'];
            } else {
                $page = "";
            }

            if($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

         if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {

        $post_query_count = "SELECT * FROM posts ORDER BY post_id DESC";

         } else { $post_query_count = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC"; }   
        $find_count = mysqli_query($connection,$post_query_count);
        $count = mysqli_num_rows($find_count);

        if($count < 1) {
            echo "<h1 class='text-center'>No posts available</h1>";
        } else {

        $count  = ceil($count /$per_page);
        
        $newObj = new Posts();
        $post = $newObj->getPosts();
        
        foreach($post as $x){
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
                
                
                <a href="/post/<?php echo $post_id; ?>">
                <img class="img-responsive" src="./images/<?php if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
                </a>    
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>

   <?php }  } ?>

            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
        </div>
        <!-- /.row -->
        <hr>
        <ul class="pager">

        <?php 

        for($i =1; $i <= $count; $i++) {
            if($i == $page)
            {
                echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            }   else
                {
                    echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";
                }
        } ?>
        </ul>

<?php include "includes/footer.php";?>
