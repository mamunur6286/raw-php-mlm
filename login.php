<?php
    require_once 'lib/Database.php';
    require_once 'lib/Session.php';
    require_once 'classes/userLogin.php';
    $userLogin= new userLogin();
    Session::checkUserLogin();
    Session::checkLogin();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
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

<body class="bg-gray">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="box" style="margin-top: 100px;margin-top: 100px; border: 1px solid;border-radius: 20px;box-shadow: 2px 1px 22px -1px;">
                <div class="login-logo" style="margin-top: 20px">
                    <div class="login-logo"><a href="dashboard.php"><b>BLOOD </b> BANK</a></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="text-center" style="padding-bottom: 100px; margin-top: 50px">
                            <a href="admin/login.php" class="btn btn-success btn-block">Admin Login</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center" style="padding-bottom: 100px; margin-top: 50px">
                            <a href="user_login.php" class="btn btn-success btn-block">User Login</a>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>

            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

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