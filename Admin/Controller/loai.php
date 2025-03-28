<?php
$act = "loai";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'loai':
        include "./View/addloaisanpham.php";
        break;

    case 'loai_action': {
            if (isset($_POST['submit_file']))
                // b1: lấy file về
                $file = $_FILES['file']['tmp_name'];
            // loại bỏ những ký tự đặc biệt khi upload XEF, XBB,XBF
            file_put_contents($file, str_replace("\xEF\xBB\xBF", "", file_get_contents($file)));
            // b2: mở file ra
            $file_open = fopen($file, "r");
            // b3: tiến hành đọc nội dung của file fgetc,fgets,fgetcsv 
            while (($csv = fgetcsv($file_open, 1000, ",")) !== false) {

                $db = new connect();
                $maloai = $csv[0]; //null
                $tenloai = $csv[1]; // túi xách Is
                $idmenu = $csv[2]; //5
                $quey = "insert into loai (maloai, tenloai, idmenu) values ($maloai, '$tenloai', $idmenu)";
                $db->exec($quey);
            }
        }
        include "./View/addloaisanpham.php";
        break;
}
