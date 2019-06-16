<?php

//class for admin
Class Confirm{
    //method for user Register
    public function referalPayment($id)
    {
        date_default_timezone_set('Asia/Dhaka');
        $register_id=$id;
        ///select setting table
        $select_setting="SELECT * FROM tbl_setting ";
        $setting_result=database::connect()->query($select_setting)->fetch_assoc();



        $select_refer_query="SELECT * FROM tbl_user WHERE id='$id' ";
        $result=database::connect()->query($select_refer_query)->fetch_assoc();
        $refer_id=$result['refer_id'];
        //set commission amount
        $select_four_row_query="SELECT * FROM tbl_user WHERE refer_id='$refer_id' ";
        $result_select_four=database::connect()->query($select_four_row_query);
        if($result_select_four->num_rows==$setting_result['num_refer']){
            $select_parent="SELECT * FROM tbl_user_amount WHERE user_id='$refer_id'";
            $select_payment=database::connect()->query($select_parent);
            if($select_payment->num_rows >0){
                $row=$select_payment->fetch_assoc();
                $old_payment=$row['payment'];
                $now_payment=$old_payment+$setting_result['special_amount'];

                $old_bonus_commission=$row['bonus_commission'];
                $now_bonus_commission=$old_bonus_commission+$setting_result['special_amount'];

                $t_old_bonus_commission=$row['t_bonus_commission'];
                $t_now_bonus_commission=$t_old_bonus_commission+$setting_result['special_amount'];

            }
            //insert balance for referral commission
            $set_commission_amount="UPDATE tbl_user_amount SET payment ='$now_payment',bonus_commission='$now_bonus_commission', t_bonus_commission='$t_now_bonus_commission' WHERE user_id='$refer_id'";
            database::connect()->query($set_commission_amount);
        }

        if($refer_id !='A'){
            $select_parent="SELECT * FROM tbl_user_amount WHERE user_id='$refer_id'";
            $select_payment=database::connect()->query($select_parent);
            if($select_payment->num_rows >0){

                $row=$select_payment->fetch_assoc();
                $old_payment=$row['payment'];
                $now_payment=$old_payment+$setting_result['direct_refer'];

                $old_referral_commission=$row['referral_commission'];
                $now_referral_commission=$old_referral_commission+$setting_result['direct_refer'];

                $t_old_referral_commission=$row['t_referral_commission'];
                $t_now_referral_commission=$t_old_referral_commission+$setting_result['direct_refer'];

            }
            //insert balance for referral commission
            $set_direct_refer_amount="UPDATE tbl_user_amount SET payment ='$now_payment',referral_commission='$now_referral_commission',t_referral_commission='$t_now_referral_commission' WHERE user_id='$refer_id'";
            database::connect()->query($set_direct_refer_amount);
        }

        $query="UPDATE tbl_user SET activation='1' WHERE id='$id'";
        database::connect()->query($query);

        $total_level_refer= '';
        for ($i=1;$i<=9;$i++){
            if(isset($_SESSION['id'])){
                $id=$_SESSION['id'];
            }
            $select_parent="SELECT * FROM tbl_user WHERE id='$id' AND activation='1'";
            $result=database::connect()->query($select_parent);
            if($result->num_rows>0){
                $row= $result->fetch_assoc();
                $_SESSION['id']=$row['refer_id'];
                $total_level_refer=$total_level_refer.','.$_SESSION['id'];
            }else{
                break;
            }
        }
        unset($_SESSION['id']);

        //insert balance for level commission
          $total_level_refer= trim($total_level_refer,'A,');
          $total_array=explode(',',$total_level_refer);
          foreach ($total_array as $key=>$value){
              if($refer_id !='A'){
                  $select_parent="SELECT * FROM tbl_user_amount WHERE user_id='$value'";
                  $select_payment=database::connect()->query($select_parent);
                  if($select_payment->num_rows >0){
                      $row=$select_payment->fetch_assoc();
                      $old_payment=$row['payment'];
                      $now_payment= $old_payment+$setting_result['level_commission'];

                      $old_level_commission=$row['level_commission'];
                      $now_level_commission= $old_level_commission+$setting_result['level_commission'];

                      $t_old_level_commission=$row['t_level_commission'];
                      $t_now_level_commission= $t_old_level_commission+$setting_result['level_commission'];

                  }
                  $set_level_amount="UPDATE tbl_user_amount SET payment ='$now_payment',level_commission='$now_level_commission',t_level_commission='$t_now_level_commission' WHERE user_id='$value'";
                  database::connect()->query($set_level_amount);
              }
          }

        //set balance for  global commission
        $select_all_row="SELECT * FROM tbl_user";
        $result_all_row=database::connect()->query($select_all_row);
        $all_row=($result_all_row->num_rows)-1;

        $select_all="SELECT * FROM tbl_user limit 0,$all_row";
        $result_all=database::connect()->query($select_all);
        $all_row2=$result_all->num_rows;
        if ($result_all->num_rows>0){
            foreach ($result_all as $val){
                $id=$val['id'];
                $select_parent="SELECT * FROM tbl_user_amount WHERE user_id='$id'";
                $select_payment=database::connect()->query($select_parent);
                if($select_payment->num_rows>0){
                    $row=$select_payment->fetch_assoc();
                    $old_payment=$row['payment'];
                    $now_payment= $old_payment+($setting_result['global_commission']/$all_row2);

                    $old_global_commission=$row['global_commission'];
                    $now_global_commission= $old_global_commission+($setting_result['global_commission']/$all_row2);

                    $t_old_global_commission=$row['t_global_commission'];
                    $t_now_global_commission= $t_old_global_commission+($setting_result['global_commission']/$all_row2);

                }
                $set_global_amount="UPDATE tbl_user_amount SET payment ='$now_payment',global_commission='$now_global_commission' ,t_global_commission='$t_now_global_commission' WHERE user_id ='$id'";
                database::connect()->query($set_global_amount);

            }
        }



        //set balance for  Special user commission

        $total_special_user=$setting_result['total_special_user'];
        $select_special_row="SELECT * FROM tbl_user WHERE user_type='special' AND id!='$register_id' limit 0,$total_special_user";
        $result_special_row=database::connect()->query($select_special_row);

        $total_sp_user=$result_special_row->num_rows;

        if ($result_special_row->num_rows>0){
            foreach ($result_special_row as $val){
                $id=$val['id'];
                $select_parent="SELECT * FROM tbl_user_amount WHERE user_id='$id'";
                $select_payment=database::connect()->query($select_parent);
                if($select_payment->num_rows>0){
                    $row=$select_payment->fetch_assoc();
                    $old_payment=$row['payment'];
                    $now_payment= $old_payment+($setting_result['special_user_commission']/$total_sp_user);

                    $old_special_commission=$row['special_commission'];
                    $now_special_commission= $old_special_commission+($setting_result['special_user_commission']/$total_sp_user);

                    $t_old_special_commission=$row['t_special_commission'];
                    $t_now_special_commission= $t_old_special_commission+($setting_result['special_user_commission']/$total_sp_user);

                }

                $set_special_amount="UPDATE tbl_user_amount SET payment ='$now_payment',special_commission='$now_special_commission',t_special_commission='$t_now_special_commission' WHERE user_id ='$id'";
                database::connect()->query($set_special_amount);
            }
        }


    }
    
}
?>
