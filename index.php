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

        $target_dir = "./public/image/"; // Thư mục để upload ảnh
        // Hàm basename(path(Đường dẫn được dùng để kiểm tra), end) dùng để trả về tên tập tin từ một đường dẫn.
        // Tạo ra file ảnh bằng cách nối thư mục chứa ảnh và tên file ảnh lại với nhau
        $target_file = $target_dir . basename($_FILES['hinh']['name']);

        // Nếu đăng tải ảnh bằng move_upload_file(đường dẫn(tmp_name), thư mục muốn thêm file ảnh vào) thành công
        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
          $thong_bao = "Đăng tải ảnh thành công";
        } else {
          $thong_bao = "Đăng tải ảnh lên thất bại !";
        }

        // Truy vấn tài khoản theo mã kh
        $tai_khoan = lay_tai_khoan_theo_ma($ma_kh);

        cap_nhat_tai_khoan($ma_kh, $ho, $ten, $hinh, $email);
        // Gán vào session đã in thông tin của tài khoản khách hàng
        $_SESSION['tai_khoan'] = $tai_khoan;
        $thong_bao = "Cập nhật tài khoản thành công";
        // header("Location: index.php?act=quan_ly");
      }
      include "view/tai_khoan/quan_ly.php";
      break;

      // Chức năng quên mật khẩu
    case "quen_mk":
      if (isset($_POST['btn_submit'])) {
        $ma_kh = $_POST['ma_kh'];
        $email = $_POST['email'];
        $tai_khoan = lay_tai_khoan_theo_ma($ma_kh); // Lấy ra tài khoản theo mã kh(tên đăng nhập) để kiểm tra
        // Nếu $tai_khoản trả về true (ở đây là đúng tên đăng nhập trong database)
        if ($tai_khoan) {
          if ($tai_khoan['email'] != $email) {
            $thong_bao = "Sai email đăng nhập !";
          } else {
            // Nếu tài khoản và email đều đúng thì sẽ gán tài khoản cho biến $_SESSION['tai_khoan_2']
            // !: Trường hợp ở đây phải tạo $_SESSION['tai_khoan_2'] để lấy dữ liệu tài khoản mà kp là $_SESSION['tai_khoan'] là do trong chức năng đăng nhập đã có $_SESSION['tai_khoan'] nếu giữ nguyên thì khi người dùng chuyển sang phần đổi lại mật khẩu sẽ tự động đăng nhập vào tài khoản của mình
            // $_SESSION['tai_khoan_2'] = $tai_khoan;
            header("Location: index.php?act=lay_lai_mk"); // Chuyển hướng sang trang lấy lại mật khẩu
          }
        } else {
          $thong_bao = "Sai tên đăng nhập !";
        }
      }
      include "view/tai_khoan/quen_mat_khau.php";
      break;

      // Chức năng lấy lại mật khẩu bằng cách đổi mật khẩu mới
    case "lay_lai_mk":
      if (isset($_POST['btn_get'])) {
        // Lấy ma_kh(tên đăng nhập) 
        $ma_kh = $_POST['ma_kh'];
        $mat_khau2 = $_POST['mat_khau2'];
        $mat_khau3 = $_POST['mat_khau3'];
        if ($mat_khau2 != $mat_khau3) {
          $thong_bao = "Vui lòng xác nhận lại mật khẩu mới !";
        } else {
          // Đổi lại(cập nhật mk mới) theo ma_kh vữa lấy ở trên
          doi_mat_khau_tai_khoan($ma_kh, $mat_khau2);
          $thong_bao = "Đổi mật khẩu thành công";
        }
      }
      include "view/tai_khoan/lay_mat_khau.php";
      break;

      // Chức năng đổi mật khẩu riêng theo ma_kh
    case "doi_mk":
      if (isset($_POST['btn_change'])) {
        $ma_kh = $_POST['ma_kh'];
        $mat_khau = $_POST['mat_khau'];
        $mat_khau2 = $_POST['mat_khau2']; // Mật khẩu mới
        $mat_khau3 = $_POST['mat_khau3']; // Xác nhận mật khẩu mới
        if ($mat_khau2 != $mat_khau3) {
          $thong_bao = "Vui lòng xác nhận lại mật khẩu mới !";
        } else {
          // Lấy tài khoản theo ma_kh
          $tai_khoan = lay_tai_khoan_theo_ma($ma_kh);
          // Nếu tài khoản trả về true (ktra ma_kh(tên đăng nhập) đúng)
          if ($tai_khoan) {
            // Nếu mật khẩu của tài khoản trong database giống mật khẩu người dùng nhập vào input
            if ($tai_khoan['mat_khau'] == $mat_khau) {
              try {
                // Đổi mật khẩu theo ma_kh, và mật khẩu mới nhập
                doi_mat_khau_tai_khoan($ma_kh, $mat_khau2);
                $thong_bao = "Đổi mật khẩu thành công";
              } catch (Exception $exc) {
                $thong_bao = "Đổi mật khẩu thất bại !";
              }
            } else {
              $thong_bao = "Mật khẩu cũ không đúng !";
            }
          } else {
            $thong_bao = "Sai tên đăng nhập";
          }
        }
      }
      include "view/tai_khoan/doi_mat_khau.php";
      break;

      // Chức năng đăng xuất
    case "dang_xuat":
      session_unset(); // session_unset(): Xóa các biến khỏi phiên hiện tại và chúng vẫn còn tồn tại, chỉ phần dữ liệu là bị cắt đi
      header("Location: index.php");
      break;

    case "them_vao_gio_hang":
      if (isset($_POST['btn_insert_cart'])) {
        $ma_hang_hoa = $_POST['ma_hang_hoa'];
        $ten_hang_hoa = $_POST['ten_hang_hoa'];
        $don_gia = (int)$_POST['don_gia'];
        $hinh = $_POST['hinh'];
        $so_luong = (int)$_POST['so_luong'];
        $thanh_tien = $so_luong * $don_gia;
        // Tạo biến flag cố định bằng 0 để kiểm tra
        $flag = 0;

        // Khởi tạo biến i = 0;
        $i = 0;
        // Chạy vòng lặp foreach biến $_SESSION['gio_hang']
        foreach ($_SESSION['gio_hang'] as $gh) {
          // Nếu phần tử thứ 1($ten_hang_hoa) trong mảng $gh trùng với $ten_hang_hoa vừa lấy ở input về
          if ($gh[1] === $ten_hang_hoa) {
            // Khởi tạo biến so_luong_moi = số lượng vừa lấy ở input về + phần tử thứ 4 trong mảng $gh(giỏ hàng) số lượng hiện tại trong giỏ hàng 
            $so_luong_moi = $so_luong + $gh[4];
            // Gán biến $so_luong_moi vào phần tử thứ 4(số_lượng) trong mảng $_SESSION['gio_hang']
            $_SESSION['gio_hang'][$i][4] = $so_luong_moi;
            $flag = 1;
            // break;
          }
          // Sau mỗi lần chạy i tăng lên một để gán cho mỗi sản phẩm trong giỏ hàng một biến $i định dạng riêng
          $i++;
        }

        if ($flag == 0) {
          $them_sp_vao_gh = [$ma_hang_hoa, $ten_hang_hoa, $hinh, $don_gia, $so_luong, $thanh_tien];
          array_push($_SESSION['gio_hang'], $them_sp_vao_gh);
        }
      }
      if (!isset($_SESSION['gio_hang'])) $_SESSION['gio_hang'] = [];
      header("Location: index.php?act=gio_hang");
      break;

      // case "cap_nhat_gio_hang":
      //   if (isset($_POST['btn_cart_update'])) {
      //     $ma_hang_hoa = $_POST['ma_hang_hoa'];
      //     $ten_hang_hoa = $_POST['ten_hang_hoa'];
      //     $don_gia = (int)$_POST['don_gia'];
      //     $hinh = $_POST['hinh'];
      //     $so_luong = (int)$_POST['so_luong'];
      //     $thanh_tien = $so_luong * $don_gia;
      //     $flag = 0;
      //     $i = 0;
      //     foreach ($_SESSION['gio_hang'] as $gh) {
      //       $_SESSION['gio_hang'][$i][4] = $so_luong;
      //       $flag = 1;
      //       $i++;
      //     }
      //     if ($flag == 0) {
      //       $them_sp_vao_gh = [$ma_hang_hoa, $ten_hang_hoa, $hinh, $don_gia, $so_luong, $thanh_tien];
      //       array_push($_SESSION['gio_hang'], $them_sp_vao_gh);
      //     }
      //   }
      //   if (!isset($_SESSION['gio_hang'])) $_SESSION['gio_hang'] = [];
      //   include "view/gio_hang/gio_hang.php";
      //   // header("Location: index.php?act=gio_hang");
      //   break;

    case "xoa_gio_hang":
      if (isset($_GET['ma_gio_hang'])) {
        array_splice($_SESSION['gio_hang'], $_GET['ma_gio_hang'], 1);
      } else {
        $_SESSION['gio_hang'] = [];
      }
      header("Location: index.php?act=gio_hang");
      break;

      // Trang giỏ giỏ hàng
    case "gio_hang":
      if (!isset($_SESSION['gio_hang'])) $_SESSION['gio_hang'] = [];
      include "view/gio_hang/gio_hang.php";
      break;

    case "thanh_toan":
      include "view/gio_hang/thanh_toan.php";
      break;

    case "gioi_thieu":
      include "view/layout/gioi_thieu.php";
      break;

    case "lien_he":
      include "view/layout/lien_he.php";
      break;

    default:
      $danh_sach_sp_noi_bat = lay_san_pham_noi_bat();
      $danh_sach_sp_hot = lay_san_pham_dac_biet();
      include "view/layout/home.php";
      break;
  }
} else {
  $danh_sach_sp_noi_bat = lay_san_pham_noi_bat();
  $danh_sach_sp_hot = lay_san_pham_dac_biet();
  include "view/layout/home.php";
}

include "view/layout/footer.php";
