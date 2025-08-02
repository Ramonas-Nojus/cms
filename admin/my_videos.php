<?php include "includes/admin_header.php" ?>
<?php include "../includes/class.autoload.php" ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>
<div id="page-wrapper">
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <h1 class="page-header">
                Welcome to posts
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
            <?php
include("includes/delete_modal.php");

if(isset($_POST['checkBoxArray'])) {

    foreach($_POST['checkBoxArray'] as $postValueId ){
        
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options) {

        case 'published':
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
            $update_to_published_status = mysqli_query($connection,$query);       
            confirmQuery($update_to_published_status);    
        break;
            
        case 'draft':
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
            $update_to_draft_status = mysqli_query($connection,$query);
            confirmQuery($update_to_draft_status);

        break;
                
        case 'delete':
        
            $query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";
            $update_to_delete_status = mysqli_query($connection,$query);
            
            confirmQuery($update_to_delete_status);     
        break;

        }
    } 
}

?>

<form action="" method='post'>
<table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">

        <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        </select>

        </div> 

            
<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

 </div>
        <thead>
                    <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                        <th>Id</th>
                        <th>Users</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Views</th>
                    </tr>
                </thead> 
                      <tbody>
  <?php 
    
    $newObj = new Videos();
    $videos = $newObj->getUsersVideos($_SESSION['username']);
    if(!empty($videos)){
    foreach($videos as $row){
            $video_id            = $row['video_id'];
            $video_title         = $row['video_title'];
            $video_author        = $row['video_author'];
            $video_author_id     = $row['video_author_id'];
            $video_date          = $row['video_date'];
            $video_image         = $row['video_image'];
            $video_description   = $row['video_description'];
            $video_status        = $row['video_status'];
            $video_views         = $row['video_views'];
            $video_tags          = $row['video_tags'];
        
        echo "<tr>";
        
        ?>
        
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                  
        <?php
     
        echo "<td>$video_id </td>";

        if(!empty($video_author)) {

        echo "<td>$video_author</td>";
        }

        echo "<td>$video_title</td>";
        echo "<td>$video_status</td>";
        echo "<td><img width='100' src='../images/$video_image' alt='image'></td>";
        echo "<td>$video_tags</td>";

        $query = "SELECT * FROM comments WHERE comment_video_id = $video_id";
        $send_comment_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($send_comment_query);
        if($row >=1){ 
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($send_comment_query);
         } else{ $count_comments = 0; }
        
        echo "<td><a href='post_comments.php?id=$video_id'>$count_comments</a></td>";
        echo "<td>$video_date </td>";
        echo "<td><a class='btn btn-primary' href='../watch/{$video_id}'>watch</a></td>";
        echo "<td><a class='btn btn-info' href='../admin/videos.php?source=edit_video&v_id={$video_id}'>Edit</a></td>";
        ?>
        <form method="post">
            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
         <?php   
            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
          ?>
        </form>
        <?php

        echo "<td><a href='posts.php?reset={$video_id}'>{$video_views}</a></td>";
        echo "</tr>";
    }
      ?>
                    </tbody>
                </table>
            </form>
            <?php  } else {
        echo "<h1>You have no posts</h1>";
    } ?>       
<?php

if(isset($_POST['delete'])){
    $the_post_id = escape($_POST['post_id']);
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);   
}
if(isset($_GET['reset'])){
    $the_post_id = escape($_GET['reset']);
    
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $the_post_id  ";
    $reset_query = mysqli_query($connection, $query);
    header("Location: posts");   
}
?> 
<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete="+ id +" ";
            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');
        });
    });
  <?php if(isset($_SESSION['message'])){
         unset($_SESSION['message']);
     }
         ?>
</script>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php include "includes/admin_footer.php" ?>
