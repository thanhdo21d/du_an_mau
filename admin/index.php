<?php
session_start();

include "../global.php";
include "../model/pdo.php";

include "../model/danh_muc.php";
include "../model/san_pham.php";
include "../model/tai_khoan.php";
include "../model/binh_luan.php";
include "../model/thong_ke.php";

include "layout/header.php";

if (isset($_GET['act'])) {
  $act = $_GET['act'];
  switch ($act) {
    case "them_dm":
      if (isset($_POST['btn_insert']) && ($_POST['btn_insert'])) {
        $ten_loai = $_POST['ten_loai'];
        them_danh_muc($ten_loai);
        $thong_bao = "Thêm thành công";
      }
      include "danh_muc/add.php";
      break;

    case "danh_sach_dm":
      $ds_danh_muc = lay_tat_ca_danh_muc();
      include "danh_muc/list.php";
      break;

    case "xoa_dm":
      if (isset($_GET['ma_loai']) && ($_GET['ma_loai'] > 0)) {
        xoa_danh_muc($_GET['ma_loai']);
      }
      $ds_danh_muc = lay_tat_ca_danh_muc();
      include "danh_muc/list.php";
      break;

    case "sua_dm":
      if (isset($_GET['ma_loai']) && ($_GET['ma_loai']) > 0) {
        $ma_loai = $_GET['ma_loai'];
        $danh_muc = lay_danh_muc_theo_ma($ma_loai);
      }
      include "danh_muc/update.php";
      break;

    case "cap_nhat_dm":
      if (isset($_POST['btn_update']) && ($_POST['btn_update'])) {
        $ma_loai = $_POST['ma_loai'];
        $ten_loai = $_POST['ten_loai'];
        cap_nhat_danh_muc($ma_loai, $ten_loai);
        $thong_bao = "Cập nhật thành công";
      }
      $ds_danh_muc = lay_tat_ca_danh_muc();
      include "danh_muc/list.php";
      break;

    case "them_san_pham":
      if (isset($_POST['btn_insert']) && ($_POST['btn_insert'])) {
        $ten_hang_hoa = $_POST['ten_hang_hoa'];
        $don_gia = $_POST['don_gia'];
        $giam_gia = $_POST['giam_gia'];
        $hinh = $_FILES['hinh']['name'];

        $target_dir = "../public/image/";
        $target_file = $target_dir . basename($_FILES['hinh']['name']);

        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
          $thong_bao = "Đăng tải ảnh thành công";
        } else {
          $thong_bao = "Đăng tải ảnh lên thất bại !";
        }

        $ngay_nhap = $_POST['ngay_nhap'];
        $mau = $_POST['mau'];
        $mo_ta = htmlentities($_POST['mo_ta']);
        $thong_so = htmlentities($_POST['thong_so']);
        $dac_biet = $_POST['dac_biet'];
        $so_luot_xem = $_POST['so_luot_xem'];
        $ma_loai = $_POST['ma_loai'];

        them_san_pham($ten_hang_hoa, $don_gia, $giam_gia, $hinh, $ngay_nhap, $mau, $mo_ta, $thong_so, $dac_biet, $so_luot_xem, $ma_loai);
        $thong_bao = "Thêm thành công";
      }
      $ds_danh_muc = lay_tat_ca_danh_muc();
      include "san_pham/add.php";
      break;

      // case "danh_sach_sp":
      //   $ds_danh_muc = lay_tat_ca_danh_muc();
      //   $danh_sach_sp = lay_tat_ca_san_pham();
      //   include "san_pham/list.php";
      //   break;

    case "danh_sach_sp_trang":
      $danh_sach_sp = lay_san_pham_theo_trang('ma_hang_hoa', 10);
      include "san_pham/list.php";
      break;

    case "xoa_san_pham":
      if (isset($_GET['ma_hang_hoa']) && ($_GET['ma_hang_hoa']) > 0) {
        $san_pham = xoa_san_pham($_GET['ma_hang_hoa']);
      }
      $danh_sach_sp = lay_san_pham_theo_trang('ma_hang_hoa', 10);
      include "san_pham/list.php";
      break;

    case "sua_san_pham":
      if (isset($_GET['ma_hang_hoa']) && ($_GET['ma_hang_hoa'] > 0)) {
        $san_pham = lay_san_pham_theo_ma($_GET['ma_hang_hoa']);
      }
      $ds_danh_muc = lay_tat_ca_danh_muc();
      include "san_pham/update.php";
      break;

    case "cap_nhat_sp":
      if (isset($_POST['btn_update']) && ($_POST['btn_update'])) {
        $ma_hang_hoa = $_POST['ma_hang_hoa'];
        $ten_hang_hoa = $_POST['ten_hang_hoa'];
        $don_gia = $_POST['don_gia'];
        $giam_gia = $_POST['giam_gia'];

        $hinh = $_FILES['hinh']['name'];

        $target_dir = "../public/image/";
        $target_file = $target_dir . basename($_FILES['hinh']['name']);

        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
          $thong_bao = "Đăng tải ảnh thành công";
        } else {
          $thong_bao = "Cập nhật hình ảnh thất bại !";
        }

        $ngay_nhap = $_POST['ngay_nhap'];
        $mau = $_POST['mau'];
        $mo_ta = htmlentities($_POST['mo_ta']);
        $thong_so = htmlentities($_POST['thong_so']);
        $dac_biet = $_POST['dac_biet'];
        $so_luot_xem = $_POST['so_luot_xem'];
        $ma_loai = $_POST['ma_loai'];

        cap_nhat_san_pham($ma_hang_hoa, $ten_hang_hoa, $don_gia, $giam_gia, $hinh, $ngay_nhap, $mau, $mo_ta, $thong_so, $dac_biet, $so_luot_xem, $ma_loai);
        $thong_bao = "Cập nhật thành công";
      }
      $danh_sach_sp = lay_san_pham_theo_trang('ma_hang_hoa', 10);
      include "san_pham/list.php";
      break;

    case "them_tai_khoan":
      if (isset($_POST['btn_insert']) && ($_POST['btn_insert'])) {
        $ma_kh = $_POST['ma_kh'];
        $mat_khau = $_POST['mat_khau'];
        $mat_khau2 = $_POST['mat_khau2'];
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $kich_hoat = $_POST['kich_hoat'];
        $hinh = $_FILES['hinh']['name'];

        $target_dir = "../public/image/";
        $target_file = $target_dir . basename($_FILES['hinh']['name']);

        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
          $thong_bao = "Đăng tải ảnh thành công";
        } else {
          $thong_bao = "Đăng tải ảnh lên thất bại !";
        }

        $email = $_POST['email'];
        $vai_tro = $_POST['vai_tro'];

        if ($mat_khau != $mat_khau2) {
          $thong_bao = "Vui lòng xác nhận lại mật khẩu !";
        } else {
          them_tai_khoan_admin($ma_kh, $mat_khau, $ho, $ten, $kich_hoat, $hinh, $email, $vai_tro);
          $thong_bao = "Thêm tài khoản thành công";
        }
      }
      include "tai_khoan/add.php";
      break;

    case "danh_sach_tk":
      $ds_khach_hang = lay_tat_ca_tai_khoan();
      include "tai_khoan/list.php";
      break;

    case "xoa_tai_khoan":
      if (isset($_GET['ma_kh']) && ($_GET['ma_kh']) > 0) {
        $tai_khoan = xoa_tai_khoan($_GET['ma_kh']);
      }
      $ds_khach_hang = lay_tat_ca_tai_khoan();
      include "tai_khoan/list.php";
      break;

    case "sua_tai_khoan":
      if (isset($_GET['ma_kh']) && ($_GET['ma_kh'] > 0)) {
        $tai_khoan = lay_tai_khoan_theo_ma($_GET['ma_kh']);
      }
      include "tai_khoan/update.php";
      break;

    case "cap_nhat_tk":
      if (isset($_POST['btn_update']) && ($_POST['btn_update'])) {
        $ma_kh = $_POST['ma_kh'];
        $mat_khau = $_POST['mat_khau'];
        $mat_khau2 = $_POST['mat_khau2'];
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $kich_hoat = $_POST['kich_hoat'];
        $hinh = $_FILES['hinh']['name'];

        $target_dir = "../public/image/";
        $target_file = $target_dir . basename($_FILES['hinh']['name']);

        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
          $thong_bao = "Đăng tải ảnh thành công";
        } else {
          $thong_bao = "Đăng tải ảnh lên thất bại !";
        }

        $email = $_POST['email'];
        $vai_tro = $_POST['vai_tro'];

        if ($mat_khau != $mat_khau2) {
          $thong_bao = "Vui lòng xác nhận lại mật khẩu";
        } else {
          cap_nhat_tai_khoan_admin($ma_kh, $mat_khau, $ho, $ten, $kich_hoat, $hinh, $email, $vai_tro);
          $thong_bao = "Cập nhật thành công";
        }
      }
      $ds_khach_hang = lay_tat_ca_tai_khoan();
      include "tai_khoan/list.php";
      break;

    case "binh_luan":
      $danh_sach_bl = thong_ke_binh_luan();
      include "binh_luan/list.php";
      break;

    case "chi_tiet_bl":
      if (isset($_GET['ma_hang_hoa']) && ($_GET['ma_hang_hoa'] > 0)) {
        $ds_chi_tiet_bl = lay_binh_luan_theo_hh($_GET['ma_hang_hoa']);
      }
      include "binh_luan/chi_tiet_binh_luan.php";
      break;

    case "xoa_binh_luan":
      if (isset($_GET['ma_bl']) && ($_GET['ma_bl']) > 0) {
        $tai_khoan = xoa_binh_luan($_GET['ma_bl']);
      }
      if (isset($_GET['ma_hang_hoa']) && ($_GET['ma_hang_hoa'] > 0)) {
        $ds_chi_tiet_bl = lay_binh_luan_theo_hh($_GET['ma_hang_hoa']);
      }
      include "binh_luan/chi_tiet_binh_luan.php";
      break;

    case "thong_ke":
      $ds_thong_ke_hh = thong_ke_hang_hoa();
      include "thong_ke/list.php";
      break;

      // case "bieu_do":
      //   $ds_thong_ke_hh = thong_ke_hang_hoa();
      //   include "thong_ke/chart.php";
      //   break;

    default:
      $danh_muc = count(lay_tat_ca_danh_muc());
      $san_pham = count(lay_tat_ca_san_pham());
      $tai_khoan = count(lay_tat_ca_tai_khoan());
      $binh_luan = count(lay_tat_ca_binh_luan());
      include "layout/home.php";
      break;
  }
} else {
  $danh_muc = count(lay_tat_ca_danh_muc());
  $san_pham = count(lay_tat_ca_san_pham());
  $tai_khoan = count(lay_tat_ca_tai_khoan());
  $binh_luan = count(lay_tat_ca_binh_luan());
  include "layout/home.php";
}

include "layout/footer.php";
