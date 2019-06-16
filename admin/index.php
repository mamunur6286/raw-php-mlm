<?php
    require_once 'inc/header.php';
    require_once 'inc/sideber.php';
?>
<!-- Right side Threme color setting -->
      	<div class="content-wrapper">
	  	<section class="content-header"><h1> Dashboard <small>Control panel</small></h1>
    	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
       	</ol></section>

<!-- Main content -->
  	<section class="content">
    <div class="row">
    <?php
        $query="SELECT * FROM tbl_user WHERE activation='1'";
        $result=database::connect()->query($query)->num_rows;
    ?>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
            <div class="inner"><h3><?php echo $result; ?></h3><p>Total Active User</p></div>
            <div class="icon"><i class="ion ion-person-add "></i></div><a href="active_user.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div></div>

    <div class="col-lg-3 col-xs-6">
        <?php
        $query="SELECT * FROM tbl_transaction_admin WHERE confirm='0'";
        $result=database::connect()->query($query)->num_rows;
        ?>
        <div class="small-box bg-yellow">
            <div class="inner"><h3><?php echo $result; ?></h3><p>Total Transaction Request</p></div>
            <div class="icon"><i class="ion ion-stats-bars"></i></div><a href="pending_transaction.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div></div>

        <div class="col-lg-3 col-xs-6">
	<div class="small-box bg-green">
        <?php
        $query='SELECT * FROM tbl_admin';
        $result=database::connect()->query($query)->fetch_assoc();
        ?>
    <div class="inner"><h3><?php echo $result['amount']; ?></h3><p>Total Commission</p></div>
    <div class="icon"><i class="ion ion-stats-bars"></i></div><a href="total_transactiion_commission.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
   	</div></div>
        <?php
        $query='SELECT * FROM tbl_blood_donate';
        $result=database::connect()->query($query)->num_rows;
        ?>
        <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
    <div class="inner"><h3><?php echo $result; ?></h3><p>Total Blood Donor</p></div>
	<div class="icon"><i class="ion ion-person-add"></i></div><a href="blood_donate.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	</div></div>

	</div>
        <section>

<?php
    require_once 'inc/footer.php';
?>