<?php include "includes/admin_header.php" ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <div id="wrapper">
        
  

        <!-- Navigation -->
 
        <?php include "includes/admin_navigation.php" ?>
        
        
        <style> 

.del-btn{
    margin-top: 50px;
    display: block;
    margin-left: auto;
    margin-right: 0px;
    width: 300px;
    object-fit: cover;
}


}


        
        
        img {    
            border-radius: 50%;    
            width: 75px;    
            height: 75px;    
            object-fit: cover;
            margin-right: 10px;
    
        }

        .input {
            margin-top: -33px;
             width: 80%;

        }

        .textarea {
            height: 300px;
            width: auto;
            resize:none;
        }

        
        .chat-window{
            width: auto;
            height: 300px;
            border: 5px solid;
            border-radius: 10px;
            overflow-y: scroll;

        }


            </style>
    

    
    <?php
    
    $session_username = $_SESSION['username'];
    $session_id = $_SESSION['user_id'];
    
    ?>


<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <h1 class="page-header">
                Chat with
                <small><?php echo $_GET['username'] ?></small>
            </h1>
            
            <?php if(isset($_GET['username'])){
                $friends_username = $_GET['username'];
            } else {
                redirect("/cms/admin/friends.php");
            } ?>





            <div class="chat-window" id="output">
                
        </div>


<?php  


        $select_friend = query("SELECT * FROM users WHERE username = '$friends_username' ");
        $row = mysqli_fetch_array($select_friend);
        $friends_id = $row['user_id'];

        if(isset($_POST['send_message'])){
                $message = $_POST['message'];
               

            $sending_message_to_db_query = query("INSERT INTO chat(message_content,from_username,to_username,from_id,to_id) VALUES('{$message}','{$session_username}','{$friends_username}','{$session_id}', '{$friends_id}')");


        }




?>

            <div>
            <form action="/cms/admin/chat.php?username=<?php echo  $friends_username; ?>" method="post">
            
            <div class="">
                  <button type="submit" class="btn btn-default del-btn btn-primary" name="send_message">Send</button>
            </div>
                <div class="form-group input">
                  <input type="text" placeholder="Your Text Here" class="form-control" name="message" id="inText">
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

<script>


setInterval(function(){
      $('#output').load('chat_messages.php?username=<?php echo $friends_username; ?>');
 },1);








</script>