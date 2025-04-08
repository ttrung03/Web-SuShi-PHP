<section class="popular section">
    <div class="main_register">
        <form action="index.php?action=dangky&act=google_register_action" method="post" class="form" id="google-register-form" role="form">
            <h2 class="section__title">Đăng ký tài khoản từ Google</h2>
            <div class="spacer"></div>
            <div class="container_user">
                <!-- Họ tên -->
                <div class="form-group info-user">
                    <label for="name" class="form-label">Họ và tên:</label>
                    <input type="text" name="tenkh" id="name" class="form-control" placeholder="VD: Nguyễn Văn A" value="<?= $_SESSION['google_name'] ?? '' ?>" required />
                </div>
                <!-- Địa chỉ -->
                <div class="form-group info-user">
                    <label for="address" class="form-label">Địa chỉ:</label>
                    <input type="text" name="diachi" id="address" class="form-control" placeholder="Địa chỉ khách hàng" required />
                </div>
                <!-- Số điện thoại -->
                <div class="form-group info-user">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="text" name="sodt" id="phone" class="form-control" placeholder="Số điện thoại" required />
                </div>
                <!-- Email (được lấy từ Google) -->
                <div class="form-group info-user">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $_SESSION['email'] ?? '' ?>" readonly />
                </div>
            </div>
            <div class="form-btn">
                <button type="submit" class="form-submit">Xác nhận</button>
            </div>
        </form>
    </div>
</section>
