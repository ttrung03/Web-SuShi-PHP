<section class="popular section">
  <div class="main_login">
    <form action="index.php?action=forgetps&act=checkotp" method="post" class="form" id="register-form">
      <h2 class="section__title">Xác Nhận Mã Khôi Phục</h3>
        <div class="spacer"></div>

        <div class="form-group ">
          <div class="from-code">
            <input type="number" min=0 max=9 name="code1" autofocus oninput="maxLengthCheck(this)">
            <input type="number" min=0 max=9 name="code2" oninput="maxLengthCheck(this)">
            <input type="number" min=0 max=9 name="code3" oninput="maxLengthCheck(this)">
            <input type="number" min=0 max=9 name="code4" oninput="maxLengthCheck(this)">
          </div>
        </div>

        <div class="form-btn">
          <button name="submit_password" class="form-submit">Xác Nhận</button>
        </div>
        <a href="index.php?action=dangnhap" class="dangky ">Đăng Nhập</a>
    </form>
  </div>
</section>
<script>
  const maxLengthCheck = (code, e) => {
    console.log(e);
    if (code.value.length > 1)
      code.value = code.value.slice(0, 1)
  }
</script>