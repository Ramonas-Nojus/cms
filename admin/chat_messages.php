<?php ob_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>
<?php session_start(); ?>
<?php 
if(isset($_SESSION['user_role'])) {
} else {
header("location: /cms/");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<style> 
        .user1_text { 
            margin: 20px;
            margin-right: 10px;
            font-size: 20px;
            width: max-content;
            padding: 10px;
            color: white;
            background: #2b62ed;
            border-radius: 10px;
        }
        .user2_text {
            margin: 20px;
            font-size: 20px;
            border: 3px;
            width: max-content;
            padding: 10px;
            background: #b0b0b0;
            border-radius: 10px;
        }
        .form {
            width: auto;
            display: flex;
            justify-content: right;
        }
            </style>

<?php 
    if(isset($_GET['username'])){
        $friends_username = $_GET['username'];
    }
     $session_username = $_SESSION['username'];
     $session_id = $_SESSION['user_id'];
        $select_chat = query("SELECT * FROM chat WHERE from_username = '$session_username' AND to_username = '$friends_username' OR to_username = '$session_username' AND from_username = '$friends_username' ");
        while($row = mysqli_fetch_array($select_chat)){
               $db_message = $row['message_content'];
               $from_username = $row['from_username'];
            ?> 
                    <?php 
                    if($from_username == $session_username){
                        echo "<div class='form'><p class='user1_text'>$db_message</p></div>";
                    } else {
                        echo "<div class=''><p class='user2_text'>$db_message</p></div>";
                    }
                    ?></p>
<?php } ?>
                </body>