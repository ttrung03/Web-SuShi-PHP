<?php

$act = 'forgetps';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'forgetps':
        include './View/forgetpassword.php';
        break;
    case 'forget_action':
        if (isset($_POST['submit_email'])) {
            $email = $_POST['email'];
            $usr = new User();
            $kqemail = $usr->getEmail($email);

            if ($kqemail != false) {
                $code = random_int(1000, 9999);

                $_SESSION['codeOTP'] = $code;
                $_SESSION['email'] = $email;
                // gửi mail

                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP();

                $mail->SMTPDebug = 0;

                // ENABLE SMTIP authentication
                $mail->SMTPAuth = true;

                $mail->Username = "vothanhtrung9379@gmail.com"; //
                // GMAIL password
                // $mail->Password = "php22023ngoc";
                $mail->Password = "erwi wuuv qhal frnh"; //Phplytest20@php
                $mail->SMTPSecure = "tls";
                // sets GMAIL as the SMTP server
                $mail->Host = "smtp.gmail.com";
                // set the SMTP port for the GMAIL server
                $mail->Port = '587';
                $mail->From = 'vothanhtrung9379@gmail.com';
                $mail->FromName = 'The SuShi';

                // $getemail là địa chỉ mail mà người nhập vào địa chỉ của họ đã đăng ký trong
                $mail->AddAddress($email, 'reciever_name');
                $mail->Subject = 'Reset Password';
                $mail->IsHTML(true);
                $mail->Body = 'Mã Code khôi phục tài khoản của bạn là: ' . $code . '';

                if ($mail->Send()) {
                    echo '<script> alert("Check Your Email and Click on the link sent to your email");</script>';
                    include "./View/OTP.php";
                } else {
                    // echo !extension_loaded('openssl') ? "Not Available" : "Available <br>";
                    echo "Mail Error =>" . $mail->ErrorInfo;
                    include "./View/forgetpassword.php";
                }
            } else {
                echo '<script> alert("Địa chỉ mail ko tồn tại");</script>';
                include "./View/forgetpassword.php";
            }
        }
        break;
    case 'checkotp':
        if (isset($_POST["code1"])) {
            $codeCheck = ($_POST["code1"] * 1000) + ($_POST["code2"] * 100) + ($_POST["code3"] * 10) + $_POST["code4"];

            if ($codeCheck == $_SESSION['codeOTP']) {
                echo '<script> alert("Xác minh mã OTP thành công !!");</script>';
                include "./View/resetps.php";
            } else {
                echo '<script> alert("Mã OTP không chính xác !!");</script>';
                include "./View/OTP.php";
            }
        }

        break;
    case 'resetps':
        if (isset($_SESSION['email']) && isset($_POST['password'])) {

            $passnew = md5($_POST['password']);
            $usr = new user();
            $emailold = $_SESSION['email'];
            $usr->updateEmail($emailold, $passnew);
            echo '<script> alert("Đổi mật khẩu thành công !!");</script>';
        }
        include "./View/dangnhap.php";
        break;
}
