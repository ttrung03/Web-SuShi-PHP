<?php 
session_start();
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
            
            // Validate inputs (basic example)
            if (empty($tenkh) || empty($username) || empty($pass) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 echo '<script> alert("Vui lòng điền đầy đủ và đúng định dạng thông tin.");</script>';
                 include './View/dangky.php';
                 exit;
            }

            $crypt = md5($pass);
            $ur = new user();
            // InsetUser now returns new ID on success, or 'false' on failure/duplicate
            $result = $ur->InsetUser($tenkh, $username, $crypt, $email, $diachi, $sodt);
            
            if ($result !== 'false') {
                echo '<script> alert("Đăng Kí thành công. Vui lòng đăng nhập.");</script>';
                // Redirect to login page after successful registration
                echo '<script>window.location.href="/Web-SuShi-PHP/User/index.php?action=dangnhap";</script>';
                exit;
            }
            else {
                // Error message already logged in model
                echo '<script> alert("Đăng kí không thành công. Tên đăng nhập hoặc email có thể đã tồn tại.");</script>';
                include './View/dangky.php'; 
            }
        }
        break;
        
    case 'google_register':
        // Ensure temporary Google info exists in session
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
        
        // Check if the required temporary session data exists
        if (!isset($_SESSION['google_temp_email'])) {
            error_log("google_register_action - Error: Missing google_temp_email in session.");
            echo '<script>alert("Phiên đăng ký đã hết hạn hoặc có lỗi. Vui lòng thử lại.");</script>';
            echo '<script>window.location.href="/Web-SuShi-PHP/User/index.php?action=dangnhap";</script>';
            exit;
        }

        // Use the temporary session email for verification and processing
        $email = $_SESSION['google_temp_email'];
        
        // Basic validation of POST data
        if (isset($_POST['tenkh']) && isset($_POST['sodt']) && isset($_POST['diachi'])) {
            $tenkh = trim($_POST['tenkh']);
            $diachi = trim($_POST['diachi']);
            $sodt = trim($_POST['sodt']);
            
            if (empty($tenkh) || empty($sodt) || empty($diachi)) {
                 echo '<script>alert("Vui lòng điền đầy đủ thông tin.");</script>';
                 include './View/dangky_google.php'; // Show form again
                 exit;
            }
                    
            $ur = new user();
            // addGoogleUser handles check for existing email and username generation
            $userId = $ur->addGoogleUser($tenkh, $email, $sodt, $diachi);
            
            if ($userId != false) {
                 error_log("Google user registration successful for email (".$email."). New/Existing User ID: " . $userId);
                 // Log the user in immediately after successful registration
                $_SESSION['makh'] = $userId;
                $_SESSION['tenkh'] = $tenkh;
                // Fetch username associated with the new/existing ID if needed
                 $userData = $ur->getUserByEmail($email); // Re-fetch to get username if necessary
                 $_SESSION['username'] = $userData ? $userData['username'] : explode('@', $email)[0]; // Set username in session
                
                // Clear temporary Google info from session
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
            include './View/dangky_google.php'; // Show form again
            exit;
        }
        break;

    default:
        include './View/dangky.php'; // Default fallback
        break;
}
