<main class="main">
  <div class="main-form">
    <form action="index.php?act=dang_ky" class="form" method="post" enctype="multipart/form-data">
      <h4 class="form-title">Đăng ký</h4>
      <div class="form-group">
        <label for="#" class="form-label">First Name</label>
        <input type="text" name="ho" class="form-input" placeholder="Họ" required />
      </div>
      <div class="form-group">
        <label for="#" class="form-label">Last Name</label>
        <input type="text" name="ten" class="form-input" placeholder="Tên" required />
      </div>
      <div class="form-group">
        <label for="#" class="form-label">Tên đăng nhập</label>
        <input type="text" name="ma_kh" class="form-input" placeholder="Username" required />
      </div>
      <div class="form-group">
        <label for="#" class="form-label">Email</label>
        <input type="email" name="email" class="form-input" placeholder="Email" required />
      </div>
      <div class="form-group">
        <label for="#" class="form-label">Tạo mật khẩu</label>
        <input type="password" name="mat_khau" class="form-input" required />
      </div>
      <div class="form-group">
        <label for="#" class="form-label">Nhập lại mật khẩu</label>
        <input type="password" name="mat_khau2" class="form-input" required />
      </div>
      <div class="form-group">
        <input type="hidden" name="kich_hoat" value="1">
        <input type="hidden" name="vai_tro" value="0">
        <button type="submit" name="btn_submit" class="form-btn">Đăng ký</button>
      </div>

      <div class="form-signin">
        <span class="form-sign-text">
          Đã có tài khoản? <a href="index.php?act=dang_nhap">Đăng Nhập</a></span>
      </div>
    </form>

    <?php
    if (isset($thong_bao) && ($thong_bao != "")) {
      echo "<h3 class='alert-text'>$thong_bao</h3>";
    }
    ?>
  </div>
</main>