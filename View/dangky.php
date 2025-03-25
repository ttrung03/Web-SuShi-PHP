<section class="popular section">
    <div class="main_login">
        <form action="index.php?action=dangky&act=dangky_action" method="post" class="form" id="register-form" role="form">
            <h2 class="section__title">Đăng Ký</h3>
                <div class="spacer"></div>
                <div class="container_user">
                    <div class="form-group info-user">
                        <label for="name" class="form-label">Tên người dùng:</label>
                        <input type="text" required="" autofocus="" name="txttenkh" id="name" class="form-control" placeholder="VD: Nguyễn Văn A">
                        <!-- <span class="form-message" v-show="invalidName">{{errors.name}}</span> -->
                    </div>
                    <div class="form-group info-user">
                        <label for="name" class="form-label">Địa chỉ:</label>
                        <input type="text" required="" autofocus="" name="txtdiachi" id="name" class="form-control" placeholder="Địa chỉ khách hàng">
                        <!-- <span class="form-message" v-show="invalidName">{{errors.name}}</span> -->
                    </div>
                    <div class="form-group info-user">
                        <label for="name" class="form-label">Số Điện Thoại:</label>
                        <input type="text" required="" autofocus="" name="txtsodt" id="name" class="form-control" placeholder="Số điện thoại khách hàng">
                        <!-- <span class="form-message" v-show="invalidName">{{errors.name}}</span> -->
                    </div>
                    <div class="form-group info-user">
                        <label for="name" class="form-label">Tên Đăng Nhập:</label>
                        <input type="text" required="" autofocus="" name="txtusername" id="name" class="form-control" placeholder="Tên đăng nhập">
                        <!-- <span class="form-message" v-show="invalidName">{{errors.name}}</span> -->
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" required="" autofocus="" name="txtemail" id="email" class="form-control" placeholder="VD: email@gmail.com">
                    <!-- <span class="form-message" v-show="invalidEmail">{{errors.email}}</span> -->
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" required="" autofocus="" name="txtpass" id="password" class="form-control" placeholder="Nhập mật khẩu">
                    <!-- <span class="form-message" v-show="invalidPass">{{errors.pass}}</span> -->
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Nhập lại mật khẩu:</label>
                    <input type="password" required="" autofocus="" name="retypepassword" id="password" class="form-control" placeholder="Nhập mật khẩu">
                    <!-- <span class="form-message" v-show="invalidPass">{{errors.passconfir}}</span> -->
                </div>

                <div class="form-btn">
                    <button class="form-submit"> Đăng Ký</button>
                </div>
                <a href="index.php?action=dangnhap" class="dangky ">Đăng nhập</a>
        </form>
    </div>
</section>