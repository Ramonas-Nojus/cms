<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php include "includes/class.autoload.php"; ?>


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

.remove_friend {
    object-fit: cover;
    margin-top: 30px;
}

.center {
    display: flex;
  justify-content: center;
  align-items: center;
  
}


.report_a {
    color: hotpink;
    /* text-decoration: none; */
}
.report  {
    margin-top: 45px;
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

            

                <img class="img" src="/cms/images/<?php 

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
                    redirect("/cms/user_profile/$db_username");  
                }

                if(isset($_POST['remove_friend'])){
                     $friends_id = $_POST['remove_friend'];

                    $remove_friend_query = query("DELETE FROM friends WHERE friend1_id = $friends_id AND friend2_id =  $user_id OR  friend2_id = $friends_id AND friend1_id =  $user_id");
                    redirect("/cms/user_profile/$db_username");  
                }


                
                
                $query = "SELECT * FROM requests WHERE from_id = '{$user_id}' AND to_username = '$db_username' ";
                $get_request_query = mysqli_query($connection, $query);   

                $row = mysqli_fetch_array($get_request_query);

                $signed_in_user = $_SESSION['username'];    //users username who is signed in right now
                                                            //db_username users username whose profile this is 

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

                <form action="/cms/admin/profile" method="post">
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
                    
                        <form action="/cms/admin/notifications.php" method="post">
               <div class="center">
                <button class="add_friend btn btn-primary" type="submit"  ?>
                  see request
                </button>
                </div>
                </form>
                </div>
                    
                    <?php 

                    }
                
                
                else { ?>
                
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
                    <form action="/cms/login" method="post">
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
                <a class="report_a" href="/cms/report/<?php echo $username; ?>" >Report</a>
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

<?php 

            $getPosts = new Posts();
            $usersPosts = $getPosts->usersPosts($db_username);

            if(empty($usersPosts)){
                echo "<h2>NO ACTIVITY</h2>";
            } else {

            foreach($usersPosts as $row){
                $the_post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];            
            
        
        ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="/cms/post/<?php echo $the_post_id ?>"><?php echo $post_title ?></a>
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
                
   <?php } } ?>

</div>


</div>

</div>


        <!-- /#page-wrapper -->
        
    <?php include "includes/footer.php" ?>
