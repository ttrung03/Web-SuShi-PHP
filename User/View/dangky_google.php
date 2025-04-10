<?php
// No need for session_start() here as it's handled by the controller including this file
// Check if temporary data exists (controller should handle redirect if not)
if (!isset($_SESSION['google_temp_email']) || !isset($_SESSION['google_temp_name'])) {
    // This should ideally not be reached if controller logic is correct
    echo "Lỗi: Thông tin đăng ký tạm thời không tồn tại.";
    // Optionally include a link back to login
    echo '<br><a href="/Web-SuShi-PHP/User/index.php?action=dangnhap">Quay lại đăng nhập</a>';
    exit();
}

$email = $_SESSION['google_temp_email'];
$name = $_SESSION['google_temp_name'];
?>

<h2>Hoàn tất đăng ký bằng Google</h2>
<p>Vui lòng cung cấp thêm thông tin sau:</p>

<!-- Use a root-relative path for the action -->
<form action="/Web-SuShi-PHP/User/index.php?action=dangky&act=google_register_action" method="post">
    <!-- Email is handled via session, no need for hidden input -->

    <label for="reg_google_tenkh">Họ tên:</label><br>
    <input type="text" id="reg_google_tenkh" name="tenkh" value="<?= htmlspecialchars($name) ?>" required><br><br>

    <label for="reg_google_sodt">Số điện thoại:</label><br>
    <input type="text" id="reg_google_sodt" name="sodt" required placeholder="Nhập số điện thoại"><br><br>

    <label for="reg_google_diachi">Địa chỉ:</label><br>
    <input type="text" id="reg_google_diachi" name="diachi" required placeholder="Nhập địa chỉ"><br><br>

    <button type="submit">Hoàn tất đăng ký</button>
</form>
