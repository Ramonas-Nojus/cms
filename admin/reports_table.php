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
                Welcome to reports
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
            
            

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Report id</th>
                        <th>Reporter username</th>
                        <th>Reporter user id</th>
                        <th>Reported user</th>
                        <th>Repoted user id</th>
                        <th>Reason</th>
                        <th>Comment</th>

                   
        
                    </tr>
                </thead>
                
                      <tbody>
                      

  <?php 
    
    $query = "SELECT * FROM reports";
    $select_users = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_users)) {
        $report_id              = $row['report_id'];
        $user_id                = $row['user_id'];
        $username               = $row['username'];
        $reported_user          = $row['reported_user'];
        $reported_user_id       = $row['reported_user_id'];
        $reason                 = $row['reason'];
        $comment                = $row['comment'];
        
        echo "<tr>";
        
        echo "<td>$report_id </td>";
        echo "<td>$username</td>";
        echo "<td>$user_id</td>";
                  
        echo "<td>$reported_user</td>";
        echo "<td>$reported_user_id</td>"; 
        echo "<td>$reason</td>"; 
        echo "<td>$comment</td>";        
        

        
     
        echo "<td><a href='reports_table.php?ban=$reported_user_id&r_id=$report_id'>Ban</a></td>";
        echo "<td><a href='reports_table.php?reject=$report_id'>Reject report</a></td>";
        echo "</tr>";
    }
      ?>

            </tbody>
            </table>
            
            
<?php

if(isset($_GET['ban'])) {
    
    $the_user_id = escape($_GET['ban']);
    $the_report_id = escape($_GET['r_id']);
    
    $query = "UPDATE users SET user_role = 'banned' WHERE user_id = $the_user_id ";
    $ban_user_query = mysqli_query($connection, $query);
    $query = "DELETE  FROM reports WHERE report_id = $the_report_id ";
    $change_to_sub_query = mysqli_query($connection, $query);

    $delete_users_posts = query("DELETE FROM posts WHERE post_user_id = '$the_user_id' ");
    $delete_users_likes = query("DELETE FROM likes WHERE user_id = '$the_user_id' ");
    $delete_users_comment = query("DELETE FROM comments WHERE author_id = '$the_user_id' ");
    $delete_users_chat_from = query("DELETE FROM chat WHERE from_id = '$the_user_id' ");
    $delete_users_chat_to = query("DELETE FROM chat WHERE to_id = '$the_user_id' ");
    $delete_users_chat_friend1 = query("DELETE FROM friends WHERE friend1_id = '$the_user_id' ");
    $delete_users_chat_friend2 = query("DELETE FROM friends WHERE friend2_id = '$the_user_id' ");
    $delete_users_request_from = query("DELETE FROM requests WHERE from_id = '$the_user_id' ");
    $delete_users_request_to = query("DELETE FROM requests WHERE to_id = '$the_user_id' ");
    $delete_users_report = query("DELETE FROM reports WHERE user_id = '$the_user_id' ");

    deleteLikes();

    header("Location: reports_table");
    
    
}   





if(isset($_GET['reject'])){
    

    $the_report_id = escape($_GET['reject']);
    

    $query = " DELETE  FROM reports WHERE report_id = $the_report_id ";
    $change_to_sub_query = mysqli_query($connection, $query);
    if(!$change_to_sub_query){
        die("ERROR". mysqli_error($connection));
    }
    header("Location: reports_table");
    
    
    
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
