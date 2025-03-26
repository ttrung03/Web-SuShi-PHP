<?php
//tạo được giở hàng cho khách hàng
// kiểm tra khi nào tạo? khi giỏ hàng chưa có

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$act = "hanghoa";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'hanghoa':
        include "./View/hanghoa.php";
        break;
    case 'insert':
        include "./View/edithanghoa.php";
        break;

    case 'insert_action':
        if (isset($_POST['tenhh'])) {
            $tenhh = $_POST['tenhh'];
            $dongia = $_POST['dongia'];
            $giamgia = $_POST['giamgia'];
            $hinh = $_FILES['image']['name'];
            $Nhom = $_POST['nhom'];
            $maloai = $_POST['maloai'];
            $soluotxem = $_POST['slx'];
            $ngaylap = $_POST['ngaylap'];
            $mota = $_POST['mota'];
            $soluongton = $_POST['slt'];
            $hh = new hanghoa();

            if ($tenhh == null || $dongia == null  || $maloai == null  || $mota == null  || $soluongton == null) {
                echo '<script> alert ("Vui lòng nhập giá trị") </script>';
                include "./View/edithanghoa.php";
            } else {
                $check =  $hh->insertHangHoa($tenhh, $dongia, $giamgia, $hinh, $Nhom, $maloai, $soluotxem, $ngaylap, $mota, $soluongton);
                if ($check !== false) {

                    uploadImage();
                    echo '<script> alert ("Thêm thành công") </script>';
                    include "./View/hanghoa.php";
                } else {
                    echo '<script> alert ("Thêm k thành công") </script>';
                    include "./View/edithanghoa.php";
                }
            }
        }

        break;

    case 'delete':
        if (isset($_GET["id"])) {
            $key = $_GET["id"];
            $gh = new hanghoa();
            $gh->DeleteHangHoa($key);
            echo '<script> alert ("Xóa thành công") </script>';
        } else {
            echo '<script> alert ("Xóa không thành công") </script>';
        }
        include "./View/hanghoa.php";
        break;

    case 'edit':
        include "./View/edithanghoa.php";
        break;
    case 'edit_action':
        $mahh = $_GET['id'];
        $tenhh = $_POST['tenhh'];
        $dongia = $_POST['dongia'];
        $giamgia = $_POST['giamgia'];
        $hinh = $_FILES['image']['name'];
        $Nhom = $_POST['nhom'];
        $maloai = $_POST['maloai'];
        $soluotxem = $_POST['slx'];
        $ngaylap = $_POST['ngaylap'];
        $mota = $_POST['mota'];
        $soluongton = $_POST['slt'];
        $tinhtrang = $_POST['tinhtrang'];
        $hh = new hanghoa();
        $check =   $hh->updatesp($mahh, $tenhh, $dongia, $giamgia, $hinh, $Nhom, $maloai, $soluotxem, $ngaylap, $mota, $soluongton, $tinhtrang);

        if ($check !== false) {
            uploadImage();
            echo '<script> alert ("Cập nhật thành công") </script>';
            include "./View/hanghoa.php";
        } else {
            echo '<script> alert ("Cập nhật k thành công") </script>';
            include "./View/edithanghoa.php";
        }
        break;
    case 'hanghoa_import':
        if (isset($_POST['submit_file']))
            // b1: lấy file về
            $file = $_FILES['file']['tmp_name'];
        // loại bỏ những ký tự đặc biệt khi upload XEF, XBB,XBF
        file_put_contents($file, str_replace("\xEF\xBB\xBF", "", file_get_contents($file)));
        // b2: mở file ra
        $file_open = fopen($file, "r");
        // b3: tiến hành đọc nội dung của file fgetc,fgets,fgetcsv 
        while (($csv = fgetcsv($file_open, 1000, ",")) !== false) {

            $mahh = $csv[0];
            $tenhh = $csv[1];
            $dongia = $csv[2];
            $giamgia = $csv[3];
            $hinh = $csv[4];
            $Nhom = $csv[5];
            $maloai = $csv[6];
            $soluotxem = $csv[7];
            $ngaylap = $csv[8];
            $mota = $csv[9];
            $soluongton = $csv[10];

            echo $mahh, '$tenhh', $dongia, $giamgia, '$hinh', $Nhom, $maloai, $soluotxem, '$ngaylap', '$mota', $soluongton;
            $db = new connect();
            $query = "insert into hanghoa (mahh , tenhh, dongia, giamgia, hinh, Nhom, maloai,  soluotxem, ngaylap, mota, soluongton,tinhtrang)
            values($mahh, '$tenhh', $dongia, $giamgia, '$hinh', $Nhom, $maloai, $soluotxem, '$ngaylap','$mota', $soluongton,0)";
            $db->exec($query);

           
        }
        include "./View/hanghoa.php";
        break;
}
