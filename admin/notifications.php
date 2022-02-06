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

               ?> 
               
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
                   <button class="b btn btn-primary">accept</button> <button class="b btn btn-danger">delete</button>
               </div>
               
               <?php    //    echo $from_username." wants to be your friend";
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
