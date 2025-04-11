<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$act = 'dangky';
if(isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'dangky':
        include './View/dangky.php';
        break;
    case 'dangky_action':
        if(isset($_POST['txttenkh'])) {
            $tenkh = $_POST['txttenkh'];
            $diachi = $_POST['txtdiachi'];
            $sodt = $_POST['txtsodt'];
            $username = $_POST['txtusername'];
            $email = $_POST['txtemail'];
            $pass = $_POST['txtpass'];
            
           
            if (empty($tenkh) || empty($username) || empty($pass) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 echo '<script> alert("Vui lòng điền đầy đủ và đúng định dạng thông tin.");</script>';
                 include './View/dangky.php';
                 exit;
            }

            $crypt = md5($pass);
            $ur = new user();
            
            $result = $ur->InsetUser($tenkh, $username, $crypt, $email, $diachi, $sodt);
            
            if ($result !== 'false') {
                echo '<script> alert("Đăng Kí thành công. Vui lòng đăng nhập.");</script>';
               
                echo '<script>window.location.href="/Web-SuShi-PHP/User/index.php?action=dangnhap";</script>';
                exit;
            }
            else {
                
                echo '<script> alert("Đăng kí không thành công. Tên đăng nhập hoặc email có thể đã tồn tại.");</script>';
                include './View/dangky.php'; 
            }
        }
        break;
        
    case 'google_register':
       
        if (!isset($_SESSION['google_temp_email']) || !isset($_SESSION['google_temp_name'])) {
            error_log("Google Register Error: Missing google_temp_email or google_temp_name in session.");
             header('Location: /Web-SuShi-PHP/User/index.php?action=dangnhap'); // Redirect to login if session data is missing
             exit;
        }
        include './View/dangky_google.php'; 
        break;
    
    case 'google_register_action':
        error_log("google_register_action - SESSION: " . json_encode($_SESSION));
        error_log("google_register_action - POST: " . json_encode($_POST));
        
        
        if (!isset($_SESSION['google_temp_email'])) {
            error_log("google_register_action - Error: Missing google_temp_email in session.");
            echo '<script>alert("Phiên đăng ký đã hết hạn hoặc có lỗi. Vui lòng thử lại.");</script>';
            echo '<script>window.location.href="/Web-SuShi-PHP/User/index.php?action=dangnhap";</script>';
            exit;
        }

        
        $email = $_SESSION['google_temp_email'];
        
        
        if (isset($_POST['tenkh']) && isset($_POST['sodt']) && isset($_POST['diachi'])) {
            $tenkh = trim($_POST['tenkh']);
            $diachi = trim($_POST['diachi']);
            $sodt = trim($_POST['sodt']);
            
            if (empty($tenkh) || empty($sodt) || empty($diachi)) {
                 echo '<script>alert("Vui lòng điền đầy đủ thông tin.");</script>';
                 include './View/dangky_google.php'; 
            }
                    
            $ur = new user();
            
            $userId = $ur->addGoogleUser($tenkh, $email, $sodt, $diachi);
            
            if ($userId != false) {
                 error_log("Google user registration successful for email (".$email."). New/Existing User ID: " . $userId);
                 
                $_SESSION['makh'] = $userId;
                $_SESSION['tenkh'] = $tenkh;
                
                 $userData = $ur->getUserByEmail($email); 
                 $_SESSION['username'] = $userData ? $userData['username'] : explode('@', $email)[0]; // Set username in session
                
                
                unset($_SESSION['google_temp_email']);
                unset($_SESSION['google_temp_name']);
                
                echo '<script>alert("Tạo tài khoản và đăng nhập thành công!");</script>';
                echo '<script>window.location.href="/Web-SuShi-PHP/User/index.php?action=main";</script>';
                exit; 
            } else {
                error_log("Google user registration failed (addGoogleUser returned false) for email: " . $email);
                echo '<script>alert("Tạo tài khoản thất bại! Có lỗi xảy ra.");</script>';
                include './View/dangky_google.php';
            }
        } else {
            error_log("google_register_action - Error: Missing required POST data (tenkh, sodt, diachi).");
            echo '<script>alert("Vui lòng điền đầy đủ thông tin.");</script>';
            include './View/dangky_google.php'; 
            exit;
        }
        break;

    default:
        include './View/dangky.php'; 
        break;
}
