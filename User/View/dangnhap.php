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
                <div style="text-align: center; margin-top: 10px;">
                    <a href="Controller/loginWithGoogle.php"
                        style="display: inline-flex; align-items: center; padding: 8px 15px; background-color: white; color: #444; border: 1px solid #ccc; border-radius: 4px; text-decoration: none; font-weight: bold; transition: background-color 0.3s ease;">

                        <img src="https://developers.google.com/identity/images/g-logo.png"
                            alt="Google Logo"
                            style="width: 20px; height: 20px; margin-right: 8px; vertical-align: middle;">

                        Đăng nhập với Google
                    </a>
                </div>
        </form>
    </div>
</section>