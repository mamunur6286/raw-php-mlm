<?php
//class for admin
require_once 'class.phpmailer.php';


Class transaction{
    //method for user Register
    public function withdrawAdmin($post,$user_id){
        date_default_timezone_set('Asia/Dhaka');

        $mobile=mysqli_real_escape_string(database::connect(),$post['mobile']);
        $amount=mysqli_real_escape_string(database::connect(),$post['amount']);
        $password=mysqli_real_escape_string(database::connect(),$post['password']);

        $check_pass_query = "SELECT * FROM tbl_user WHERE id='$user_id' AND password='$password'";
        $check_pass_result = database::connect()->query($check_pass_query);

        $check_amount_query = "SELECT payment FROM tbl_user_amount WHERE user_id=$user_id ";
        $check_amount_result = database::connect()->query($check_amount_query)->fetch_assoc();

        if(empty($user_id) || empty($mobile) || empty($amount) || empty($password)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }elseif($check_pass_result->num_rows !=1){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your password is incorrect.</p>";
            return $msg;
        }elseif ($amount<50){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your transaction balance is minimum 200 tk.</p>";
            return $msg;
        }elseif ($check_amount_result['payment']<$amount){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Insufficient balance.</p>";
            return $msg;
        }else{
            $set_withdraw_admin=" INSERT INTO tbl_transaction_admin(user_id,amount,confirm)VALUES('$user_id','$amount','0')";
            $result=database::connect()->query($set_withdraw_admin);

            $now_amount=$check_amount_result['payment']-$amount;
            $query="UPDATE tbl_user_amount SET payment='$now_amount' WHERE user_id='$user_id'";
            database::connect()->query($query);

            $service=10;
            $service_charge= ($service*$amount)/100;
            if($result){
                $msg= "<p class='alert alert-success' ><strong>Success!</strong> Your $amount tk transaction request send success.Service charge $service_charge tk.</p>";
                return $msg;
            }else{
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Your transaction don't success.</p>";
                return $msg;
            }
        }

    }
    public function sendToUser($post,$user_id){
        date_default_timezone_set('Asia/Dhaka');

        $receive_id=mysqli_real_escape_string(database::connect(),$post['receive_id']);
        $amount=mysqli_real_escape_string(database::connect(),$post['amount']);
        $password=mysqli_real_escape_string(database::connect(),$post['password']);

        $check_pass_query = "SELECT * FROM tbl_user WHERE id='$user_id' AND password='$password'";
        $check_pass = database::connect()->query($check_pass_query);

        $check_amount_query = "SELECT payment FROM tbl_user_amount WHERE user_id=$user_id ";
        $check_amount_result = database::connect()->query($check_amount_query)->fetch_assoc();

        if(empty($user_id) || empty($receive_id) || empty($amount) || empty($password)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }elseif($check_pass->num_rows !=1){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your password is incorrect.</p>";
            return $msg;
        }elseif ($amount<50){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your transaction balance is minimum 200 tk.</p>";
            return $msg;
        }elseif ($check_amount_result['payment']<$amount){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Insufficient balance.</p>";
            return $msg;
        }else{
            ///all setting data
            $select_setting="SELECT * FROM tbl_setting ";
            $select_setting_result=database::connect()->query($select_setting)->fetch_assoc();

            $service=$select_setting_result['send_user_commission'];
            $amount_without_service=$amount-$service;

            $set_withdraw_user=" INSERT INTO tbl_transaction_user(user_id,receive_id,amount)VALUES('$user_id','$receive_id','$amount_without_service')";
            $result=database::connect()->query($set_withdraw_user);
            if($result){
                //update sender payment
                $now_payment= $check_amount_result['payment']-$amount;
                $query="UPDATE tbl_user_amount SET payment='$now_payment' WHERE user_id='$user_id'";
                database::connect()->query($query);

                //update Receiver payment
                $select_old_balance = "SELECT payment FROM tbl_user_amount WHERE user_id=$receive_id ";
                $result_old_balance = database::connect()->query($select_old_balance)->fetch_assoc();

                $now_payment_receiver= $result_old_balance['payment']+$amount_without_service;
                $query="UPDATE tbl_user_amount SET payment='$now_payment_receiver' WHERE user_id='$receive_id'";
                database::connect()->query($query);

                //update admin commission payment
                $set_withdraw_user=" INSERT INTO tbl_admin_commission(amount,commission_type)VALUES('$service','Send User')";
                database::connect()->query($set_withdraw_user);


                //update total amount admin
                $select_old_balance_admin = "SELECT amount FROM tbl_admin ";
                $result_old_balance_admin = database::connect()->query($select_old_balance_admin)->fetch_assoc();

                $now_payment_admin= $result_old_balance_admin['amount']+$service;
                $query="UPDATE tbl_admin SET amount='$now_payment_admin'";
                database::connect()->query($query);


                $msg= "<p class='alert alert-success' ><strong>Success!</strong> Your $amount tk send success.Receiver id is $receive_id.Service charge $service tk.</p>";
                return $msg;
            }else{
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Your transaction don't success.</p>";
                return $msg;
            }
        }

    }

    public function updateUserBalance($id)
    {
        date_default_timezone_set('Asia/Dhaka');

        $query_for_select_admin_tran="SELECT * FROM tbl_transaction_admin WHERE id='$id'";
        $result_admin_tran=database::connect()->query($query_for_select_admin_tran)->fetch_assoc();
        $amount=$result_admin_tran['amount'];
        $user_id=$result_admin_tran['user_id'];
        ///all setting data
        $select_setting="SELECT * FROM tbl_setting ";
        $select_setting_result=database::connect()->query($select_setting)->fetch_assoc();

        $percentage=$select_setting_result['withdraw_commission'];
        $admin_income=($amount*$percentage)/100;
        $user_withdraw=$amount-$admin_income;

        //update admin commission payment
        $set_withdraw_user=" INSERT INTO tbl_admin_commission(amount,commission_type)VALUES('$admin_income','withdraw')";
        database::connect()->query($set_withdraw_user);

        $update_history_amount="UPDATE tbl_transaction_admin SET amount='$user_withdraw' WHERE id='$id'";
        database::connect()->query($update_history_amount);

        //update total amount admin
        $select_old_balance_admin = "SELECT amount FROM tbl_admin ";
        $result_old_balance_admin = database::connect()->query($select_old_balance_admin)->fetch_assoc();

        $now_payment_admin= $result_old_balance_admin['amount']+$admin_income;
        $query="UPDATE tbl_admin SET amount='$now_payment_admin'";
        database::connect()->query($query);

        $update_history_amount="UPDATE tbl_transaction_admin SET confirm='1' WHERE user_id='$user_id'";
        database::connect()->query($update_history_amount);
        echo "<script>window.location='success_transactions.php';</script>";

    }


}
?>
