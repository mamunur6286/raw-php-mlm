<?php

Class admin{
    //method for user Register
    public function updateProfile($post,$file,$userid)
    {

        $permission=array("jpg","jpeg","png","gip","rar");
        $imageName=$file['image']['name'];
        $imageSize=$file['image']['size'];
        $imagePath=$file['image']['tmp_name'];
        $div_name=explode('.',"$imageName");
        $ext=strtolower(end($div_name));
        $unique_name=substr(md5(time()),0,30).'.'.$ext;


        $name=mysqli_real_escape_string(database::connect(),$post['name']);
        $email=mysqli_real_escape_string(database::connect(),$post['email']);

        if(empty($name) || empty($email)){
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

                $unlink_query="SELECT image FROM tbl_admin  WHERE id='$userid'";
                $unlink_result=database::connect()->query($unlink_query)->fetch_assoc();
                unlink($unlink_result['image']);


                $query="UPDATE tbl_admin SET name='$name',email='$email',image='$upload' WHERE id='$userid'";
                $result=database::connect()->query($query);
                //upload file
                move_uploaded_file($imagePath, $upload);

            }else{
                $query="UPDATE tbl_admin SET name='$name',email='$email' WHERE id='$userid'";
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

        $sql = "SELECT * FROM tbl_admin WHERE id='$userid' AND password='$old_pass'";
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
            $query="UPDATE tbl_admin SET password='$new_pass' WHERE id='$userid'";
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
