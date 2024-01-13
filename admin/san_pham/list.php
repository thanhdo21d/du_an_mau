<div class="content">
  <div class="container">
    <div class="page-title">
      <h4 class="mt-5 font-weight-bold text-center">
        Danh sách hàng hóa
      </h4>
    </div>
    <div class="box box-primary">
      <div class="box-body">
        <form action="?btn_delete_all" method="post" class="table-responsive">
          <button type="submit" class="btn btn-danger mb-1" id="deleteAll" onclick="">
            Xóa mục đã chọn
          </button>
          <table width="100%" class="table table-hover table-bordered text-center">
            <thead class="thead-dark">
              <tr>
                <th><input type="checkbox" id="select-all" /></th>
                <th>Mã HH</th>
                <th>Tên hàng hóa</th>
                <th>Ảnh</th>
                <th>Đơn giá</th>
                <th>Giảm giá</th>
                <th>Lượt xem</th>
                <th>Ngày nhập</th>
                <th>Đặc biệt</th>
                <th>
                  <a href="index.php?act=them_san_pham" class="btn btn-success text-white">Thêm mới <i class="fas fa-plus-circle"></i></a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($danh_sach_sp as $dssp) {
                extract($dssp);
                $suasp = "index.php?act=sua_san_pham&ma_hang_hoa=" . $ma_hang_hoa;
                $xoasp = "index.php?act=xoa_san_pham&ma_hang_hoa=" . $ma_hang_hoa;
                $hinh_anh = "../public/image/" . $hinh;
                if (is_file($hinh_anh)) {
                  $hinh = "<img src='$hinh_anh' height='80' width='80' class='object-fit-contain'>";
                } else {
                  $hinh = "No image";
                }
              ?>
                <tr>
                  <td>
                    <input type="checkbox" name="" value="" />
                  </td>
                  <td><?= $ma_hang_hoa ?></td>
                  <td><?= $ten_hang_hoa ?></td>
                  <td><?= $hinh ?></td>
                  <td><?= number_format($don_gia, "0", ",") ?>đ</td>
                  <td><?= ($giam_gia) ? number_format($giam_gia, "0", ",") . "đ" : "No sale" ?></td>
                  <td><?= $so_luot_xem ?></td>
                  <td><?= $ngay_nhap ?></td>
                  <td><?= ($dac_biet == 1) ? "Đặc biệt" : "Bình thường" ?></td>
                  <td class="text-end">
                    <a href="<?= $suasp ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                    <a href="<?= $xoasp ?>" class="btn btn-outline-danger btn-rounded" onclick="return confirm('Bạn có chắc là muốn xóa chứ ?')"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>

          <div class="mt-3" width="100%">
            <ul class="pagination justify-content-center">
              <?php
              for ($i = 1; $i <= $_SESSION['total_page']; $i++) {
              ?>
                <li class="page-item" <?= $_SESSION['page'] == $i ? 'active' : '' ?>>
                  <a class="page-link" href="index.php?act=danh_sach_sp_trang&page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>