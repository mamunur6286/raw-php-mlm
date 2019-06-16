<?php
    require_once '../lib/Database.php';
    require_once '../lib/Session.php';
    Session::checkSession();
    require_once '../classes/createPin.php';
    $pin= new createPin();
    require_once '../classes/admin.php';
    $admin= new admin();
    require_once '../classes/transaction.php';
    $transaction= new transaction();
    require_once '../classes/setting.php';
    $setting= new setting();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blood Bank </title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>


<!-- Header Side Menu Start Here-->
<body class="skin-blue">
<div class="wrapper">
    <header class="main-header"><a href="index.php" class="logo"><b>BLOOD </b> Bank</a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
           <?php
               if (isset($_SESSION['adminId'])){
                   $admin_id=$_SESSION['adminId'];
               }
               $query="SELECT * FROM tbl_admin WHERE id='$admin_id'";
               $admin_result=database::connect()->query($query)->fetch_assoc();
           ?>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li><a href="#"><i class="fa fa-th"></i> Commission( <?php echo $admin_result['amount'] ?> )</a></li>



                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img width="30px" src=" <?php echo $admin_result['image'] ?>" class="img-circle" alt="User Image" /><span class="hidden-xs"><?php if(isset($_SESSION['adminName'])){ echo $_SESSION['adminName']; }?></span></a>

                        <ul class="dropdown-menu">
                            <li class="user-header"><img src="<?php echo $admin_result['image']; ?>" class="img-circle" alt="User Image" /><p><?php if(isset($_SESSION['adminName'])){ echo $_SESSION['adminName']; } ?> - User ID : ( <?php echo $admin_result['id'] ?> ) </p> </li>
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
