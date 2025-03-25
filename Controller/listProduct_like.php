<?php
if (!isset($_SESSION['pro_like'])) {
    $_SESSION['pro_like'] = array();
}

$act = "product_like";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'delete_item':
        if (isset($_GET["id"])) {
            $key = $_GET["id"];
            //ai làm nhiệm vụ xóa
            $prlike = new listProduct_like();
            $prlike->delete_items($key);
        }
        include "./View/productLike.php";
        break;
    case 'timkiem':
        include './View/productLike.php';
        break;
    case 'filterproduct':
        include './View/productLike.php';
        break;
    default:
        include "./View/productLike.php";
}
