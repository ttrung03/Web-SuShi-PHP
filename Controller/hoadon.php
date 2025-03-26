<?php

// gọi đến view
$act = "hoadon";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'hoadon':
        include './View/hoadon.php';
        break;
    case 'chitiethoadon':
        include './View/chitiethoadon.php';
        break;
}
