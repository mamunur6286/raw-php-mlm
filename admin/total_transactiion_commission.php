<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dasboard
            <small>Commission</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Commission</a></li>
            <li class="active">Total</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <div class="box-header">
                    <?php
                    if(isset($_GET['delId'])){
                        $del_id=$_GET['delId'];
                        $query="DELETE  FROM tbl_admin_commission WHERE id='$del_id'";
                        $result=database::connect()->query($query);

                    }
                    ?>
                    <h2 class="box-title">Total Transaction Commission</h2>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?php

                    $query="SELECT * FROM tbl_admin_commission ORDER BY id DESC ";
                    $result=database::connect()->query($query);
                    ?>
                    <table id="example1" class="table  text-center table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Amount</th>
                            <th>Commission Type</th>
                            <th>Withdraw Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($result->num_rows>0) {
                            $i=1;
                            foreach ($result as $value){
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $value['amount']; ?></td>
                                    <td><?php echo $value['commission_type']; ?></td>
                                    <td><?php echo date('d M Y,h:i:s',strtotime($value['get_date'])); ?></td>
                                    <td>
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this commission?')" href="?delId=<?php echo $value['id']; ?>"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->



<?php
require_once 'inc/footer.php';
?>