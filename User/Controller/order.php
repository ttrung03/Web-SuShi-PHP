<?php
session_start();
if (!isset($_SESSION['makh']) || empty($_SESSION['makh'])) {
    echo '<script> alert("Bạn chưa đăng nhập");</script>';
    include "./View/dangnhap.php";
    exit;  // Dừng lại nếu chưa đăng nhập
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Tiến hành xử lý giỏ hàng
    $hd = new hoadon();
    $sohd = $hd->insertOrder($_SESSION['makh']);
    $_SESSION['sohd'] = $sohd;
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $key => $item) {
        $hd->insertOderDetail($sohd, $item['mahh'], $item['soluong'], $item['maloai'], $item['total']);
        $hd->updateQuantity($item['mahh'], $item['soluong']);
        $tongtien += $item['total'];
    }
    $hd->updateOder($sohd, $tongtien);

    include "./View/order.php";
} else {
    echo '<script> alert("Giỏ hàng của bạn chưa có sản phẩm.");</script>';
    include "./View/cart.php";
}

