<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


 <style>

    .center {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        align-items: center;
    }

    .report-window {
        width: 500px;
    }

 </style>
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

    <div class="center">

    <?php 

if(isset($_GET['username'])){
    $reported_username = $_GET['username'];
} else {
    redirect("/");
}
    if(isLoggedIn()){
    
    ?>

<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {

            $reason = trim($_POST['reason']);
            $comment = trim($_POST['comment']);
            $user_id = $_SESSION['user_id'];
            $username = $_SESSION['username'];

            $error = [
                'reason' => '',
                'comment' => ''
            ];

            if(empty($reason)){
                $error['reason'] = "Reason canot be empty";
            }

            
            if(empty($comment)){
                $error['comment'] = "Comment canot be empty";
            }

            foreach($error as $key=>$value){
                if(empty($value)){
                    unset($error[$key]);
                }
            }

            if(empty($error)){

            $get_user_info = query("SELECT * FROM users WHERE username = '$reported_username' ");
            while($row = mysqli_fetch_array($get_user_info)){
                $reported_user_id = $row["user_id"];
                $reported_user = $row["username"];
            }
        
            $add_report_query = query("INSERT INTO  reports(user_id,username,reported_user,reported_user_id,reason,comment) VALUES('{$user_id}','{$username}','{$reported_user}','{$reported_user_id}','{$reason}','{$comment}') ");
            redirect('/');
        }
        }
?>


<form action="/report_user.php?username=<?php echo $reported_username; ?>" method="post">
    <div class="report-window" >
        <h1>
            Report user (<?php echo $reported_username; ?>)
        </h1>

        <div class="form-group">
            <label for="Reason" class="sr-only">Reason</label>
            <p><?php echo isset($error['reason']) ? $error['reason'] : '' ?></p>
            <input type="text" name="reason" id="" class="form-control" placeholder="Reason" autocomplete="on">
            
        </div>
        <div class="form-group">
            <label for="Comment" class="sr-only">Comment</label>
            <p><?php echo isset($error['comment']) ? $error['comment'] : '' ?></p>
            <textarea class="form-control" name="comment" id="" cols="30" rows="10" placeholder="Comment"></textarea>
            
        </div>
        <!-- <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on">
        </div> -->
        <div class="form-group">
           <button class="form-control btn btn-danger" type="submit" name="report">Report</button>
        </div>
        
    </div>
    </form>

    <?php } else {
        echo "<h1>You need to log in to report <<<strong>$reported_username</strong> >></h1>";
    } ?>
        </div>
        <hr>

<?php include "includes/footer.php";?>
