<?php
//tạo được giở hàng cho khách hàng
// kiểm tra khi nào tạo? khi giỏ hàng chưa có

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$act = "giohang";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'giohang':
        //khi người dùng nhấn nút mua ngay thì chuyển đến qua đây
        if (isset($_POST["mahh"])) {
            $mahh = $_POST["mahh"];
            $soluong = $_POST["soluong"];
            //controller yêu cầu model toàn bộ thông tin nào vào trong giỏ hàng
            $gh = new giohang();
            $addproduct = true;

            foreach ($_SESSION['cart'] as $key => $item) {
                if ($mahh ==  $item['mahh']) {
                    $gh->update_items($key, ($soluong + $item['soluong']));
                    $addproduct = false;
                }
            }
            //controller yêu cầu model toàn bộ thông tin nào vào trong giỏ hàng
            if ($addproduct == true) {
                $gh->add_item($mahh, $soluong);
            }
        }
        include "./View/cart.php";
        break;

    case 'delete_item':
        if (isset($_GET["id"])) {
            $key = $_GET["id"];
            //ai làm nhiệm vụ xóa
            $gh = new giohang();
            $gh->delete_items($key);
        }
        include "./View/cart.php";
        break;

    case 'update_item':
        if (isset($_POST["newqty"])) {
            $new_list = $_POST["newqty"];

            foreach ($new_list as $key => $qty) {
                if ($_SESSION['cart'][$key]['soluong'] != $qty) {

                    // nếu số lượng trong cart mà khác với số lượng trong new_list
                    $gh = new giohang();
                    $gh->update_items($key, $qty);
                }
            }
        }
        include "./View/cart.php";
        break;
}
