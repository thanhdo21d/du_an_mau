<main class="main">
  <div class="main-form-login">
    <form action="index.php?act=dang_nhap" class="form-login" method="post" enctype="multipart/form-data">
      <h4 class="form-title">Đăng nhập</h4>
      <div class="form-social">
        <button class="form-button-facebook">
          <i class="fa-brands fa-facebook-f form-button-icon"></i>
          <span>Đăng nhập bằng facebook</span>
        </button>
        <button class="form-button-google">
          <i class="fa-brands fa-google form-button-icon"></i>
          <span>Đăng nhập bằng facebook</span>
        </button>
      </div>
      <div class="form-login-group">
        <label for="#" class="form-label">Tài khoản</label>
        <input type="text" name="ma_kh" class="form-login-input" placeholder="Username" required />
      </div>
      <div class="form-login-group">
        <label for="#" class="form-label">Password</label>
        <input type="password" name="mat_khau" class="form-login-input" placeholder="Password" required />
      </div>

      <div class="form-control-group">
        <div class="form-control-remember">
          <input type="checkbox" name="" class="form-control-checkbox" id="form-checkbox" />
          <label for="form-checkbox" class="form-control-label">Ghi nhớ tài khoản</label>
        </div>
        <a href="index.php?act=quen_mk" class="form-control-repass">Quên mật khẩu ?</a>
      </div>

      <div class="form-login-group">
        <button type="submit" name="btn_login" class="form-login-btn">Đăng nhập</button>
      </div>
    </form>

    <?php
    if (isset($thong_bao) && ($thong_bao != "")) {
      echo "<h3 class='alert-text'>$thong_bao</h3>";
    }
    ?>



    <div class="form-singup">
      <span class="form-signup-text">Bạn chưa có tài khoản? <a href="index.php?act=dang_ky">Đăng ký</a></span>
    </div>
  </div>
</main>