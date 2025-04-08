<section class="popular section">
    <div class="main_login">
        <form action="index.php?action=dangnhap&act=dangnhap_action" method="post" class="form" id="register-form">
            <h2 class="section__title">Đăng Nhập</h3>
                <div class="spacer"></div>

                <div class="form-group">
                    <label for="name" class="form-label">Tên Đăng Nhập:</label>
                    <input type="text" required="" autofocus="" name="txtusername" id="name" class="form-control" placeholder="Tên đăng nhập">
                    <!-- <span class="form-message" v-show="invalidName">{{errors.name}}</span> -->
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" required="" autofocus="" name="txtpassword" id="password" class="form-control" placeholder="Nhập mật khẩu">
                    <span class="form-message"> <a href="index.php?action=forgetps">Quên mật khẩu ?</a></span>
                </div>



                <div class="form-btn">
                    <button class="form-submit">Đăng nhập</button>
                </div>
                <a href="index.php?action=dangky" class="dangky ">Đăng ký</a>

                 <!-- Thêm nút Đăng nhập với Google -->
            <div class="google-btn">
                <a href="Controller/loginWithGoogle.php" class="btn btn-google">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Google_g_logo.svg" alt="Google Logo" class="google-logo">
                    Đăng nhập với Google
                </a>
            </div>
        </form>
    </div>
</section>