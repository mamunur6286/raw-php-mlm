<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Income History
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Income History</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">
                        <?php
                        if (isset($_SESSION['userName'])){
                            echo  '<b>'.$_SESSION['userName'].' </b>';
                        }
                        ?> Your All Income History Here</h2>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?php
                    if(isset($_GET['delId'])){
                        $del_id=$_GET['delId'];
                        $query="DELETE  FROM tbl_transaction_user WHERE id='$del_id'";
                        $result=database::connect()->query($query);

                    }
                    if (isset($_SESSION['userId'])){

                        $userId=$_SESSION['userId'];

                        $query="SELECT * FROM tbl_user_amount WHERE user_id='$userId'";
                        $result=database::connect()->query($query)->fetch_assoc();

                    }
                    ?>
                    <table id="example1" class="table text-center table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Amount</th>
                            <th>Type Of Income</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><?php echo $result['referral_commission']; ?></td>
                                <td>Referral Commission</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><?php echo $result['level_commission']; ?></td>
                                <td>Level Commission</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><?php echo $result['bonus_commission']; ?></td>
                                <td>Bonus Commission</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><?php echo $result['global_commission']; ?></td>
                                <td>Global Commission</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><?php echo $result['special_commission']; ?></td>
                                <td>Special Commission</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->



<?php
require_once 'inc/footer.php';
?>