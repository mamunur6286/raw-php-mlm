<?php
    require_once 'lib/Database.php';
    require_once 'lib/Session.php';
    Session::checkUserLogin();
    require_once 'classes/user.php';
    $user= new user();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Blood Bank || User Register </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />


  </head>
  	<body class="register-page">
    <br>
    <br>
    <div class="register-logo"><a href="#"><b>BLOOD </b> BANK</a></div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                    <div class="register-box-body"><p style="font-size: 18px" class="login-box-msg">Register a new membership</p>
                        <?php
                        if(isset($_GET['refer_id'])) {
                            $refer_Id = $_GET['refer_id'];
                        }
                        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['register_btn'])){

                            $message= $user->register($_POST,$_FILES);
                        }
                        ?>
                        <?php
                        if(isset($message)){
                            echo $message;
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input type="file" class=""  name="image" >
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" name="name" placeholder="Full Name"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile'] ?>" name="mobile" placeholder="Mobile No"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" value="<?php if(isset($_POST['blood'])) echo $_POST['blood'] ?>" name="blood" placeholder="Blood Group"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address'] ?>" placeholder="Address: Area"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="police_station" value="<?php if(isset($_POST['police_station'])) echo $_POST['police_station'] ?>" placeholder="Address: Police Station"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="district" value="<?php if(isset($_POST['district'])) echo $_POST['district'] ?>" placeholder="Districts"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="pin" value="<?php if(isset($_POST['pin'])) echo  $_POST['pin'] ?>" placeholder="PIN CODE"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="refer_id" value="<?php if (isset($refer_Id)) echo $refer_Id; ?>" placeholder="REFERRAL ID"/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="email" value="<?php if(isset($_POST['email'])) echo  $_POST['email'] ?>" placeholder="Email"/>
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" placeholder="Password"/>
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" name="re_password" value="<?php if(isset($_POST['re_password'])) echo $_POST['re_password'] ?>" placeholder="Retype password"/>
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="checkbox icheck">
                                                <label>
                                                    <input name="term" type="checkbox" value="1"> I agree to the <a href="#">terms</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <input type="submit" class="btn btn-primary btn-block btn-flat" name="register_btn" value="Register">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>
                    </div>
                    <div class="social-auth-links text-center"><a style="font-size: 18px" href="user_login.php" class="text-center">I already have a membership</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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