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
    case 'google_confirm':
        // Check if temporary Google user info exists
        if (!isset($_SESSION['google_temp_user_id']) || !isset($_SESSION['google_temp_email'])) {
            error_log("Google Confirm Error: Missing session data for confirmation.");
            echo '<script>alert("Phiên đăng nhập hết hạn. Vui lòng thử lại.");</script>';
            echo '<meta http-equiv="refresh" content="0; url=./index.php?action=dangnhap"/>';
            exit;
        }
        include './View/dangnhap_google_confirm.php';
        break;
    case 'google_confirm_action':
        // Process confirmation
        if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes' && 
            isset($_SESSION['google_temp_user_id']) && isset($_SESSION['google_temp_email'])) {
            
            // User confirmed, log them in
            $_SESSION['makh'] = $_SESSION['google_temp_user_id'];
            $_SESSION['tenkh'] = $_SESSION['google_temp_name'];
            $_SESSION['username'] = $_SESSION['google_temp_username'];
            
            // Clear temporary data
            unset($_SESSION['google_temp_user_id']);
            unset($_SESSION['google_temp_email']);
            unset($_SESSION['google_temp_name']);
            unset($_SESSION['google_temp_username']);
            
            // Redirect to main page
            echo '<meta http-equiv="refresh" content="0; url=./index.php?action=main"/>';
        } else {
            // User declined or session expired
            // Clear temporary data
            unset($_SESSION['google_temp_user_id']);
            unset($_SESSION['google_temp_email']);
            unset($_SESSION['google_temp_name']);
            unset($_SESSION['google_temp_username']);
            
            echo '<script>alert("Đăng nhập với Google đã bị hủy.");</script>';
            echo '<meta http-equiv="refresh" content="0; url=./index.php?action=dangnhap"/>';
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
