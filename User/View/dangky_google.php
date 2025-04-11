<?php

if (!isset($_SESSION['google_temp_email']) || !isset($_SESSION['google_temp_name'])) {

    echo "Lỗi: Thông tin đăng ký tạm thời không tồn tại.";

    echo '<br><a href="/Web-SuShi-PHP/User/index.php?action=dangnhap">Quay lại đăng nhập</a>';
    exit();
}

$email = $_SESSION['google_temp_email'];
$name = $_SESSION['google_temp_name'];
?>

<link rel="stylesheet" type="text/css" href="/Web-SuShi-PHP/User/Content/css/style.css">

<h2>Hoàn tất đăng ký bằng Google</h2>
<p>Vui lòng cung cấp thêm thông tin sau:</p>


<form action="/Web-SuShi-PHP/User/index.php?action=dangky&act=google_register_action" method="post">

    <div class="form-group">
        <label for="reg_google_tenkh">Họ tên:</label>
        <input type="text" id="reg_google_tenkh" name="tenkh" value="<?= htmlspecialchars($name) ?>" required>
    </div>

    <div class="form-group">
        <label for="reg_google_sodt">Số điện thoại:</label>
        <input type="text" id="reg_google_sodt" name="sodt" required placeholder="Nhập số điện thoại">
    </div>

    <div class="form-group">
        <label for="reg_google_diachi">Địa chỉ:</label>
        <input type="text" id="reg_google_diachi" name="diachi" required placeholder="Nhập địa chỉ">
    </div>

    <button type="submit">Hoàn tất đăng ký</button>
</form>
