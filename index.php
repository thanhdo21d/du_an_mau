<?php
// Khởi tạo session bằng session_start()
session_start();
ob_start();

// include "model/pdo.php";
include "global.php";

include "model/binh_luan.php";
include "model/danh_muc.php";
include "model/san_pham.php";
include "model/tai_khoan.php";

include "view/layout/header.php";

// Kiểm tra biến chuyển trang ?act
if (isset($_GET['act'])) {
  // Nếu tồn tại giá trị biến ?act thì gán $_GET['act'] cho biến $act
  $act = $_GET['act'];

  // Kiểm tra các trường hợp chuyển trang
  switch ($act) {
      // Trang sản phẩm
    case "san_pham":
      // Chức năng tìm kiếm
      // Nếu tồn tại biến $_POST['btn_search'] (ở đây là người dùng ấn nút tìm kiếm)
      if (isset($_POST['btn_search'])) {
        // Lấy keyword từ form nhập và gán vào biến
        $keyword = $_POST['keyword'];
        // Nếu biến keyword khác rỗng(người dùng nhập chữ)
        if ($keyword != "") {
          // Lấy danh sách sp theo keyword bằng hàm lay_san_pham_theo_kw(tham số $keyword)
          $danh_sach_sp_moi = lay_san_pham_theo_kw($keyword);
          // Danh sách danh mục (tham số order sắp xếp theo tăng dần)
          $danh_sach_dm = lay_tat_ca_danh_muc($order = "ASC");
          // Danh sách sp nổi bật (theo số lượt xem)
          $danh_sach_sp_noi_bat = lay_san_pham_noi_bat();
          include "view/san_pham/san_pham.php";
        } else {
          // Ngược lại $keyword là rỗng (người dùng không nhập gì khi ấn search)
          // Sẽ hiển thị như trang sản phẩm
          $danh_sach_dm = lay_tat_ca_danh_muc($order = "ASC");
          $danh_sach_sp_noi_bat = lay_san_pham_noi_bat();
          // Lấy danh sách sản phẩm theo trang sắp xếp theo mã hàng hóa và giới hạn là 16 sản phẩm
          $danh_sach_sp_moi = lay_san_pham_theo_trang('ma_hang_hoa', 16);
        }
      }
      $danh_sach_dm = lay_tat_ca_danh_muc($order = "ASC");
      $danh_sach_sp_noi_bat = lay_san_pham_noi_bat();
      $danh_sach_sp_moi = lay_san_pham_theo_trang('ma_hang_hoa', 16);
      include "view/san_pham/san_pham.php";
      break;

      // Trang sản phẩm theo danh mục
    case "sp_theo_danh_muc":
      $danh_sach_sp_noi_bat = lay_san_pham_noi_bat();
      $danh_sach_dm = lay_tat_ca_danh_muc($order = "ASC");
      // Nếu tồn tại $_GET['ma_loai'] và $_GET['ma_loai'] > 0 (người dùng nhấn vào danh mục sản phẩm)
      if (isset($_GET['ma_loai']) && ($_GET['ma_loai'] > 0)) {
        // Gán $_GET['ma_loai'] cho biến
        $ma_loai = $_GET['ma_loai'];
        // Lấy danh sản phẩm cùng loại bằng hàm lay_san_pham_theo_dm(tham số $ma_loai)
        $ds_sp_cung_loai = lay_san_pham_theo_dm($ma_loai);
        // Lấy ra tên của danh mục
        $ten_danh_muc = lay_ten_danh_muc($ma_loai);
        include "view/san_pham/san_pham.php";
      } else {
        include "view/layout/home.php";
      }
      break;

      // Trang chi tiết sản phẩm
    case "chi_tiet_sp":
      // Nếu tồn tại $_GET['ma_hang_hoa'] và $_GET['ma_hang_hoa'] > 0(người dùng click vào 1 sản phẩm nào đó)
      if (isset($_GET['ma_hang_hoa']) && ($_GET['ma_hang_hoa'] > 0)) {
        // Gán cho biến $ma_hang_hoa
        $ma_hang_hoa = $_GET['ma_hang_hoa'];
        cap_nhat_so_luot_xem($ma_hang_hoa);
        // Lấy ra sản phẩm của mã hàng hóa trên bằng hàm lay_san_pham_theo_ma(tham số $ma_hang_hoa)
        $san_pham = lay_san_pham_theo_ma($ma_hang_hoa);
        extract($san_pham);
        // Lấy ds sản phẩm liên quan(cùng loại) bằng hàm lay_san_pham_lien_quan(tham số $ma_hang_hoa, tham số $ma_loai lấy ra từ extract($san_pham))
        $sp_lien_quan = lay_san_pham_lien_quan($ma_hang_hoa, $ma_loai);

        // Nếu tồn tại $_POST['danh_gia'](người dùng có đánh giá và nhấn nút đăng tải bình luận)
        if (isset($_POST['danh_gia'])) {
          $noi_dung = $_POST['noi_dung'];
          // date_format(object, format): hàm trả về ngày(date) theo định dạng được chỉ định
          // *) object: tạo một(khởi tạo) đối tượng date bằng date_create()
          // *) format: chỉ định định dạng cho kiểu ngày
          $ngay_bl = date_format(date_create(), 'Y-m-d'); // format theo năm - tháng - ngày
          $danh_gia = $_POST['danh_gia'];

          // Thêm bình luận
          them_binh_luan($noi_dung, $ma_hang_hoa, $_SESSION['tai_khoan']['ma_kh'], $ngay_bl, $danh_gia);
        }
        // Lấy danh sách bình luận theo hàng hóa với tham số $ma_hang_hoa ở trên
        $danh_sach_bl = lay_binh_luan_theo_hh($ma_hang_hoa);
        include "view/san_pham/chi_tiet_sp.php";
      } else {
        include "view/layout/home.php";
      }
      break;

      // Chức năng đăng ký tài khoản
    case "dang_ky":
      if (isset($_POST['btn_submit'])) {
        $ma_kh = $_POST['ma_kh'];
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $email = $_POST['email'];
        $mat_khau = $_POST['mat_khau'];
        $mat_khau2 = $_POST['mat_khau2'];
        $kich_hoat = $_POST['kich_hoat'];
        $vai_tro = $_POST['vai_tro'];

        if ($mat_khau != $mat_khau2) {
          $thong_bao = "Vui lòng nhập mật khẩu phải giống nhau !";
        } else if (ktra_tai_khoan_ton_tai($ma_kh)) {
          $thong_bao = "Tên đăng nhập đã tồn tại vui lòng nhập tên đăng nhập khác !";
        } else {
          try {
            them_tai_khoan($ma_kh, $mat_khau, $ho, $ten, $kich_hoat, $email, $vai_tro);
            $thong_bao = "Đăng ký tài khoản thành công";
          } catch (Exception $exc) {
            $thong_bao = "Đăng ký tài khoản thất bại !";
          }
        }
      }
      include "view/tai_khoan/dang_ky.php";
      break;

      // Chức năng đăng nhập
    case "dang_nhap":
      if (isset($_POST['btn_login'])) {
        $ma_kh = $_POST['ma_kh'];
        $mat_khau = $_POST['mat_khau'];
        $ktra_tai_khoan = ktra_tai_khoan($ma_kh, $mat_khau);
        if (is_array($ktra_tai_khoan)) {
          $_SESSION['tai_khoan'] = $ktra_tai_khoan;
          header("Location: index.php");
        } else {
          $thong_bao = "Tài khoản bạn nhập không tồn tại, vui lòng nhập lại !";
        }
      }
      include "view/tai_khoan/dang_nhap.php";
      break;

      // Chức năng cập nhật tài khoản
    case "quan_ly":
      if (isset($_POST['btn_update'])) {
        $ma_kh = $_POST['ma_kh'];
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $email = $_POST['email'];
        // Lấy thuộc tính name trong mảng $_FILES['hinh'] trả về
        $hinh = $_FILES['hinh']['name'];

