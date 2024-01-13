<main class="main">
  <div class="main-update-acc">
    <h1 class="user-update-title">Đổi mật khẩu</h1>
    <?php
    // Nếu tồn tại biến $_SESSION['tai_khoan_2'] hay biến trả về là một mảng
    if (isset($_SESSION['tai_khoan_2']) && (is_array($_SESSION['tai_khoan_2']))) {
      // Biến đổi các thuộc tính trong bản ghi dữ liệu thành các biến 
      extract($_SESSION['tai_khoan_2']);
    }
    ?>
    <form action="index.php?act=lay_lai_mk" class="form-user" method="post" enctype="multipart/form-data">
      <div class="form-user-group">
        <label for="" class="form-user-label">Mật khẩu mới</label>
        <input type="password" name="mat_khau2" class="form-user-input" />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Xác nhận mật khẩu mới</label>
        <input type="password" name="mat_khau3" class="form-user-input" />
      </div>

      <div class="form-user-group">
        <!-- Tạo input có type là hidden, name: ma_kh, value: ma_kh để lấy dữ liệu tài khoản theo mã kh -->
        <input type="hidden" name="ma_kh" value="<?= $ma_kh ?>">
        <button class="form-user-btn" name="btn_get" type="submit">Đổi mật khẩu</button>
      </div>
    </form>

    <?php
    if (isset($thong_bao) && ($thong_bao != "")) {
      echo "<h3 class='alert-text'>$thong_bao</h3>";
    }
    ?>
  </div>
</main>