<?php
// Kiểm tra xem người dùng đã gửi thông tin chưa
if (isset($_POST['email'])) {
    // Lấy dữ liệu từ form
    $tenkh = $_POST['tenkh'];
    $diachi = $_POST['diachi'];
    $sodt = $_POST['sodt'];
    $email = $_POST['email'];
    $username = explode('@', $email)[0]; // Tạo username từ email
    $pass = ''; // Không cần mật khẩu cho tài khoản Google

    // Kết nối đến Model
    require_once '../model/user.php';
    $ur = new user();

    // Gọi phương thức InsertUser để lưu thông tin vào database
    $check = $ur->InsetUser($tenkh, $username, $pass, $email, $diachi, $sodt);

    // Kiểm tra kết quả
    if ($check != 'false') {
        // Lưu thông tin vào session và chuyển đến trang chính
        $_SESSION['makh'] = $check;
        $_SESSION['tenkh'] = $tenkh;
        header('Location: http://localhost/Web-SuShi-PHP/User/index.php?action=main');
        exit();
    } else {
        // Nếu thất bại, hiển thị thông báo lỗi
        echo '<script>alert("Tạo tài khoản thất bại!");</script>';
        include './View/dangky_google.php'; // Trở lại form đăng ký
    }
} else {
    // Nếu chưa có thông tin, chuyển về trang đăng ký
    include './View/dangky_google.php';
}
?>
