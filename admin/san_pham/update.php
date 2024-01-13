<?php
if (is_array($san_pham)) {
  extract($san_pham);
}

$hinh_anh = "../public/image/" . $hinh;
if (is_file($hinh_anh)) {
  $hinh = "<img src='$hinh_anh' height='80' width='80' class='object-fit-contain'>";
} else {
  $hinh = "No image";
}
?>

<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center bg-dark text-white text-uppercase">
            Cập nhật hàng hóa
          </div>
          <div class="card-body">
            <form action="index.php?act=cap_nhat_sp" method="POST" enctype="multipart/form-data" id="update_hang_hoa">
              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Loại hàng</label>
                  <select name="ma_loai" class="form-control" id="">
                    <?php
                    foreach ($ds_danh_muc as $dsdm) {
                      extract($dsdm);
                      if ($ma_loai == $san_pham['ma_loai']) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                    ?>
                      <option value="<?= $ma_loai ?>" <?= $selected ?>><?= $ten_loai ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Tên hàng hóa</label>
                  <input type="text" name="ten_hang_hoa" id="" class="form-control" value="<?= $ten_hang_hoa ?>" />
                </div>
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Mã hàng hóa</label>
                  <input type="text" name="ma_hang_hoa" id="" readonly class="form-control" value="<?= $ma_hang_hoa ?>" />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-4">
                  <div class="row align-items-center">
                    <div class="col-sm-8">
                      <label for="" class="form-label">Ảnh sản phẩm</label>
                      <input type="file" name="hinh" id="" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                      <!-- Ảnh sản phẩm ban đầu -->
                      <?= $hinh ?>
                    </div>
                  </div>
                </div>
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Đơn giá (vnđ)</label>
                  <input type="text" name="don_gia" id="" class="form-control" value="<?= $don_gia ?>" />
                </div>
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Giảm giá (vnđ)</label>
                  <input type="text" name="giam_gia" id="" class="form-control" value="<?= $giam_gia ?>" />
                </div>
              </div>
              <div class="row"></div>
              <div class="row">
                <div class="form-group col-sm-4">
                  <label>Hàng đặc biệt?</label>
                  <div class="form-control">
                    <label class="radio-inline mr-3">
                      <input type="radio" value="1" name="dac_biet" checked />Đặc biệt
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="dac_biet" />Bình
                      thường
                    </label>
                  </div>
                </div>
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Ngày nhập</label>
                  <input type="date" name="ngay_nhap" id="" class="form-control" value="<?= $ngay_nhap ?>" />
                </div>
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Màu sắc</label>
                  <input type="text" name="mau" id="" class="form-control" value="<?= $mau ?>" />
                </div>
                <div class="form-group col-sm-4">
                  <label for="" class="form-label">Số lượt xem</label>
                  <input type="text" name="so_luot_xem" id="" readonly class="form-control" value="<?= $so_luot_xem ?>" />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-12">
                  <label for="" class="form-label">Mô tả sản phẩm</label>
                  <textarea id="txtarea" spellcheck="false" name="mo_ta" class="form-control form-control-lg mb-3" id="textareaExample" rows="3"><?= $mo_ta ?></textarea>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-sm-12">
                  <label for="" class="form-label">Thông số kỹ thuật sản phẩm</label>
                  <textarea id="txtarea" spellcheck="false" name="thong_so" class="form-control form-control-lg mb-3" id="textareaExample" rows="3"><?= $thong_so ?></textarea>
                </div>
              </div>

              <div class="mb-3 text-center">
                <input type="reset" value="Nhập lại" class="btn btn-danger mr-3" />
                <input type="submit" name="btn_update" value="Cập nhật" class="btn btn-primary mr-3" />
                <a href="index.php?act=danh_sach_sp_trang"><input type="button" class="btn btn-success" value="Danh sách" /></a>
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