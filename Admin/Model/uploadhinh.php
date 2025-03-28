<?php
    function uploadimage()
    {
        // b1: cần tạo ra thư mục chứa hình
        $target_dir="D:/xampp/htdocs/DuAn/Content/img/";
        // b2: cần lấy tên hình về
        // Content/imagetourdien/giaycongso.jpg
        $target_file=$target_dir.basename($_FILES['image']['name']);
        // b3: lấy phần mở rộng và chuyển đổi về cùng 1 định dạng ( hoa, thường)
        $targetFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // b4: kiểm tra xem hình đó có thật sự upload lên server
        $uploadhinh=1;
        if(isset($_POST['submit']))
        {
            $check=getimagesize($_FILES['image']['tmp_name']);
            if($check!==false)
            {
                $uploadhinh=1;
            }
            else
            {
                $uploadhinh=0;
                echo '<script> alert("Hình ko tồn tại");</script>';
            }
        }
        // kiểm tra xem hình đó có trong thư mục chưa
        if(file_exists($target_file))
        {
            $uploadhinh=0;
            echo '<script> alert("Hình đã tồn tại");</script>';
        }
        // kiểm tra hình ko được vượt quá dung lượng 500kb
        if($_FILES['image']['size']>500000)
        {
            $uploadhinh=0;
            echo '<script> alert("Hình vượt quá dung lượng");</script>';
        }
        // kiểm tra có phải là hình hay không
        if($targetFileType!="jpg" && $targetFileType=="jpeg" && $targetFileType!="png" && $targetFileType!="gif")
        {
            $uploadhinh=0;
            echo '<script> alert("Ko là hình");</script>';
        }
        // khi ko còn lỗi
        if($uploadhinh==1)
        {
            if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file))
            {
                echo '<script> alert("Upload hình thành công");</script>';
            }
            else
            {
                echo '<script> alert("Upload hình ko thành công");</script>';
            }
        }
    }
