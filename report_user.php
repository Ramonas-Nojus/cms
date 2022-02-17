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
    $username = $_GET['username'];
} else {
    redirect("/cms/");
}

    if(isLoggedIn()){
    
        
    
    ?>

<?php 

        if(isset($_POST["report"])){
            $reason = $_POST['reason'];
            $comment = $_POST['comment'];

        }


?>


<form action="/cms/report_user.php?username=<?php echo $username; ?>" method="post">
    <div class="report-window" >
        <h1>
            Report user (<?php echo $username; ?>)
        </h1>

        <div class="form-group">
            <label for="Reason" class="sr-only">Reason</label>
            <input type="text" name="reason" id="" class="form-control" placeholder="Reason" autocomplete="on">
        </div>
        <div class="form-group">
            <label for="Comment" class="sr-only">Comment</label>
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
        echo "<h1>You need to log in to report <<<strong>$username</strong> >></h1>";
    } ?>


   
        </div>
        <hr>


<?php include "includes/footer.php";?>
