<main class="main">
  <div class="main-update-acc">
    <h1 class="user-update-title">Cập nhật tài khoản</h1>
    <?php
    if (isset($_SESSION['tai_khoan']) && (is_array($_SESSION['tai_khoan']))) {
      extract($_SESSION['tai_khoan']);
    }
    ?>
    <form action="index.php?act=quan_ly" class="form-user" method="post" enctype="multipart/form-data">
      <div class="form-user-group">
        <label for="" class="form-user-label">Tên đăng nhập</label>
        <input type="text" name="ma_kh" class="form-user-input" value="<?= $ma_kh ?>" disabled />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Họ</label>
        <input type="text" name="ho" class="form-user-input" value="<?= $ho ?>" />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Tên</label>
        <input type="text" name="ten" class="form-user-input" value="<?= $ten ?>" />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Địa chỉ email</label>
        <input type="text" name="email" class="form-user-input" value="<?= $email ?>" />
      </div>

      <div class="form-user-group">
        <img src="#" alt="" class="form-user-image" />
        <label for="" class="form-user-label">Ảnh đại diện</label>
        <input type="file" name="hinh" class="form-user-input" value="<?= $hinh ?>" />
      </div>

      <div class="form-user-group">
        <input type="hidden" name="ma_kh" value="<?= $ma_kh ?>">
        <button class="form-user-btn" name="btn_update" type="submit">Cập nhật</button>
      </div>
    </form>

    <?php
    if (isset($thong_bao) && ($thong_bao != "")) {
      echo "<h3 class='alert-text'>$thong_bao</h3>";
    }
    ?>
  </div>
</main>