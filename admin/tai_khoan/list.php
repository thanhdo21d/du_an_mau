<div class="content">
  <div class="container">
    <div class="page-title">
      <h4 class="mt-5 font-weight-bold text-center">Danh sách khách hàng</h4>
    </div>
    <div class="box box-primary">
      <div class="box-body">
        <form action="?btn_delete_all" method="post" class="table-responsive">
          <button type="submit" class="btn btn-danger mb-1" id="deleteAll" onclick="">
            Xóa mục đã chọn</button>
          <table width="100%" class="table table-hover table-bordered text-center">
            <thead class="thead-dark">
              <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Mã KH</th>
                <th>Mật khẩu</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Kích hoạt</th>
                <th>Ảnh</th>
                <th>Địa chỉ email</th>
                <th>Vai trò</th>
                <th><a href="index.php?act=them_tai_khoan" class="btn btn-success text-white">Thêm mới
                    <i class="fas fa-plus-circle"></i></a></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($ds_khach_hang as $dskh) {
                extract($dskh);
                $sua_tai_khoan = "index.php?act=sua_tai_khoan&ma_kh=" . $ma_kh;
                $xoa_tai_khoan = "index.php?act=xoa_tai_khoan&ma_kh=" . $ma_kh;
                $hinh_anh = "../public/image/" . $hinh;
                if (is_file($hinh_anh)) {
                  $hinh = "<img src='$hinh_anh' height='80' width='80' class='object-fit-contain'>";
                } else {
                  $hinh = "No image";
                }
              ?>
                <tr>
                  <td><input type="checkbox" name="" value=""></td>
                  <td><?= $ma_kh ?></td>
                  <td><?= $mat_khau ?></td>
                  <td><?= $ho ?></td>
                  <td><?= $ten ?></td>
                  <td><?= ($kich_hoat == 1) ? "Đã kích hoạt" : "Chưa kích hoạt" ?></td>
                  <td><?= $hinh ?></td>
                  <td><?= $email ?></td>
                  <td><?= ($vai_tro == 1) ? "Nhân viên" : "Khách hàng" ?></td>
                  <td class="text-end">
                    <a href="<?= $sua_tai_khoan ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                    <a href="<?= $xoa_tai_khoan ?>" class="btn btn-outline-danger btn-rounded" onclick="return confirm('Bạn có chắc là muốn xóa chứ ?')"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>

              <?php
              }
              ?>

            </tbody>

          </table>
        </form>
      </div>
    </div>
  </div>
</div>