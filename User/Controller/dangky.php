<?php 
$act = 'dangky';
if(isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'dangky':
        include './View/dangky.php';
        break;
    case 'dangky_action':
        // khi người dùng nhấn đăng kí, nó chuyển qua đây là tên, địa chỉ, sđt
        if(isset($_POST['txttenkh'])) {
            $tenkh = $_POST['txttenkh'];
            $diachi = $_POST['txtdiachi'];
            $sodt = $_POST['txtsodt'];
            $username = $_POST['txtusername'];
            $email = $_POST['txtemail'];
            $pass = $_POST['txtpass'];
            // mật khẩu người dùng nhập vào sẽ dùng md5 để mã hóa
            $crypt = md5($pass);

            //controller yêu cầu model viết lệnh insert vào bảng khách hàng
            //trước khi insert kiểm tra $username có tồn tại trong database hay chưa
            $ur = new user();
            $check = $ur -> InsetUser($tenkh, $username, $crypt, $email, $diachi, $sodt);
            if ($check !='false') {
                echo '<script> alert("Đăng Kí thành công");</script>';
                include './View/main.php';
            }
            else {
                echo '<script> alert("Đăng kí không thành công");</script>';
                include './View/dangky.php';
            }
        }
        break;
        
        case 'google_register':
            include './View/dangky_google.php'; // View mới để nhập thêm thông tin
            break;
    
        
            case 'google_register_action':
                if (isset($_POST['email'])) {
                    $tenkh = $_POST['tenkh'];
                    $diachi = $_POST['diachi'];
                    $sodt = $_POST['sodt'];
                    $email = $_POST['email'];
                    $username = explode('@', $email)[0]; // tạo username từ email
                    $pass = ''; // không cần mật khẩu (vì login Google)
            
                    $ur = new user();
                    $check = $ur->InsetUser($tenkh, $username, $pass, $email, $diachi, $sodt);
                    if ($check != 'false') {
                        $_SESSION['makh'] = $check;
                        $_SESSION['tenkh'] = $tenkh;
                        echo '<script>alert("Tạo tài khoản thành công!");</script>';
                        include './View/main.php';
                    } else {
                        echo '<script>alert("Tạo tài khoản thất bại!");</script>';
                        include './View/dangky_google.php';
                    }
                }
                break;

    default:
        # code...
        break;

    
}
