<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
        <section class="content-header"><h1> Dashboard <small>Control panel</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Profile</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-2"></div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-8 table-responsive">
                        <?php
                        if (isset($_SESSION['userId'])){
                            $user_id=$_SESSION['userId'];
                        }
                        ?>
                        <?php
                        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update_btn'])){
                            $updateResult= $user->updateProfile($_POST,$_FILES,$user_id);
                        }
                        if(isset($updateResult)){
                            echo $updateResult;
                        }
                        $query="SELECT * FROM tbl_user WHERE id='$user_id'";
                        $result=database::connect()->query($query)->fetch_assoc();
                        ?>
                        <div class="text-center">
                            <img width="250px" height="200px" src="<?php echo $result['image']; ?>" class="img-circle">
                        </div>
                        <br>
                        <div class="box" style="padding: 15px">
                            <form action="" method="post" enctype="multipart/form-data">
                                <table class="table table-responsive table-striped">
                                    <thead>
                                    <tr>
                                        <td>Referral Link</td>
                                        <td><input type="text" class="form-control" value="<?php echo 'http://mybloodbd.com/soft/register.php?refer_id='.$result['id']; ?>"> </td>
                                    </tr>
                                    <tr>
                                        <td>User Id </td>
                                        <td><?php echo $result['id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email </td>
                                        <td>
                                            <?php echo $result['email']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>image</td>
                                        <td><input type="file" class="" name="image"> </td>
                                    </tr>
                                    <tr>
                                        <td>Name </td>
                                        <td>
                                            <?php echo $result['name']; ?>
                                            <input  class="form-control" type="text" value="<?php echo $result['name']; ?>" name="name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile </td>
                                        <td>
                                            <?php echo $result['mobile']; ?>
                                            <input  class="form-control" type="text" value="<?php echo $result['mobile']; ?>" name="mobile">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address </td>
                                        <td>
                                            <?php echo $result['address']; ?>
                                            <input  class="form-control" type="text" value="<?php echo $result['address']; ?>" name="address">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Blood Group </td>
                                        <td>
                                            <?php echo $result['blood']; ?>
                                            <input  class="form-control" type="text" value="<?php echo $result['blood']; ?>" name="blood">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Update Profile</td>
                                        <td>
                                            <input type="submit" class="btn btn-success" name="update_btn" value="Update Now">
                                        </td>
                                    </tr>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </form>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="box table-responsive" style="padding: 15px">
                        <h3 class="text-center text-info" style="font-weight: bold">Change Password Here</h3>

                       <?php
                           if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update_pass'])){
                               $changePass= $user->changePassword($_POST,$user_id);
                           }
                           if(isset($changePass)){
                               echo $changePass;
                           }
                       ?>
                        <form action="" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Old Password</td>
                                    <td>
                                        <input class="form-control" type="text" name="old_pass">
                                    </td>
                                </tr>
                                <tr>
                                    <td>New Password</td>
                                    <td>
                                        <input class="form-control" type="text" name="new_pass">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Retype New Password</td>
                                    <td>
                                        <input class="form-control" type="text" name="re_new_pass">
                                    </td>
                                </tr> <tr>
                                    <td></td>
                                    <td>
                                        <input class="btn btn-success" value="Change Now" type="submit" name="update_pass">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        <section>
<?php
require_once 'inc/footer.php';
?>