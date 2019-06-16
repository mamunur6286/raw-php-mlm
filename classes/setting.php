<?php
//class for admin
require_once 'class.phpmailer.php';


Class setting{
    //method for user Register
    public function updateSetting($post){
        $withdraw_commission=mysqli_real_escape_string(database::connect(),$post['withdraw_commission']);
        $send_user_commission=mysqli_real_escape_string(database::connect(),$post['send_user_commission']);
        $general_user_amount=mysqli_real_escape_string(database::connect(),$post['general_user_amount']);
        $special_user_amount=mysqli_real_escape_string(database::connect(),$post['special_user_amount']);
        $special_user_commission=mysqli_real_escape_string(database::connect(),$post['special_user_commission']);
        $total_special_user=mysqli_real_escape_string(database::connect(),$post['total_special_user']);
        $direct_refer=mysqli_real_escape_string(database::connect(),$post['direct_refer']);
        $global_commission=mysqli_real_escape_string(database::connect(),$post['global_commission']);
        $level_commission=mysqli_real_escape_string(database::connect(),$post['level_commission']);
        $special_amount=mysqli_real_escape_string(database::connect(),$post['special_amount']);
        $num_refer=mysqli_real_escape_string(database::connect(),$post['num_refer']);


        if(empty($withdraw_commission) || empty($send_user_commission) || empty($general_user_amount) || empty($special_user_amount) || empty($num_refer) || empty($special_user_commission) || empty($total_special_user) || empty($direct_refer) || empty($global_commission) || empty($level_commission) || empty($special_amount)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }else{

                $update_query="UPDATE tbl_setting SET 
                                withdraw_commission='$withdraw_commission',
                                send_user_commission='$send_user_commission',
                                general_user_amount='$general_user_amount',
                                special_user_amount='$special_user_amount',
                                special_user_commission='$special_user_commission',
                                total_special_user='$total_special_user',
                                direct_refer='$direct_refer',
                                global_commission='$global_commission',
                                level_commission='$level_commission',
                                special_amount='$special_amount',
                                num_refer='$num_refer'
                            ";
                $result=database::connect()->query($update_query);
                if($result){
                    $msg= "<p class='alert alert-success' ><strong>Success!</strong> Your account update success.</p>";
                    return $msg;
                }
        }

    }

}
?>
