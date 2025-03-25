<?php
$act = 'sanpham';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'sanpham':
        include './View/sanpham.php';
        break;
    case 'main':
        include './View/main.php';
        break;
    case 'detail':
        include './View/detail.php';
        break;
    case 'cart':
        include './View/cart.php';
        break;
    case 'timkiem':
        include './View/sanpham.php';
        break;
    case 'comment':
        if (isset($_GET["id"])) {
            $mahh = $_GET['id'];
            $makh = $_SESSION['makh'];
            $noidung = $_POST['comment'];
            if ($noidung != null) {
                //$usr = new user();
                //$usr->insertcomment($mahh, $makh, $noidung);
            } else {
                echo '<script> alert("Bạn chưa nhập bình luận !!");</script>';
            }
        }
        include "./View/detail.php";
        break;

    case 'filterproduct':
        include './View/sanpham.php';
        break;
    case 'product_like':
        //khi người dùng nhấn nút mua ngay thì chuyển đến qua đây
        if (isset($_POST["mahh"])) {
            $mahh = $_POST["mahh"];

            //controller yêu cầu model toàn bộ thông tin nào vào trong giỏ hàng
            $prlike = new listProduct_like();
            $addproduct = true;

            if (isset($_SESSION['pro_like'])) {
                foreach ($_SESSION['pro_like'] as $key => $item) {
                    if ($mahh ==  $item['mahh']) {
                        $addproduct = false;
                    }
                }
            }
            //controller yêu cầu model toàn bộ thông tin nào vào trong giỏ hàng
            if ($addproduct == true) {
                $prlike->add_item($mahh);
            }
        }
        include './View/sanpham.php';
        break;
    default;
}
