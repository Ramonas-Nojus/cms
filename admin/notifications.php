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
                Welcome to notifications
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
            
            

           <?php 
           
           $user_id = $_SESSION['user_id'];
           $username = $_SESSION['username'];

           $get_request_query = query("SELECT * FROM requests WHERE to_id = '$user_id' AND to_username = '$username' ");
           
           while($row = mysqli_fetch_array($get_request_query)){
               $to_username = $row['to_username'];
               $from_username = $row['from_username'];
               $from_id = $row['from_id'];
               $to_id = $row['to_id'];
               $request_id = $row['id'];

               ?> 
               

            <form action="notifications.php" method="post">
               <div class="frind_request">
               <?php 
                   
                   $users_image_query = query("SELECT * FROM users WHERE username = '$from_username' "); 

                   while($row = mysqli_fetch_array($users_image_query)){
                    $user_image = $row['user_image'];
                    }
                   
                   ?>
                   <div class="pull-left">
                   <img src="/cms/images/<?php echo $user_image; ?>">
                   </div>
                   <a href="/cms/user_profile/<?php echo $from_username; ?>"><?php  echo $from_username; ?></a> wants to be your friend</br>
                   <button class="b btn btn-primary" name="accept_request" value="<?php echo $request_id; ?>">accept</button> <button class="b btn btn-danger" name="decline_request">delete</button>
               </div>
               </form>


               
<?php 

if(isset($_POST['accept_request']) ){
    if($_POST['accept_request'] == $request_id ){
    // friend1 is who sent request friend2 who get it
   $id = $_POST['accept_request'];
    $add_friend_query = query("INSERT INTO friends(friend1_id,friend2_id,friend1_username,friend2_username) VALUES('{$from_id}','{$to_id}','{$from_username}', '{$to_username}')");
    $delete_request = query("DELETE FROM requests WHERE id = $id");
    redirect("notifications.php");
    

}  }

 } ?>
            
    
            

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php include "includes/admin_footer.php" ?>
