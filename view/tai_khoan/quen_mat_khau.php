<main class="main">
  <div class="main-update-acc">
    <h1 class="user-update-title">Lấy mật khẩu</h1>
    <form action="index.php?act=quen_mk" class="form-user" method="post" enctype="multipart/form-data">
      <div class="form-user-group">
        <label for="" class="form-user-label">Tên đăng nhập</label>
        <input type="text" name="ma_kh" class="form-user-input" required />
      </div>

      <div class="form-user-group">
        <label for="" class="form-user-label">Email</label>
        <input type="email" name="email" class="form-user-input" required />
      </div>

      <div class="form-user-group">
        <button class="form-user-btn" name="btn_submit" type="submit">
          Lấy lại mật khẩu
        </button>
      </div>
    </form>

    <?php
    if (isset($thong_bao) && ($thong_bao != "")) {
      echo "<h3 class='alert-text'>$thong_bao</h3>";
    }
    ?>
  </div>
</main>