<?php
// Ensure session variables are set
if (!isset($_SESSION['google_temp_email']) || !isset($_SESSION['google_temp_name'])) {
    echo "Lỗi: Thông tin đăng nhập tạm thời không tồn tại.";
    echo '<br><a href="/Web-SuShi-PHP/User/index.php?action=dangnhap">Quay lại đăng nhập</a>';
    exit();
}

$email = $_SESSION['google_temp_email'];
$name = $_SESSION['google_temp_name'];
?>

<div class="login-container">
    <h2>Xác nhận đăng nhập với Google</h2>
    
    <div class="google-confirm-info">
        <p>Bạn đang đăng nhập bằng tài khoản Google:</p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>Tên:</strong> <?= htmlspecialchars($name) ?></p>
    </div>

    <p>Bạn có muốn tiếp tục đăng nhập?</p>

    <form action="/Web-SuShi-PHP/User/index.php?action=dangnhap&act=google_confirm_action" method="post">
        <div class="confirm-buttons">
            <button type="submit" name="confirm" value="yes" class="btn-primary">Xác nhận đăng nhập</button>
            <button type="submit" name="confirm" value="no" class="btn-secondary">Hủy</button>
        </div>
    </form>
    
    <div class="login-links">
        <a href="/Web-SuShi-PHP/User/index.php?action=dangnhap">Quay lại trang đăng nhập</a>
    </div>
</div>

<style>
.login-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.google-confirm-info {
    margin: 20px 0;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 5px;
    border-left: 4px solid #4285F4;
}

.confirm-buttons {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
}

.btn-primary {
    background-color: #4285F4;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-secondary {
    background-color: #f1f1f1;
    color: #333;
    border: 1px solid #ddd;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.login-links {
    margin-top: 20px;
    text-align: center;
}

.login-links a {
    color: #4285F4;
    text-decoration: none;
}

.login-links a:hover {
    text-decoration: underline;
}
</style> 