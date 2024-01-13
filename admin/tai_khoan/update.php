<?php
if (is_array($tai_khoan)) {
  extract($tai_khoan);
}

$hinh_anh = "../public/image/" . $hinh;
if (is_file($hinh_anh)) {
  $hinh = "<img src='$hinh_anh' height='80' width='80' class='object-fit-contain'>";
}
?>

<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center bg-dark text-white text-uppercase">Cập nhật khách hàng</div>
          <div class="card-body">
            <form action="index.php?act=cap_nhat_tk" method="POST" enctype="multipart/form-data" id="admin_add_kh">
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="" class="form-label">Mã khách hàng (tên đăng nhập)</label>
                  <input type="text" name="ma_kh" id="" class="form-control" value="<?= $ma_kh ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="" class="form-label">Họ</label>
                  <input type="text" name="ho" id="" class="form-control" value="<?= $ho ?>">
                </div>
                <div class="form-group col-sm-6">
                  <label for="" class="form-label">Tên</label>
                  <input type="text" name="ten" id="" class="form-control" value="<?= $ten ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="" class="form-label">Mật khẩu</label>
                  <input type="password" name="mat_khau" id="" class="form-control" value="<?= $mat_khau ?>">
                </div>
                <div class="form-group col-sm-6">
                  <label for="" class="form-label">Xác nhận mật khẩu</label>
                  <input type="password" name="mat_khau2" class="form-control" value="<?= $mat_khau ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="" class="form-label">Ảnh</label>
                  <input type="file" name="hinh" id="" class="form-control">
                </div>
                <div class="col-sm-4">
                  <!-- Ảnh sản phẩm ban đầu -->
                  <?= $hinh ?>
                </div>
                <div class="form-group col-sm-6">
                  <label for="" class="form-label">Địa chỉ email</label>
                  <input type="email" name="email" id="" class="form-control" value="<?= $email ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                  <label>Kích hoạt</label>
                  <div class="form-control">
                    <label class="radio-inline  mr-3">
                      <input type="radio" value="0" name="kich_hoat">Chưa kích
                      hoạt
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="1" name="kich_hoat" checked>Kích hoạt
                    </label>
                  </div>
                </div>
                <div class="form-group col-sm-6">
                  <label>Vai trò </label>
                  <div class="form-control">
                    <label class="radio-inline mr-3">
                      <input type="radio" value="0" name="vai_tro">Khách hàng
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="1" name="vai_tro" checked>Nhân viên
                    </label>
                  </div>
                </div>
              </div>

              <div class="mb-3 text-center mt-3">
                <input type="reset" value="Nhập lại" class="btn btn-danger mr-3">
                <input type="submit" name="btn_update" value="Cập nhật" class="btn btn-primary mr-3">
                <a href="index.php?act=danh_sach_tk"><input type="button" class="btn btn-success" value="Danh sách"></a>
              </div>
            </form>
            <?php
            if (isset($thong_bao) && ($thong_bao != "")) {
              echo "<h3 class='alert-text'>$thong_bao</h3>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>