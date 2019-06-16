<?php
//class for admin
Class createPin{
    //method for user Register
    public function specialPin($post){
        $pin_number=mysqli_real_escape_string(database::connect(),$post['special_pin']);

        if(empty($pin_number)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }else{
            for($i=1;$i<=$pin_number;$i++){
                $pin='BB'.rand(112,999).rand(10,99).rand(20,99).rand(10,99).rand(1,9);
                $query="INSERT INTO tbl_special_user(pin,account_status)VALUES('$pin','0')";
                $result=database::connect()->query($query);
            }
            if($result){
                $msg= "<p class='alert alert-success' ><strong>Success!</strong> Your $pin_number pin generate success.</p>";
                return $msg;
            }else{
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Your pin do not save.</p>";
                return $msg;
            }
        }

    }
    public function generalPin($post){
        $pin_number=mysqli_real_escape_string(database::connect(),$post['general_pin']);

        if(empty($pin_number)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
            return $msg;
        }else{
            for($i=1;$i<=$pin_number;$i++){
                $pin='BB'.rand(112,999).rand(10,99).rand(20,99).rand(10,99).rand(1,9);
                $query="INSERT INTO tbl_general_user(pin,account_status)VALUES('$pin','0')";
                $result=database::connect()->query($query);
            }
            if($result){
                $msg= "<p class='alert alert-success' ><strong>Success!</strong> Your $pin_number pin generate success.</p>";
                return $msg;
            }else{
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Your pin do not save.</p>";
                return $msg;
            }
        }

    }

}
?>
