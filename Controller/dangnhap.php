<?php
$act = 'dangnhap';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'dangnhap':
        include './View/dangnhap.php';
        break;
    case 'dangnhap_action':
        // gửi username và password qua
        if (isset($_POST['txtusername']) && isset($_POST['txtpassword'])) {
            $user = $_POST['txtusername'];
            $pass = md5($_POST['txtpassword']);

            // controller yêu cầu model kiểm tra user và pass đúng không

            $ur = new user();
            $test = $ur->login($user, $pass);
            // $test[makh=>16, tenkh=>..., username=...]
            if ($test) {
                $_SESSION['makh'] = $test['makh'];
                $_SESSION['tenkh'] = $test['tenkh'];
                $_SESSION['username'] = $test['username'];
                echo '<meta http-equiv="refresh" content="0; url=./index.php?action=main"/>';
            } else {
                echo '<script> alert("Tên đăng nhập hoặc mật khẩu sai") </script>';
                include "./View/dangnhap.php";
            }
        }
        break;
    case 'logout':
        if (isset($_SESSION['makh'])) {
            unset($_SESSION['makh']);
            unset($_SESSION['tenkh']);
            unset($_SESSION['username']);
            unset($_SESSION['cart']);
        }
        echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=main"/>';
        break;
}
