<section class="popular section">
  <div class="main_login">
    <form action="index.php?action=forgetps&act=forget_action" method="post" class="form" id="register-form">
      <h2 class="section__title">Lấy lại mật khẩu</h3>
        <div class="spacer"></div>

        <div class="form-group">
          <label for="name" class="form-label">Nhập Email:</label>
          <input type="email" required="" autofocus="" name="email" class="form-control" placeholder="VD: example@gmai.com">
          <!-- <span class="form-message" v-show="invalidName">{{errors.name}}</span> -->
        </div>

        <div class="form-btn">
          <button name="submit_email" class="form-submit">Gửi</button>
        </div>
        <a href="index.php?action=dangnhap" class="dangky ">Đăng Nhập</a>
    </form>
  </div>
</section>