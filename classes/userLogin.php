<?php
//class for user login
Class userLogin{

    //method for admin login
    public function loginUser($userEmail,$userPass){
        $userEmail=mysqli_real_escape_string(database::connect(),$userEmail);
        $userPass=mysqli_real_escape_string(database::connect(),$userPass);



        $query_select="SELECT * FROM tbl_user WHERE email='$userEmail' AND password='$userPass'";
        $result_select=database::connect()->query($query_select)->fetch_assoc();

        $id=$result_select['id'];
        if(empty($userEmail) || empty($userPass)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }elseif( isset($result_select['activation']) && $result_select['activation']==0){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your account is not active please active your account first.</p>";
            return $msg;
        }elseif($result_select['activation']==2){
            echo "<script> window.location ='confirm_account.php?id=$id'; </script>";
        }else{
            $query="SELECT * FROM tbl_user WHERE email='$userEmail' AND password='$userPass' AND activation='1'";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                $result=$result->fetch_assoc();


                session::set("userId",$result['id']);
                session::set("userLogin","true");
                session::set("userEmail",$result['email']);
                session::set("userName",$result['name']);

                echo "<script>window.location='index.php';</script>";
            }else{
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Email or password doesn't match.</p>";
                return $msg;
            }
        }

    }

}
?>
