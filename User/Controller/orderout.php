<?php
$act = 'orderout';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'orderout':
        error_log("Orderout controller - sohd in session: " . (isset($_SESSION['sohd']) ? $_SESSION['sohd'] : 'Not set'));
        
        // Make sure we have an order ID
        if (!isset($_SESSION['sohd'])) {
            echo "<h3 style='color:red; text-align:center'>Không tìm thấy thông tin hóa đơn!</h3>";
            include './View/sanpham.php';
        } else {
            // Load the order view to display details
            include './View/order.php';
        }
        break;

    case 'orderout_action':
        // khi người dùng nhấn đăng kí, nó chuyển qua đây là tên, địa chỉ, sđt
        if (isset($_POST['txttenkh'])) {
            $tenkh = $_POST['txttenkh'];
            $diachi = $_POST['txtdiachi'];
            $sodt = $_POST['txtsodt'];
            $username = $_POST['txtusername'];
            $email = $_POST['txtemail'];
            // mật khẩu người dùng nhập vào sẽ dùng md5 để mã hóa
            

            //controller yêu cầu model viết lệnh insert vào bảng khách hàng
            //trước khi insert kiểm tra $username có tồn tại trong database hay chưa
            $ur = new user();
                $check = $ur->InsetUserOut($tenkh, $email, $diachi, $sodt);

            if ($check != 'false') {
                echo '<script> alert("Mua hàng thành công");</script>';
                include './View/order.php';
            } else {
                echo '<script> alert("Mua hàng không thành công");</script>';
                include './View/orderout.php';
            }
        }
        break;

    default:
        # code...
        break;
}
