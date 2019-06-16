<?php
    require_once 'inc/header.php';
    require_once 'inc/sideber.php';
?>
 <!-- Right side column. Contains the navbar and content of the page -->
      	<div class="content-wrapper"><section class="content-header"><h1>Softeare All Setting Information</h1>
		<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Softeare All Setting Information</li>
        </ol>
        </section>

<!-- Main content -->
        <br>
        <br>
		<section class=" container-fluid">
            <div class="box box-primary"></div>
            <div class="box" style="padding: 10px">


                <?php
                    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['setting_btn'])){
                        $update_result= $setting->updateSetting($_POST);
                        if(isset($update_result)){
                            echo $update_result;
                        }
                    }
                    $select_setting="SELECT * FROM tbl_setting ";
                    $select_result=database::connect()->query($select_setting)->fetch_assoc();

                    $select_setting="SELECT * FROM tbl_user ";
                    $total_row=database::connect()->query($select_setting)->num_rows;
                ?>
                <form role="form" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Withdraw Commission </h4>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" value="<?php echo $select_result['withdraw_commission']; ?>" name="withdraw_commission">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <h4>Send To User Commission</h4>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" value="<?php echo  $select_result['send_user_commission']; ?>" name="send_user_commission">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <h4>Joining Amount For General User</h4>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" value="<?php echo $select_result['general_user_amount']; ?>" name="general_user_amount">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <h4>Joining Amount For Special User</h4>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" value="<?php echo $select_result['special_user_amount']; ?>" name="special_user_amount">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <h4>Spacial Member Commission</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Amount" value="<?php echo  $select_result['special_user_commission']; ?>" name="special_user_commission"><br /><br />
                                        <input type="text" class="form-control" placeholder="Total Person" value="<?php echo $select_result['total_special_user']; ?>" name="total_special_user">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Direct Referral Commission</h4>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" value="<?php echo $select_result['direct_refer']; ?>" name="direct_refer">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <h4>Global Lifetime Commission</h4>
                            <p style="font-size: 15px">(<?php echo  $select_result['global_commission']; ?>/<?php echo $total_row ?>)=<?php echo  number_format($select_result['global_commission']/ $total_row,2) ; ?></p>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" value="<?php echo  $select_result['global_commission']; ?>" name="global_commission">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <h4>Level Commission</h4>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" placeholder="Level -1" value="<?php  echo $select_result['level_commission']; ?>" name="level_commission">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <h4>Spacial Bonuses Commission</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Amount" value="<?php  echo $select_result['special_amount']; ?>"  name="special_amount"><br /><br />
                                        <input type="text" class="form-control" placeholder="How Many Referral" value="<?php echo $select_result['num_refer']; ?>" name="num_refer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <input type="submit" name="setting_btn" class="btn btn-primary form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
            </div>
            <div class="box box-danger">
            </div>
        </section>
	<?php include 'inc/footer.php';?>
