<?php
//khi insert vao du lieu, thi inser vao bang chua khoa chinh chuoc sau do moi vaof bang chua khoa ngoai
include_once 'Model/hoadon.php';


if (isset($_SESSION['makh'])) {
    $hd = new hoadon();
    $sohd = $hd->insertOrder($_SESSION['makh']);
    $_SESSION['sohd'] = $sohd;
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $key => $item) {
        //insertOderDetail($mahd,$mah,$solung,$mau,$size,$thanhtien)
        $hd->insertOderDetail($sohd, $item['mahh'], $item['soluong'], $item['maloai'], $item['total']);
        $hd->updateQuantity($item['mahh'], $item['soluong']);
        $tongtien += $item['total'];
    }
    $hd->updateOder($sohd, $tongtien);

    include "./View/order.php";
} else {
    echo '<script> alert("Bạn chưa đăng nhập");</script>';
    include "./View/dangnhap.php";

}
