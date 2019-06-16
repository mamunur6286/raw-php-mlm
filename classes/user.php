<?php
//class for admin
    require_once 'confirm_with_move_amount.php';
Class user{
    //method for user Register
    public function register($post,$file){
        date_default_timezone_set('Asia/Dhaka');

        $permission=array("jpg","jpeg","png","gip","rar");
            $imageName=$file['image']['name'];
            $imageSize=$file['image']['size'];
            $imagePath=$file['image']['tmp_name'];
            $div_name=explode('.',"$imageName");
            $ext=strtolower(end($div_name));
            $unique_name=substr(md5(time()),0,30).'.'.$ext;


        $name=mysqli_real_escape_string(database::connect(),$post['name']);
        $mobile=mysqli_real_escape_string(database::connect(),$post['mobile']);
        $blood=mysqli_real_escape_string(database::connect(),$post['blood']);
        $address=mysqli_real_escape_string(database::connect(),$post['address']);
        $police_station=mysqli_real_escape_string(database::connect(),$post['police_station']);
        $district=mysqli_real_escape_string(database::connect(),$post['district']);
        $pin=mysqli_real_escape_string(database::connect(),$post['pin']);
        $refer_id=mysqli_real_escape_string(database::connect(),$post['refer_id']);
        $email=mysqli_real_escape_string(database::connect(),$post['email']);
        $password=mysqli_real_escape_string(database::connect(),$post['password']);
        $re_password=mysqli_real_escape_string(database::connect(),$post['re_password']);

        $query = "SELECT * FROM tbl_user WHERE id=$refer_id";
        $result = database::connect()->query($query);

        if (is_object($result) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $refer_id = $row['id'];
        }else {
            $refer_id = 'invalid';
        }
        // select user table
        $refer_query="SELECT id FROM tbl_user ";
        $refer_result=database::connect()->query($refer_query);
        if ($refer_result->num_rows ==0){
            $refer_id= 'A';
        }

        $email_query="SELECT email FROM tbl_user WHERE email='$email'";
        $email_result=database::connect()->query($email_query);

        $general_query="SELECT pin FROM tbl_general_user WHERE pin='$pin' AND account_status='0'";
        $general_result=database::connect()->query($general_query);

        $special_query="SELECT pin FROM tbl_special_user WHERE pin='$pin' AND account_status='0'";
        $special_result=database::connect()->query($special_query);

        if(is_object($general_result) && $general_result->num_rows>0){
            $row=$general_result->fetch_assoc();
            $pin= $row['pin'];
            $pin_user='tbl_general_user';
            $user_type='general';
        }elseif(is_object($special_result) && $special_result->num_rows>0){
            $row=$special_result->fetch_assoc();
            $pin= $row['pin'];
            $pin_user='tbl_special_user';
            $user_type='special';
        }else{
            $pin ='invalid';
        }
       if(empty($imageName)||empty($name) || empty($mobile) || empty($blood) || empty($address) || empty($police_station) || empty($district) || empty($pin) || empty($refer_id) || empty($email) || empty($password) || empty($re_password)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }elseif(!isset($post['term'])){
           $msg= "<p class='alert alert-danger'><strong>Error!</strong> At first check agree option.</p>";
           return $msg;
       }elseif($password!=$re_password){
           $msg= "<p class='alert alert-danger'><strong>Error!</strong> Password and confirm password doesn't match.</p>";
           return $msg;
        }elseif(strlen($password)<6){
           $msg= "<p class='alert alert-danger'><strong>Error!</strong> Password must be less 6 character.</p>";
           return $msg;
        }elseif ($imageSize>972800){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>File size must be less than 1MB.</p>";
            return $msg;
        }elseif (in_array($ext,$permission)===false){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>Only :-".implode(', ',$permission)." file uploaded.</p>";
            return $msg;
        }elseif($pin=='invalid'){
           $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your pin is invalid.</p>";
           return $msg;
       }elseif($refer_id=='invalid'){
           $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your refer id is invalid.</p>";
           return $msg;
       }elseif ( is_object($email_result) && $email_result->num_rows>0){
           $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your email address is already used.</p>";
           return $msg;
        }else{
           //make unique name
           $upload = "img/".$unique_name;

          if($refer_id=='A'){
              $query="INSERT INTO tbl_user(id,name,image,mobile,blood,address,police_station,district,pin,refer_id,email,password,user_type,activation)
                                  VALUES('1000','$name','$upload','$mobile','$blood','$address','$police_station','$district','$pin','$refer_id','$email','$password','$user_type','1')";
          }else{
              $query="INSERT INTO tbl_user(name,image,mobile,blood,address,police_station,district,pin,refer_id,email,password,user_type,activation)
                                  VALUES('$name','$upload','$mobile','$blood','$address','$police_station','$district','$pin','$refer_id','$email','$password','$user_type','1')";
          }
          $result=database::connect()->query($query);

           //make unique name
           move_uploaded_file($imagePath, $upload);


           $sql = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password' AND refer_id='$refer_id' AND name='$name'";
           $register_result = database::connect()->query($sql)->fetch_assoc();
           date_default_timezone_set('Asia/Dhaka');
           $date=date('d',time());
           $user_id=$register_result['id'];
           $set_direct_refer_amount="INSERT INTO tbl_user_amount(user_id,payment,referral_commission,level_commission,bonus_commission,global_commission,special_commission,t_referral_commission,t_level_commission,t_bonus_commission,t_global_commission,t_special_commission,today_date)
                      VALUES('$user_id','0','0','0','0','0','0','0','0','0','0','0','$date')";
           database::connect()->query($set_direct_refer_amount);

           if($result){

              $query="UPDATE $pin_user SET account_status='1' WHERE pin='$pin'";
              database::connect()->query($query);

              $confirm= new Confirm();

              $confirm->referalPayment($register_result['id']);

               session::set("userId", $register_result['id']);
               session::set("userLogin", "true");
               session::set("userEmail", $register_result['email']);
               session::set("userName", $register_result['name']);
               echo "<script>window.location='index.php';</script>";

           }else{
               $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Your account do not create.</p>";
               return $msg;
           }
        }

    }

    public function updateProfile($post,$file,$userid)
    {
        date_default_timezone_set('Asia/Dhaka');

        $permission=array("jpg","jpeg","png","gip","rar");
        $imageName=$file['image']['name'];
        $imageSize=$file['image']['size'];
        $imagePath=$file['image']['tmp_name'];
        $div_name=explode('.',"$imageName");
        $ext=strtolower(end($div_name));
        $unique_name=substr(md5(time()),0,30).'.'.$ext;



        $name=mysqli_real_escape_string(database::connect(),$post['name']);
        $mobile=mysqli_real_escape_string(database::connect(),$post['mobile']);
        $blood=mysqli_real_escape_string(database::connect(),$post['blood']);
        $address=mysqli_real_escape_string(database::connect(),$post['address']);

        if(empty($name) || empty($mobile) || empty($blood) || empty($address)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }elseif ($imageSize>972800){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>File size must be less than 1MB.</p>";
            return $msg;
        }elseif ($imageName==true && in_array($ext,$permission)===false){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>Only :-".implode(', ',$permission)." file uploaded.</p>";
            return $msg;
        }else{
            if ($imageName==true){
                $upload='img/'.$unique_name;

                $unlink_query="SELECT image FROM tbl_user  WHERE id='$userid'";
                $unlink_result=database::connect()->query($unlink_query)->fetch_assoc();
                unlink($unlink_result['image']);

                $query="UPDATE tbl_user SET name='$name',image='$upload',mobile='$mobile',blood='$blood',address='$address' WHERE id='$userid'";
                $result=database::connect()->query($query);
                //upload file
                move_uploaded_file($imagePath, $upload);
            }else{
                $query="UPDATE tbl_user SET name='$name',mobile='$mobile',blood='$blood',address='$address' WHERE id='$userid'";
                $result=database::connect()->query($query);
            }

            if ($result){
                $msg= "<p class='alert alert-success' ><strong>Success!</strong> Your account update success.</p>";
                return $msg;
            }else{
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Your account don't update.</p>";
                return $msg;
            }
        }

    }
    public function changePassword($post,$userid)
    {
        $old_pass=mysqli_real_escape_string(database::connect(),$post['old_pass']);
        $new_pass=mysqli_real_escape_string(database::connect(),$post['new_pass']);
        $re_new_pass=mysqli_real_escape_string(database::connect(),$post['re_new_pass']);

        $sql = "SELECT * FROM tbl_user WHERE id='$userid' AND password='$old_pass'";
        $check_pass = database::connect()->query($sql);
        if(empty($old_pass) || empty($new_pass) || empty($re_new_pass)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }elseif ($new_pass != $re_new_pass){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your password and confirmation password doesn't match.</p>";
            return $msg;
        }elseif ($check_pass->num_rows==0){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your old password doesn't match.</p>";
            return $msg;
        }else{
            $query="UPDATE tbl_user SET password='$new_pass' WHERE id='$userid'";
            $result=database::connect()->query($query);
            if ($result){
                $msg= "<p class='alert alert-success' ><strong>Success!</strong> Your account update success.</p>";
                return $msg;
            }else{
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Your account don't update.</p>";
                return $msg;
            }
        }

    }

}
?>
