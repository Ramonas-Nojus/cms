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
</style>
<?php include "includes/admin_header.php" ?>
<?php
   if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}' "; 
    $select_user_profile_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_user_profile_query)) {
    
        $db_username = $row['username'];
        $user_password= $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $db_user_image = $row['user_image'];
        $user_role= $row['user_role'];

if($user_role == 'banned'){
    redirect('/cms/includes/logout.php');
        } 
    }
}
    ?>
<?php 
if(isset($_POST['edit_user'])) {
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
           
        $query = "UPDATE users SET ";
        $query .="user_firstname  = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}' ";
        $query .= "WHERE user_id = '{$user_id}' ";
        
        $edit_user_query = mysqli_query($connection,$query);
   } 
?> 
    
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>
<div id="page-wrapper">
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
  <h1 class="page-header">
                Welcome to profile
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
             <form action="profile" method="post" enctype="multipart/form-data">                    
            <div class="form-group img">
            <?php 
                if(isset($_FILES['user_image'])) {

                    if($_FILES['user_image']['size'] != 0)  {

                    $user_image = $_FILES['user_image']['name'];
                    $user_image_temp = $_FILES['user_image']['tmp_name'];

                    move_uploaded_file($user_image_temp, "../images/$user_image" );

                    $query = "UPDATE users SET user_image = '{$user_image}' WHERE user_id = '{$user_id}' ";
                    $image_query = mysqli_query($connection,$query);
                        redirect("profile");
                } }
            ?>
                <img class="img" src="/cms/images/<?php
                if(empty($db_user_image)){
                    echo "person-placeholder.jpg";
                } else {
                    echo $db_user_image;
                    } ?>">
                <input type="file" class="file" name="user_image">
                    <?php 
                        if(isset($_POST['delete_image'])){
                           $query = "UPDATE users SET user_image = 'person-placeholder.jpg' WHERE user_id = $user_id";
                           $reset_image = mysqli_query($connection, $query);
                           redirect("profile");
                        }
                    ?> 
                <input type="submit" value="Delete Image" class="btn btn-default del-btn btn-primary " name="delete_image" ></br>
                </div>
      <div class="form-group input">
         <label for="firstname">Firstname</label>
          <input type="text" value="<?php echo $user_firstname; ?>" class="form-control " name="user_firstname">
      </div>
       <div class="form-group ">
         <label for="lastname">Lastname</label>
          <input type="text" value="<?php echo $user_lastname;  ?>" class="form-control" name="user_lastname">
      </div>
      <div class="form-group "> 
         <label for="username">Username</label>
         <?php if(isset($_POST['username'])){
               $username = $_POST['username'];
              if($username == $db_username){  
              } elseif (username_exists($username)){
                  echo "<br>this username alrady exists";
              } else{     
                    $query = "UPDATE users SET username = '$username' WHERE user_id = $user_id ";
                    $query2 = "UPDATE comments SET comment_author = '$username' WHERE author_id = $user_id ";
                    $comment_query = mysqli_query($connection,$query2);  
                    $username_query = mysqli_query($connection,$query);      
            }
          } ?> 
          <input type="text" value="<?php echo $db_username; ?>" class="form-control" name="username">
      </div>
      <div class="form-group ">
         <label for="email">Email</label>
         <?php
          echo $user_email;
          echo "</br>";
         if(isset($_POST['change_email'])){
            $email = $_POST['change_email'];
           if (email_exists($email)){
               echo "<br>this email alrady exists ";
           } else {   
                 $query = "UPDATE users SET user_email = '$email' WHERE user_id = $user_id ";
                 $username_query = mysqli_query($connection,$query);  
                 redirect('profile');   
         }
        }
         if(isset($_GET['change_email'])){
            echo "<input type='text' class='form-control' name='change_email'><a href='/cms/admin/profile.php'>cancel</a> ";
         } else { echo "<a href='/cms/admin/profile.php?change_email'>change email</a>"; } ?>
      </div>
      <div class="form-group ">
         <label for="password">Password</label>
         <?php
         if(isset($_POST['change_password'])){
            $password = $_POST['change_password'];
           if (strlen($password) <= 5 ){
               echo "<br>password is to short ";
           } else {   
            $password = mysqli_real_escape_string($connection, $password);
            $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));
            $query = "UPDATE users SET user_password = '$password' WHERE user_id = $user_id ";
            $password_query = mysqli_query($connection,$query);  
            redirect('profile');  
         }
        }
         if(isset($_GET['change_password'])){
            echo "<input type='text' class='form-control' name='change_password'><a href='/cms/admin/profile.php'>cancel</a> ";
         } else { echo "<a href='/cms/admin/profile.php?change_password'>change password</a>"; } ?>
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
      </div>
</form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper --> 
    <?php include "includes/admin_footer.php" ?>