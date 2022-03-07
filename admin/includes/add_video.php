<?php include "../includes/class.autoload.php"; ?>
<?php
   

   if(isset($_POST['create_video'])) {
   
            $video_title            = escape($_POST['video_title']);
    
            $video_image            = $_FILES['image']['name'];
            $video_image_temp       = $_FILES['image']['tmp_name'];

            $video_resources        = $_FILES['video']['name'];
            $video_resources_temp   = $_FILES['video']['tmp_name'];
    
    
            $video_tags         = escape($_POST['video_tags']);
            $video_description  = escape($_POST['video_description']);
            $video_date         = escape(date('d-m-y'));
            $username           = $_SESSION['username'];
            $user_id            = $_SESSION['user_id']; 

            $setPost = new Videos();
            $addPost = $setPost->setVideo($video_title,$video_image,$video_image_temp,$video_tags,$video_description,$username,$user_id,$video_resources,$video_resources_temp);

             $the_post_id = mysqli_insert_id($connection );
             echo "<p class='bg-success'>Post Created. <a href='../post/{$the_post_id}'>View Post </a>"; if(is_admin()){ " or <a href='posts.php'>Edit More Posts</a></p>"; };
       


   }
    

    
    
?>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Video Title</label>
          <input type="text" class="form-control" name="video_title">
      </div>
    <div class="form-group">
         <label for="post_image">Video image</label>
          <input type="file"  name="image">
      </div>
      <div class="form-group">
         <label for="post_image">Video</label>
          <input type="file"  name="video">
      </div>

      <div class="form-group">
         <label for="post_tags">video Tags</label>
          <input type="text" class="form-control" name="video_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Video description</label>
         <textarea class="form-control "name="video_description" id="" cols="30" rows="10">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_video" value="Publish Post">
      </div>


</form>
    