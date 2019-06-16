<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Total user
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">Special</li>
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
                        Total Special User List</h2>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?php
                    if(isset($_GET['activation_id'])){
                        $activation_id=$_GET['activation_id'];

                        $query="UPDATE tbl_user SET activation='1' WHERE id='$activation_id'";
                        $result=database::connect()->query($query);
                        if($result){
                            echo "<p class='alert alert-success' ><strong>Success!</strong> Your user active success.</p>";
                        }
                    }
                    if(isset($_GET['del_id'])){
                        $del_id=$_GET['del_id'];

                        $query="DELETE  FROM tbl_user WHERE id='$del_id'";
                        $result=database::connect()->query($query);
                        if($result){
                            echo "<p class='alert alert-success' ><strong>Success!</strong> Your user delete success.</p>";
                        }
                    }
                    $query="SELECT * FROM tbl_user WHERE user_type='special'";
                    $result=database::connect()->query($query);
                    ?>
                    <table id="example1" class="table text-center table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Name</th>
                            <th>User Id</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Blood</th>
                            <th>Address</th>
                            <th>Police Address</th>
                            <th>District</th>
                            <th>ReferId</th>
                            <th>Join Date</th>
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
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['id']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $value['mobile']; ?></td>
                                    <td><?php echo $value['blood']; ?></td>
                                    <td><?php echo $value['address']; ?></td>
                                    <td><?php echo $value['police_station']; ?></td>
                                    <td><?php echo $value['district']; ?></td>
                                    <td><?php echo $value['refer_id']; ?></td>
                                    <td><?php echo date('d M Y,h:i:s',strtotime($value['join_date'])); ?></td>
                                    <td>
                                        <a onclick="return confirm('Are you sure to active this user?')" href="?activation_id=<?php echo  $value['id']; ?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-up"></i></a>
                                        <a onclick="return confirm('Are you sure to delete this user?')" href="?del_id=<?php echo $value['id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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