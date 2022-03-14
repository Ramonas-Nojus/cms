<?php include "../includes/class.autoload.php"; ?>
<?php
   

   if(isset($_GET['v_id'])) {
      $the_video_id = $_GET['v_id'];
   
   $Video = new Videos();

   if(isset($_POST['update_video'])) {
   
            $video_title          = escape($_POST['video_title']);
            $video_image          = $_FILES['image']['name'];
            $video_image_temp     = $_FILES['image']['tmp_name'];
            $video_resources      = $_FILES['video']['name'];
            $video_resources_temp = $_FILES['video']['tmp_name'];
            $video_tags           = escape($_POST['video_tags']);
            $video_description    = escape($_POST['video_description']);
            $video_date           = escape(date('d-m-y'));
            $username             = $_SESSION['username'];
            $user_id              = $_SESSION['user_id']; 

            
            $updateVideo = $Video->updateVideo($video_title,$video_image,$video_image_temp,$video_tags,$video_description,$username,$user_id,$video_resources,$video_resources_temp);

            echo "<p class='bg-success'>video Updated. <a href='../watch/{$the_video_id}'>View Post </a>";
   }

         $vid = $Video->getVideosById($the_video_id);
?>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Video Title</label>
          <input type="text" class="form-control" value="<?php echo $vid['video_title']; ?>" name="video_title">
      </div>
    <div class="form-group">
         <label for="post_image">Video image</label>
         </br>
         <img style="width: 200px; height: 100px; border-radius:5px; margin-bottom:5px;"  src="/cms/images/<?php echo $vid['video_image']; ?>" >
          <input type="file"  name="image" value="<?php echo $vid['video_image']; ?>" accept="image/*">
      </div>
      <div class="form-group">
         <label for="post_image">Video</label>
          <input type="file" name="video" value="<?php echo $vid['video_resources']; ?>" accept="video/*">
      </div>

      <div class="form-group">
         <label for="post_tags">video Tags</label>
          <input type="text" class="form-control" value="<?php echo $vid['video_tags']; ?>" name="video_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Video description</label>
         <textarea class="form-control "name="video_description" id="" cols="30" rows="10">
         <?php echo $vid['video_description']; ?>
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_video" value="Publish Post">
      </div>


</form>

    <?php } ?>