<?php
require_once 'inc/header.php';
require_once 'inc/sideber.php';
?>
    <!-- Right side Threme color setting -->
    <div class="content-wrapper">
    <section class="content-header"><h1> Blood Manage</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Blood</li>
            <li class="active">Donate Blood</li>
        </ol></section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel-heading">
                <h3 class="text-info text-center" style="font-weight: bold">Send Amount Here</h3>
            </div>
            <br>
            <div class="box">
                <div class="box-body">
                    <?php
                    date_default_timezone_set('Asia/Dhaka');
                    if (isset($_SESSION['userId'])){
                        $user_id=$_SESSION['userId'];
                        $user_name=$_SESSION['userName'];
                    }

                    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['donate_btn'])){
                        $donate_to=$_POST['donate_to'];
                        $quantity=$_POST['quantity'];
                        $mobile=$_POST['mobile'];
                        $donate_date=$_POST['donate_date'];

                        if(empty($donate_to) || empty($quantity)|| empty($mobile)|| empty($donate_date)){
                            echo "<p class='alert alert-danger'><strong>Error! </strong>Field must not be empty.</p>";
                        }elseif($quantity<1){
                            echo "<p class='alert alert-danger'><strong>Error! </strong>Minimum quantity 1.</p>";
                        }else{
                            $query_insert="INSERT INTO tbl_blood_donate(user_id,donate_by,quantity,mobile,donate_to,donate_date)VALUES ('$user_id','$user_name','$quantity','$mobile','$donate_to','$donate_date')";
                            $result=database::connect()->query($query_insert);
                            if($result){
                                echo "<p class='alert alert-success'><strong>Success! </strong>Your blood donate success.</p>";
                            }else{
                                echo "<p class='alert alert-danger'><strong>Error! </strong>Your blood not donate.</p>";
                            }
                        }
                    }
                    if(isset($tran_result)){
                        echo $tran_result;
                    }
                    ?>
                    <form class=""action=""method="post">
                        <div class="form-group">
                            <label>Donate To</label>
                            <input type="text" name="donate_to" class="form-control" placeholder="Donate to">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="number" name="mobile" class="form-control" placeholder="Mobile">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input id="datepicker"  placeholder="yyyy-mm-dd" type="date" name="donate_date" class="form-control" placeholder="Your donate date">
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="submit" name="donate_btn" class="btn btn-success btn-block" value="Donate Now">
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