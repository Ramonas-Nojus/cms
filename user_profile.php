<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

<style> 

.img {
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

.center {
    display: flex;
  justify-content: center;
  align-items: center;
  
}



</style>


<?php

   if(isset($_GET['username'])) {
    
    $username = $_GET['username'];
    
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    
    $select_user_profile_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_user_profile_query)) {
    
        $db_username = $row['username'];
        $db_user_id = $row['user_id'];
        $user_password= $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $db_user_image = $row['user_image'];
        $user_role= $row['user_role'];
        $user_date= $row['date'];

    
    
    
    }
    

}
  
    ?>
    



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


     

                
            <div class="form-group img">

            

                <img class="img" src="/cms/images/<?php 

                if(empty($db_user_image)){
                    echo "person-placeholder.jpg";
                } else { echo $db_user_image; }
                
                ?>">

                <?php  

                if(isset($_POST['add_friend'])){
                    $friends_id = $_POST['add_friend'];


                    $user_id = $_SESSION['user_id'];
                    $username = $_SESSION['username'];

                    $query = "INSERT INTO requests(from_id, to_id, from_username, to_username) VALUES('{$user_id}' ,'{$friends_id}' ,'{$username}' ,'{$db_username}')";
                    $add_friend_request_query = mysqli_query($connection, $query);  
                    redirect("/cms/user_profile/$db_username");  
                }


                $user_id = $_SESSION['user_id'];
                
                $query = "SELECT * FROM requests WHERE from_id = '{$user_id}' AND to_username = '$username' ";
                $get_request_query = mysqli_query($connection, $query);   

                $row = mysqli_fetch_array($get_request_query);


              
                 
                
                if(mysqli_num_rows($get_request_query) > 0){
                   
                    ?>
                    <form action="" method="post">
                        <div class="center">
                            <button class="add_friend btn btn-primary">friend request sent</button>
                        </div>
                    </form>
                </div>
                <?php } else { ?>
                
           <form action="" method="post">
               <div class="center">
                <button class="add_friend btn btn-primary" type="submit" name="add_friend" value="<?php echo $db_user_id; ?>">
                   add friend
                </button>
                </div>
                </form>
                </div>
     
<?php 

   
                }
   
      

?>
     
    
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

<?php 


$query = "SELECT * FROM posts WHERE post_user = '{$db_username}' ";
    $select_all_posts_query = mysqli_query($connection,$query);

    if(mysqli_num_rows($select_all_posts_query) > 0){

while($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $the_post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_user'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        
        ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    Post by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php if($post_image == ""){ echo "y9DpT.jpg"; } else{echo $post_image;}?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>


                <hr>
                
   <?php }} else { echo "<h2>No activity</h2>"; } ?>

</div>


</div>

</div>


        <!-- /#page-wrapper -->
        
    <?php include "includes/footer.php" ?>
