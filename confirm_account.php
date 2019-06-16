<?php
    require_once 'lib/Database.php';
    require_once 'lib/Session.php';
    Session::checkUserLogin();
    require_once 'classes/adminLogin.php';
    $adminLogin= new adminLogin();
    require_once 'classes/confirm_with_move_amount.php';
    $confirm= new Confirm();
    require_once 'classes/class.phpmailer.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blood Bank || Confirm Account</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo"><a href=""><b>BLOOD </b> BANK</a></div>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Enter the email confirmation code</p>


        <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }
            if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['resend_btn'])){

                $activation_code=rand(10,99).rand(10,99).rand(10,99);
                $query="UPDATE tbl_user SET activation_code='$activation_code' WHERE id='$id'";
                database::connect()->query($query);

                $sql = "SELECT * FROM tbl_user WHERE id='$id'";
                $result = database::connect()->query($sql)->fetch_assoc();
                $id=$result['id'];
                $name=$result['name'];
                $email=$result['email'];
                $subject = "welcome to Blood Bank";
                $msg = "Thanks For Registration $name, Your ID: $id And Your Account Activation code :".$activation_code.' and your refer link:-http://mybloodbd.com/soft/register.php?refer_id='.$id;

                $body             = $msg;
                $mail = new PHPMailer();
                $mail->AddReplyTo("info@mybloodbd.com","Blood Bank");
                $mail->SetFrom('info@mybloodbd.com', 'Blood Bank');
                $mail->AddReplyTo("info@mybloodbd.com","Blood Bank");
                $address = $email;
                $mail->AddAddress($address, "User");
                $mail->Subject    = $subject;
                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                $mail->MsgHTML($body);
                $mail->Send();

            }
            if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['confirm_btn'])){
                $confirm_result = $confirm->confirmAccount($_POST,$id);
            }
        ?>
        <?php
        if(isset($confirm_result)){
            echo $confirm_result;
        }
        ?>
        <form role="form" enctype="multipart/form-data" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="confirm_code" placeholder="Confirm code"/>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" name="confirm_btn" class="btn btn-primary btn-block">Confirm</button>
                </div><!-- /.col -->
            </div>
        </form>
        <form method="post">
            <div class="row">
                <div class="col-md-3"></div>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <button style="margin-top: -48px;background-color: white;border: 0px;color: #f05151;" type="submit" name="resend_btn" class="btn btn-primary btn-block ">Resend Code</button>
                </div><!-- /.col -->
                <div class="col-md-3"></div>
            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.3 -->
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>