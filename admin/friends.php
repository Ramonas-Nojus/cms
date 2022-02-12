<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
        
  

        <!-- Navigation -->
 
        <?php include "includes/admin_navigation.php" ?>
        
        
    <style>

    .frind_request {

        font-size: 20px;
        border: 3px solid;
        border-radius: 10px;
        width: max-content;
        padding: 10px;
        margin: 10px;

    }

    .b {
        width:35%;
        display:inline-table;
        margin-bottom: 10px;
        }


    img {
        border-radius: 50%;
        width: 75px;
        height: 75px;
        object-fit: cover;
        margin-right: 10px;

    }

    </style>






<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <h1 class="page-header">
                Welcome to friends
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
            
            


            <?php 
    
    $username = $_SESSION['username'];

    $query = "SELECT * FROM friends WHERE friend2_username = '$username' ";
    $select_users = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id             = $row['id'];
        $friend              = $row['friend1_username'];
        $friend_id           = $row['friend1_id'];

        $get_users_info = query("SELECT * FROM users WHERE username = '$friend' ");
        $row = mysqli_fetch_array($get_users_info);
        
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];

        ?> 
        
        
        <div class="media">
         
         <a class="pull-left" href="/cms/user_profile/<?php echo $friend;?>">
             <img class="media-object profilie_image" width="150px" border-radius="50%" src="/cms/images/<?php if(empty($user_image)){ echo "person-placeholder.jpg"; } else { echo $user_image; }
             ?>" alt="">
         </a>
         <div class="media-body">
             <h4 class="media-heading"><?php echo $friend; ?>
                <small><?php echo "</br>".$user_firstname." ".$user_lastname; ?></small>
             </h4>
             <a class="btn btn-primary" href="/cms/user_profile/<?php echo $friend; ?>">See Profile</span></a>
             <a class="btn btn-primary" href="/cms/admin/chat.php?username=<?php echo $friend; ?>">Send Message<span class="glyphicon glyphicon-chevron-right"></span></a>
             
          
 
         </div>
     </div>
        
        <?php
                
   
    } 
    $query = "SELECT * FROM friends WHERE friend1_username = '$username' ";
    $select_users = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id             = $row['id'];
        $friend              = $row['friend2_username'];
        $friend_id           = $row['friend2_id'];

        $get_users_info = query("SELECT * FROM users WHERE username = '$friend' ");
        $row = mysqli_fetch_array($get_users_info);
        
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];

        ?> 
        
        
        <div class="media">
         
         <a class="pull-left" href="/cms/user_profile/<?php echo $friend; ?>">
             <img class="media-object profilie_image" width="150px" border-radius="50%" src="/cms/images/<?php if(empty($user_image)){ echo "person-placeholder.jpg"; } else { echo $user_image; }
             ?>" alt="">
         </a>
         <div class="media-body">
             <h4 class="media-heading"><?php echo $friend;   ?>
                <small><?php echo "</br>".$user_firstname." ".$user_lastname; ?></small>
             </h4>
             <a class="btn btn-primary" href="/cms/user_profile/<?php echo $friend; ?>">See Profile</span></a>
             <a class="btn btn-primary" href="/cms/admin/chat.php?username=<?php echo $friend; ?>">Send Message<span class="glyphicon glyphicon-chevron-right"></span></a>
             
          
 
         </div>
     </div>
        
        <?php
                

   
    }


   




      ?>




   

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php include "includes/admin_footer.php" ?>
