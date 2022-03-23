<?php ob_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>
<?php session_start(); ?>
<?php 
if(isset($_SESSION['user_role'])) {
} else {
header("location: /cms/");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Bootstrap Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="/cms/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/cms/admin/css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/cms/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <link href="/cms/admin/css/styles.css" rel="stylesheet">
 <link href="/cms/css/admin/_variables.scss" rel="stylesheet">
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <!-- <script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script> -->
    <!-- Can use this one below as well -->
<!--   <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script> -->
<script src="/cms/admin/js/jquery.js"></script>
</head>
<body onload="scrollDown()">
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
    width: 20%;
    object-fit: cover;
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
    <div class="form-group">
            <form action="/cms/admin/chat.php?username=<?php echo  $friends_username; ?>" method="post">
    <div class="">
            <button type="submit" class="btn  del-btn btn-primary" name="send_message">Send</button>
    </div>
        <div class="form-group input">
            <input type="text" placeholder="Your Text Here" class="form-control" name="message">
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