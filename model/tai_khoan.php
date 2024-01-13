<?php
require_once "pdo.php";

// Truy vấn tất cả khách hàng
function lay_tat_ca_tai_khoan()
{
  $sql = "SELECT * FROM khach_hang ORDER BY ma_kh DESC";
  $ds_khach_hang = pdo_query($sql);
  return $ds_khach_hang;
}

// Truy vấn một khách hàng theo mã khách hàng
function lay_tai_khoan_theo_ma($ma_kh)
{
  $sql = "SELECT * FROM khach_hang WHERE ma_kh = '$ma_kh'";
  $tai_khoan_ma_kh = pdo_query_one($sql);
  return $tai_khoan_ma_kh;
}

// Thêm tài khoản ở phía client(đăng ký)
function them_tai_khoan($ma_kh, $mat_khau, $ho, $ten, $kich_hoat, $email, $vai_tro)
{
  $sql = "INSERT INTO khach_hang(ma_kh, mat_khau, ho, ten, kich_hoat, email, vai_tro) VALUES('$ma_kh', '$mat_khau', '$ho', '$ten', $kich_hoat, '$email', $vai_tro)";
  pdo_execute($sql);
}

// Thêm tài khoản ở phía admin
function them_tai_khoan_admin($ma_kh, $mat_khau, $ho, $ten, $kich_hoat, $hinh, $email, $vai_tro)
{
  $sql = "INSERT INTO khach_hang(ma_kh, mat_khau, ho, ten, kich_hoat, hinh, email, vai_tro) VALUES ('$ma_kh', '$mat_khau', '$ho', '$ten', $kich_hoat, '$hinh', '$email', $vai_tro)";
  pdo_execute($sql);
}

// Kiểm tra tài khoản theo mã khách hàng và mật khẩu (đăng nhập)
function ktra_tai_khoan($ma_kh, $mat_khau)
{
  // Truy vấn đến tài khoản mà mã khách hàng và mật khẩu giống tham số truyền vào
  $sql = "SELECT * FROM khach_hang WHERE ma_kh = '$ma_kh' AND mat_khau = '$mat_khau'";
  $tai_khoan = pdo_query_one($sql);
  return $tai_khoan;
}

// Cập nhật tài khoản phía client
function cap_nhat_tai_khoan($ma_kh, $ho, $ten, $hinh, $email)
{
  // Nếu hình khác chuỗi rỗng(khách hàng không đăng tải hình ảnh)
  if ($hinh != "") {
    // Update thêm cả hình ảnh
    $sql = "UPDATE khach_hang SET ho = '$ho', ten = '$ten', hinh = '$hinh', email = '$email' WHERE ma_kh = '$ma_kh'";
  } else {
    // Ngược lại thì không update hình ảnh
    $sql = "UPDATE khach_hang SET ho = '$ho', ten = '$ten', email = '$email' WHERE ma_kh = '$ma_kh'";
  }
  pdo_execute($sql);
}

// Cập nhật tài khoản phía admin
function cap_nhat_tai_khoan_admin($ma_kh, $mat_khau, $ho, $ten, $kich_hoat, $hinh, $email, $vai_tro)
{
  if ($hinh != "") {
    $sql = "UPDATE khach_hang SET mat_khau = '$mat_khau', ho = '$ho', ten = '$ten', kich_hoat = $kich_hoat, hinh = '$hinh', email = '$email', vai_tro = $vai_tro WHERE ma_kh = '$ma_kh'";
  } else {
    $sql = "UPDATE khach_hang SET mat_khau = '$mat_khau', ho = '$ho', ten = '$ten', kich_hoat = $kich_hoat, email = '$email', vai_tro = $vai_tro WHERE ma_kh = '$ma_kh'";
  }
  pdo_execute($sql);
}

// Xóa tài khoản theo mã khách hàng
function xoa_tai_khoan($ma_kh)
{
  $sql = "DELETE FROM khach_hang WHERE ma_kh = '$ma_kh'";
  pdo_execute($sql);
}

// Kiểm tra email
function ktra_email($email)
{
  // Truy vấn đến tài khoản mà email trùng với tham số email truyền vào
  $sql = "SELECT * FROM khach_hang WHERE email = '$email'";
  $tai_khoan_email = pdo_query_one($sql);
  return $tai_khoan_email;
}

// Kiểm tài khoản có tồn tại trong database ko
function ktra_tai_khoan_ton_tai($ma_kh)
{
  // Đếm số lượng tài khoản trong bảng khách hàng theo mã khách hàng
  $sql = "SELECT count(*) FROM khach_hang WHERE ma_kh = ?";
  // Trả về giá trị(số lượng tk) lớn hơn 0 của câu lệnh sql trả về
  return pdo_query_value($sql, $ma_kh) > 0;
}

// Cập nhật mật khẩu theo mã khách hàng
function doi_mat_khau_tai_khoan($ma_kh, $mat_khau_moi)
{
  $sql = "UPDATE khach_hang SET mat_khau = '$mat_khau_moi' WHERE ma_kh = '$ma_kh'";
  pdo_execute($sql);
}
