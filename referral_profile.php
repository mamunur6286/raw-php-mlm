<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <?php
        if (isset($_GET['referral_id']) && !empty($_GET['referral_id'])){
            $referral_id=$_GET['referral_id'];
        }else{
            echo "<script>window.location='404.php';</script>";
        }
    ?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
        <section class="content-header"><h1>Team View</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Generation Referral</li>
                <li class="active">Referral Profile</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-2"></div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-8 table-responsive">
                        <br>
                        <?php
                            $query="SELECT * FROM tbl_user WHERE id='$referral_id'";
                            $result=database::connect()->query($query)->fetch_assoc();
                        ?>
                        <div class="text-center">
                            <img class="img-circle" src="<?php echo $result['image']; ?>" width="200px" height="200px">
                        </div>
                        <br>
                        <div class="box" style="padding: 15px">
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <td>Id </td>
                                    <td><?php echo $result['id'] ?></td>
                                </tr>
                                <tr>
                                    <td>Name </td>
                                    <td><?php echo $result['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><?php echo $result['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td><?php echo $result['mobile'] ?></td>
                                </tr>
                                <tr>
                                    <td>Blood Group</td>
                                    <td><?php echo $result['blood'] ?></td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-md-2"></div>
            </div>
            <section>
<?php
require_once 'inc/footer.php';
?>