<?php

// ===================Kết nối database=======================//
function pdo_get_connection()
{
  $dburl = "mysql:host=localhost;dbname=x-shop-asm;charset=utf8";
  $username = 'root';
  $password = '';

  $conn = new PDO($dburl, $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $conn;
}

// ===================Thực thi câu lệnh sql(thêm, sửa, xóa)=======================//
function pdo_execute($sql)
{
  $sql_args = array_slice(func_get_args(), 1);
  try {
    $conn = pdo_get_connection();
    // Sử dụng prepare để chuẩn hóa câu truy vấn
    $stmt = $conn->prepare($sql);
    // Thực thi câu truy vấn
    $stmt->execute($sql_args);
  } catch (PDOException $e) {
    throw $e;
  } finally {
    unset($conn);
  }
}

// ===================Truy vấn nhiều dữ liệu=======================//
function pdo_query($sql)
{
  $sql_args = array_slice(func_get_args(), 1);
  try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($sql_args);
    $rows = $stmt->fetchAll(); // Trả về danh sách kết quả
    return $rows;
  } catch (PDOException $e) {
    throw $e;
  } finally {
    unset($conn);
  }
}
// ===================Truy vấn một dữ liệu=======================//

function pdo_query_one($sql)
{
  $sql_args = array_slice(func_get_args(), 1);
  try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($sql_args);
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Trả về 1 kết quả
    return $row;
  } catch (PDOException $e) {
    throw $e;
  } finally {
    unset($conn);
  }
}

// ===================Trả về giá trị của câu lệnh sql(count, min, max)=======================//
function pdo_query_value($sql)
{
  $sql_args = array_slice(func_get_args(), 1);
  try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($sql_args);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return array_values($row)[0];
  } catch (PDOException $e) {
    throw $e;
  } finally {
    unset($conn);
  }
}
