<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
    <section class="content-header"><h1>Transaction</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Transaction</li>
            <li class="active">Withdraw</li>
        </ol></section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel-heading">
                <h3 class="text-info text-center" style="font-weight: bold">Send Withdraw Request Here</h3>
            </div>
            <br>
            <div class="box">
                <div class="box-body">
                    <?php
                    if (isset($_SESSION['userId'])){
                        $user_id=$_SESSION['userId'];
                    }

                    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['withdraw_btn'])){
                        $tran_result= $transaction->withdrawAdmin($_POST,$user_id);
                    }
                    if(isset($tran_result)){
                        echo $tran_result;
                    }
                    ?>
                    <form class=""action=""method="post">
                        <div class="form-group">
                            <label>Bkash Mobile</label>
                            <input type="text" name="mobile" class="form-control" placeholder="Your amount">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="Your amount">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Your password">
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="submit" name="withdraw_btn" class="btn btn-success btn-block" value="Send Now">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>
    <section>
<?php
require_once 'inc/footer.php';
?>