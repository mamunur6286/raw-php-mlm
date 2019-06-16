<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Pin Manage
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pin Manage</a></li>
            <li class="active">General Pin</li>
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
                        Total General Pin List</h2>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if(isset($_GET['del_id'])){
                        $del_id=$_GET['del_id'];

                        $query="DELETE  FROM tbl_general_user WHERE id='$del_id'";
                        $result=database::connect()->query($query);
                        if($result){
                            echo "<p class='alert alert-success' ><strong>Success!</strong> Your pin delete success.</p>";
                        }
                    }
                    $query="SELECT * FROM tbl_general_user ORDER BY id DESC ";
                    $result=database::connect()->query($query);
                    ?>
                    <table id="example1" class="table text-center table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Pin Number</th>
                            <th>Pin Status</th>
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
                                    <td><?php echo $value['pin']; ?></td>
                                    <td>
                                        <?php
                                        if($value['account_status']==1){
                                            echo 'Used';
                                        }else{
                                            echo 'Unused';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Are you sure to delete this pin?')" href="?del_id=<?php echo $value['id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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