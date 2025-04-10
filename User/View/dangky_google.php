<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['google_name'])) {
    header('Location: index.php?action=dangnhap');
    exit();
}

$email = $_SESSION['email'];
$name = $_SESSION['google_name'];
?>

<h2>Đăng ký tài khoản bằng Google</h2>
<form action="../index.php?action=dangky&act=google_register_action" method="post">
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

    <label>Họ tên:</label><br>
    <input type="text" name="tenkh" value="<?= htmlspecialchars($name) ?>" required><br><br>

    <label>Số điện thoại:</label><br>
    <input type="text" name="sodt" required><br><br>

    <label>Địa chỉ:</label><br>
    <input type="text" name="diachi" required><br><br>

    <button type="submit">Hoàn tất đăng ký</button>
</form>
