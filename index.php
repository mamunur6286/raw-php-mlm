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
                    <div class="col-lg-3 col-xs-6">
                        <?php
                            if(isset($_SESSION['userId'])){
                                $user_id=$_SESSION['userId'];
                            }
                            $query="SELECT * FROM tbl_user_amount WHERE user_id='$user_id'";
                            $resust_user_amount=database::connect()->query($query)->fetch_assoc();


                            date_default_timezone_set('Asia/Dhaka');
                            $update_date=date('d',time());
                            $pay_date=$resust_user_amount['today_date'];
                            if($pay_date<$update_date || $update_date==1){
                                $update_time="UPDATE tbl_user_amount SET t_referral_commission ='0',t_level_commission ='0',t_bonus_commission ='0',t_global_commission ='0',t_special_commission ='0',today_date='$update_date' WHERE user_id='$user_id'";
                                database::connect()->query($update_time);
                            }

                        ?>
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['referral_commission'],2) ; ?> TK</h3><p>Direct Referral</p></div>
                            <div class="icon"><i class="ion ion-bag"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['global_commission'],2) ; ?>  TK</h3><p>Golobal Commission</p></div>
                            <div class="icon"><i class="ion ion-stats-bars"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['level_commission'],2) ; ?>  TK</h3><p>Generation Commission</p></div>
                            <div class="icon"><i class="ion ion-person-add"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['bonus_commission'],2) ; ?>  TK</h3><p>Bonus Commission</p></div>
                            <div class="icon"><i class="ion ion-pie-graph"></i> </div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-primary">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['special_commission'],2) ; ?>  TK</h3><p>Special User Bonous</p></div>
                            <div class="icon"><i class="ion ion-pie-graph"></i> </div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['t_referral_commission'],2) ; ?>  TK</h3><p>Today Direct Referral</p></div>
                            <div class="icon"><i class="ion ion-bag"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['t_global_commission'],2) ; ?>  TK</h3><p>Today Global Commission</p></div>
                            <div class="icon"><i class="ion ion-stats-bars"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['t_level_commission'],2) ; ?>  TK</h3><p>Today Generation Commission</p></div>
                            <div class="icon"><i class="ion ion-person-add"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['t_bonus_commission'],2) ; ?>  TK</h3><p>Today Bonus Commission</p></div>
                            <div class="icon"><i class="ion ion-pie-graph"></i> </div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-primary">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['t_special_commission'],2) ; ?>  TK</h3><p>Today Special Commission</p></div>
                            <div class="icon"><i class="ion ion-pie-graph"></i> </div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>


                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['payment'],2) ; ?>  TK</h3><p>Total Ammount</p></div>
                            <div class="icon"><i class="ion ion-stats-bars"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner"><h3><?php echo number_format($resust_user_amount['t_referral_commission']+$resust_user_amount['t_level_commission']+$resust_user_amount['t_global_commission']+$resust_user_amount['t_bonus_commission']+$resust_user_amount['t_special_commission'],2); ; ?>  TK</h3><p>Today Total Ammount</p></div>
                            <div class="icon"><i class="ion ion-person-add"></i></div><a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div></div>
                </div>
                <section>


<?php
    require_once 'inc/footer.php';
?>