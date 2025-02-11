<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    if(!isset($_GET['forgot'])){
        redirect('index');
    }


    if(ifItIsMethod('post')){

        if(isset($_POST['email'])) {

            $email = $_POST['email'];

            $length = 50;

            $token = bin2hex(openssl_random_pseudo_bytes($length));

            if(email_exists($email)){

                if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")){

                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    $subject = "Užsakymo Patvirtinimas";

                    try {
                        $mail = new PHPMailer(true);

                        // Server settings
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->Port       = 587;
                        $mail->CharSet    = 'UTF-8';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'keyon.customs@gmail.com';
                        $mail->Password   = getenv('GMAIL_APP_PASSWORD');

                        // Recipients
                        $mail->setFrom('keyon.customs@gmail.com', 'KeyON');
                        $mail->addAddress($email);

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'This is a test email';
                        $mail->Body = '<p>Please click <a href="http:/.local/reset.php?email='.$email.'&token='.$token.' ">here</a> to reset your password</p>';

                        $mail->send();

                        header('Location: index.php');
                    } catch (Exception $e) {
                        echo "Error sending email: {$mail->ErrorInfo}";
                    }
                }
            }
        }
     }
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                        <?php if(!isset( $emailSent)): ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                <?php else: ?>
                                <h2>Please check your email</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

