<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Teem View
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Team View</a></li>
                <li class="active">Referral</li>
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
                                ?> All Direct Referral Users Here</h2>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php
                                if (isset($_SESSION['userId']) && isset($_SESSION['userEmail'])){
                                    $userId=$_SESSION['userId'];
                                    $userEmail=$_SESSION['userEmail'];

                                    $query="SELECT * FROM tbl_user WHERE refer_id='$userId'";
                                    $result=database::connect()->query($query);

                                }
                            ?>
                            <table id="example1" class="table text-center table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>User Id</th>
                                    <th>Email</th>
                                    <th>MObile</th>
                                    <th>Blood</th>
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
                                               <td><img src="<?php echo $value['image']; ?>" width="80px" class="img-circle"></td>
                                               <td><?php echo $value['id']; ?></td>
                                               <td><?php echo $value['email']; ?></td>
                                               <td><?php echo $value['mobile']; ?></td>
                                               <td><?php echo $value['blood']; ?></td>
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