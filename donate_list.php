<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blood Manage
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Blood</a></li>
            <li class="active">Donate List</li>
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
                        ?>Your Total Blood Donate List</h2>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if (isset($_SESSION['userId'])) {
                        $userId = $_SESSION['userId'];
                    }
                        $query="SELECT * FROM tbl_blood_donate WHERE user_id='$userId'";
                        $result=database::connect()->query($query);

                    ?>
                    <table id="example1" class="table text-center table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Donate By</th>
                            <th>Quantity</th>
                            <th>Mobile No</th>
                            <th>Donate To</th>
                            <th>Donate Date</th>
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
                                    <td><?php echo $value['donate_by']; ?></td>
                                    <td><?php echo $value['quantity']; ?></td>
                                    <td><?php echo $value['mobile']; ?></td>
                                    <td><?php echo $value['donate_to']; ?></td>
                                    <td>
                                        <?php  echo date('d F Y',strtotime($value['donate_date'])) ?>
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