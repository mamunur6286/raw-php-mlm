
<?php
    require_once 'lib/Database.php';
    require_once 'lib/Session.php';
    Session::checkUserSession();

    require_once 'classes/user.php';
    $user= new user();
    require_once 'classes/transaction.php';
    $transaction= new transaction();
    date_default_timezone_set('Asia/Dhaka');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blood Bank </title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="plugins/css/jquery-ui.min.css" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('#datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
        });
    </script>
</head>


<!-- Header Side Menu Start Here-->
<body class="skin-blue">
<div class="wrapper">
    <header class="main-header"><a href="index.php" class="logo"><b>BLOOD </b> Bank</a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
            <?php
            if (isset($_SESSION['userId'])){
                $user_id=$_SESSION['userId'];
            }
                $query="SELECT * FROM tbl_user WHERE id='$user_id'";
                $result=database::connect()->query($query)->fetch_assoc();

                $check_query="SELECT payment FROM tbl_user_amount WHERE user_id='$user_id'";
                $check_balance=database::connect()->query($check_query)->fetch_assoc();
            ?>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li><a href="#"><i class="fa fa-th"></i> USER ID ( <?php echo $result['id'] ?> )</a></li>
                    <li><a href="#"><i class="fa fa-th"></i> Account Type ( <?php echo $result['user_type'] ?> ) </a></li>
                    <li><a href="#"><i class="fa fa-th"></i> Total Balance ( <?php echo number_format($check_balance['payment'],2); ?> )</a></li>


                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img width="30px" src=" <?php echo $result['image'] ?>" class="img-circle" alt="User Image" /><span class="hidden-xs">  <?php if(isset($_SESSION['userName'])){ echo $_SESSION['userName']; }?></span></a>

                        <ul class="dropdown-menu">
                            <li class="user-header"><img src=" <?php echo $result['image'] ?>" class="img-circle" alt="User Image" /><p><?php if(isset($_SESSION['userName'])){ echo $_SESSION['userName']; } ?> - User ID : <?php if(isset($_SESSION['userId'])){ echo $_SESSION['userId']; } ?> </p> </li>
                            <li class="user-footer"><div class="pull-left"><a href="profile.php" class="btn btn-default btn-flat">Profile</a></div>
                                <?php
                                if (isset($_GET['action'])&& $_GET['action']=='logout'){
                                    Session::destroy();
                                }
                              ?>
                                    <div class="pull-right"><a href="?action=logout" class="btn btn-default btn-flat">Sign out</a></div>
                            </li></ul></li></ul></div>
        </nav>
    </header>
