<main class="main">
  <div class="main-update-acc">
    <h1 class="user-update-title">Đổi mật khẩu</h1>
    <?php
    if (isset($_SESSION['tai_khoan']) && (is_array($_SESSION['tai_khoan']))) {
      extract($_SESSION['tai_khoan']);
    }
    ?>
    <form action="index.php?act=doi_mk" class="form-user" method="post" enctype="multipart/form-data">
      <div class="form-user-group">
        <label for="" class="form-user-label">Tên đăng nhập</label>
        <input type="text" name="ma_kh" class="form-user-input" value="<?= $ma_kh ?>" disabled />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Mật khẩu cũ</label>
        <input type="password" name="mat_khau" class="form-user-input" />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Mật khẩu mới</label>
        <input type="password" name="mat_khau2" class="form-user-input" />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Xác nhận mật khẩu mới</label>
        <input type="password" name="mat_khau3" class="form-user-input" />
      </div>

      <div class="form-user-group">
        <input type="hidden" name="ma_kh" value="<?= $ma_kh ?>">
        <button class="form-user-btn" name="btn_change" type="submit">Đổi mật khẩu</button>
      </div>
    </form>

    <?php
    if (isset($thong_bao) && ($thong_bao != "")) {
      echo "<h3 class='alert-text'>$thong_bao</h3>";
    }
    ?>
  </div>
</main>