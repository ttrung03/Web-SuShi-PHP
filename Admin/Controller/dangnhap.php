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
            $pass = $_POST['txtpassword'];

            // controller yêu cầu model kiểm tra user và pass đúng không

            $ur = new dangnhap();
            $test = $ur->loginAdmin($user, md5($pass));
            // $test[makh=>16, tenkh=>..., username=...]
            if ($test) {
                $_SESSION['admin'] = $test['user'];
                echo '<script> alert("Đăng nhập thành công") </script>';
                echo '<meta http-equiv="refresh" content="0; url=./index.php?action=hanghoa"/>';
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
        echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=hanghoa"/>';
        break;

    case 'changepass':
        include './View/changepass.php';
        break;
    case 'changepass_action':
        if (isset($_POST['txtpassold']) && isset($_POST['txtpassnew'])) {

            $user = $_SESSION['admin'];
            $passold = ($_POST['txtpassold']);
            $passnew = md5(($_POST['txtpassnew']));

            $dn = new dangnhap();
            $check = $dn->LoginAdmin($user, $passold);
            if ($check !== false) {
                $checkchangepass = $dn->UpdatePass($user, $passnew);
                if ($checkchangepass !== false) {
                    echo '<script>alert("Đổi mật khẩu thành công")</script>';
                    include './View/hanghoa.php';
                } else {
                    echo '<script>alert("Đổi mật khẩu thất bại")</script>';
                    include './View/changepass.php';
                }
            } else {
                echo '<script>alert("Mật khẩu cũ không chính xác !! Vui lòng thử lại.")</script>';
                include './View/changepass.php';
            }
        }
        break;
}
