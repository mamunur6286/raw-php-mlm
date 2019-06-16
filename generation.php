<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <style>
        table tr td{
            text-align: center;
        }
        .tree{
            width: 100px;
            margin: 0 auto;
            height: 100px;
            border-radius: 113px;
            font-size: 10px;
        }
        .tree p{
            margin-top: -2px;
            color: #0d6aad;
        }
        .tree-img{
            width: 60px;
            height: 50px;
            margin-top: 5px;
        }
    </style>
    <!-- Right side Threme color setting -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Team View
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Team View</a></li>
                    <li class="active">Generation</li>
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
                                    ?> All Generation Referral Users Here</h2>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                if (isset($_SESSION['userId']) && isset($_SESSION['userEmail'])){
                                    $userId=$_SESSION['userId'];
                                    $userEmail=$_SESSION['userEmail'];
                                    $userName=$_SESSION['userName'];
                                    $query="SELECT * FROM tbl_user WHERE id='$userId' ";
                                    $result=database::connect()->query($query)->fetch_assoc();
                                }
                                ?>
                                <div class="table-responsive">
                                        <table class="table text-center">
                                            <tr style="">
                                                <td style="font-size: 20px; color: red ;">LEVEL 1</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div  class="bg-gray text-center tree">
                                                        <a href="referral_profile.php?referral_id=<?php echo $userId; ?>"><img src="<?php echo $result['image'] ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                        <p><?php echo $userName ?></p>
                                                        <p><?php echo $userId ?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                    $query="SELECT * FROM tbl_user WHERE refer_id='$userId' ";
                                                    $result=database::connect()->query($query);
                                                    foreach ($result as $value){
                                                ?>
                                                <td>
                                                        <p style="font-size: 20px; color: red ;">LEVEL 2</p>
                                                    <div class="bg-gray text-center tree">
                                                        <a href="referral_profile.php?referral_id=<?php echo $value['id']; ?>"><img src="<?php echo $value['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                        <p><?php echo $value['name']; ?></p>
                                                        <p><?php echo $value['id']; ?></p>
                                                    </div>
                                                    <table  class="table text-center">
                                                        <tr>
                                                        <?php
                                                            $user_id1=$value['id'];
                                                            $query1="SELECT * FROM tbl_user WHERE refer_id='$user_id1' ";
                                                            $result1=database::connect()->query($query1);
                                                            foreach ($result1 as $value1) {
                                                                ?>
                                                                <td>
                                                                    <p style="font-size: 20px; color: red ;">LEVEL 3</p>
                                                                    <div class="bg-gray text-center tree">
                                                                        <a href="referral_profile.php?referral_id=<?php echo $value1['id']; ?>"><img src="<?php echo $value1['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                        <p><?php echo $value1['name'] ?></p>
                                                                        <p><?php echo $value1['id']; ?></p>
                                                                    </div>
                                                                    <table  class="table text-center">
                                                                        <tr>
                                                                            <?php
                                                                            $user_id2=$value1['id'];
                                                                            $query2="SELECT * FROM tbl_user WHERE refer_id='$user_id2' ";
                                                                            $result2=database::connect()->query($query2);
                                                                            foreach ($result2 as $value2) {
                                                                                ?>
                                                                                <td>
                                                                                    <p style="font-size: 20px; color: red ;">LEVEL 4</p>
                                                                                    <div class="bg-gray text-center tree">
                                                                                        <a href="referral_profile.php?referral_id=<?php echo $value2['id']; ?>"><img src="<?php echo $value2['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                                        <p><?php echo $value2['name']; ?></p>
                                                                                        <p><?php echo $value2['id']; ?></p>
                                                                                    </div>
                                                                                    <table  class="table text-center">
                                                                                        <tr>
                                                                                            <?php
                                                                                            $user_id3=$value2['id'];
                                                                                            $query3="SELECT * FROM tbl_user WHERE refer_id='$user_id3' ";
                                                                                            $result3=database::connect()->query($query3);
                                                                                            foreach ($result3 as $value3) {
                                                                                                ?>
                                                                                                <td>
                                                                                                    <p style="font-size: 20px; color: red ;">LEVEL 5</p>
                                                                                                    <div class="bg-gray text-center tree">
                                                                                                        <a href="referral_profile.php?referral_id=<?php echo $value3['id']; ?>"><img src="<?php echo $value3['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                                                        <p><?php echo $value3['name']; ?></p>
                                                                                                        <p><?php echo $value3['id']; ?></p>
                                                                                                    </div>
                                                                                                    <table  class="table text-center">
                                                                                                        <tr>
                                                                                                            <?php
                                                                                                            $user_id4=$value3['id'];
                                                                                                            $query4="SELECT * FROM tbl_user WHERE refer_id='$user_id4' ";
                                                                                                            $result4=database::connect()->query($query4);
                                                                                                            foreach ($result4 as $value4) {
                                                                                                                ?>
                                                                                                                <td>
                                                                                                                    <p style="font-size: 20px; color: red ;">LEVEL 6</p>
                                                                                                                    <div class="bg-gray text-center tree">
                                                                                                                        <a href="referral_profile.php?referral_id=<?php echo $value4['id']; ?>"><img src="<?php echo $value4['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                                                                        <p><?php echo $value4['name']; ?></p>
                                                                                                                        <p><?php echo $value4['id']; ?></p>
                                                                                                                    </div>
                                                                                                                    <table  class="table text-center">
                                                                                                                        <tr>
                                                                                                                            <?php
                                                                                                                            $user_id5=$value4['id'];
                                                                                                                            $query5="SELECT * FROM tbl_user WHERE refer_id='$user_id5' ";
                                                                                                                            $result5=database::connect()->query($query5);
                                                                                                                            foreach ($result5 as $value5) {
                                                                                                                                ?>
                                                                                                                                <td>
                                                                                                                                    <p style="font-size: 20px; color: red ;">LEVEL 7</p>
                                                                                                                                    <div class="bg-gray text-center tree">
                                                                                                                                        <a href="referral_profile.php?referral_id=<?php echo $value5['id']; ?>"><img src="<?php echo $value5['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                                                                                        <p><?php echo $value5['name']; ?></p>
                                                                                                                                        <p><?php echo $value5['id']; ?></p>
                                                                                                                                    </div>
                                                                                                                                    <table  class="table text-center">
                                                                                                                                        <tr>
                                                                                                                                            <?php
                                                                                                                                            $user_id6=$value5['id'];
                                                                                                                                            $query6="SELECT * FROM tbl_user WHERE refer_id='$user_id6' ";
                                                                                                                                            $result6=database::connect()->query($query6);
                                                                                                                                            foreach ($result6 as $value6) {
                                                                                                                                                ?>
                                                                                                                                                <td>
                                                                                                                                                    <p style="font-size: 20px; color: red ;">LEVEL 8</p>
                                                                                                                                                    <div class="bg-gray text-center tree">
                                                                                                                                                        <a href="referral_profile.php?referral_id=<?php echo $value6['id']; ?>"><img src="<?php echo $value6['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                                                                                                        <p><?php echo $value6['name']; ?></p>
                                                                                                                                                        <p><?php echo $value6['id']; ?></p>
                                                                                                                                                    </div>
                                                                                                                                                    <table  class="table text-center">
                                                                                                                                                        <tr>
                                                                                                                                                            <?php
                                                                                                                                                            $user_id7=$value6['id'];
                                                                                                                                                            $query7="SELECT * FROM tbl_user WHERE refer_id='$user_id7' ";
                                                                                                                                                            $result7=database::connect()->query($query7);
                                                                                                                                                            foreach ($result7 as $value7) {
                                                                                                                                                                ?>
                                                                                                                                                                <td>
                                                                                                                                                                    <p style="font-size: 20px; color: red ;">LEVEL 9</p>
                                                                                                                                                                    <div class="bg-gray text-center tree">
                                                                                                                                                                        <a href="referral_profile.php?referral_id=<?php echo $value7['id']; ?>"><img src="<?php echo $value7['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                                                                                                                        <p><?php echo $value7['name']; ?></p>
                                                                                                                                                                        <p><?php echo $value7['id']; ?></p>
                                                                                                                                                                    </div>
                                                                                                                                                                    <table  class="table text-center">
                                                                                                                                                                        <tr>
                                                                                                                                                                            <?php
                                                                                                                                                                            $user_id8=$value7['id'];
                                                                                                                                                                            $query8="SELECT * FROM tbl_user WHERE refer_id='$user_id8' ";
                                                                                                                                                                            $result8=database::connect()->query($query8);
                                                                                                                                                                            foreach ($result8 as $value8) {
                                                                                                                                                                                ?>
                                                                                                                                                                                <td>
                                                                                                                                                                                    <p style="font-size: 20px; color: red ;">LEVEL 10 </p>
                                                                                                                                                                                    <div class="bg-gray text-center tree">
                                                                                                                                                                                        <a href="referral_profile.php?referral_id=<?php echo $value8['id']; ?>"><img src="<?php echo $value8['image']; ?>" class="img-circle tree-img" alt="User Image" /></a>
                                                                                                                                                                                        <p><?php echo $value8['name']; ?></p>
                                                                                                                                                                                        <p><?php echo $value8['id']; ?></p>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </td>
                                                                                                                                                                                <?php
                                                                                                                                                                            }
                                                                                                                                                                            ?>
                                                                                                                                                                        </tr>
                                                                                                                                                                    </table>
                                                                                                                                                                </td>
                                                                                                                                                                <?php
                                                                                                                                                            }
                                                                                                                                                            ?>
                                                                                                                                                        </tr>
                                                                                                                                                    </table>
                                                                                                                                                </td>
                                                                                                                                                <?php
                                                                                                                                            }
                                                                                                                                            ?>
                                                                                                                                        </tr>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                                <?php
                                                                                                                            }
                                                                                                                            ?>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php
                                                    }
                                                ?>
                                            </tr>
                                        </table>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->



<?php
require_once 'inc/footer.php';
?>