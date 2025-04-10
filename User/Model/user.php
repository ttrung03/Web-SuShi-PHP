<?php
require_once 'connect.php';
class user
{
    function __construct() {}
    //phương thức insert vào bảng khách hàng
    // select là query thực thi
    // insert. update, delete,... là exec thực thi
    //phương thức thêm

    function InsetUser($tenkh, $user, $matkhau, $email, $diachi, $dt)
    {
        $db = new connect();
        $select = "select * from khachhang1 where username='$user' and email='$email'";
        $existingUser = $db->getInstance($select);  // Kiểm tra người dùng đã tồn tại

        if (!$existingUser) {  // Chỉ thêm mới nếu chưa có người dùng với username và email này
            $query = "insert into khachhang1(makh, tenkh, username, matkhau, email, diachi, sodienthoai, vaitro) 
            values(NULL, '$tenkh', '$user', '$matkhau', '$email', '$diachi', '$dt', default)";
            $db->exec($query);
        }
    }


    // // Phương thức InsertUserOut trong user.php
    // function InsertUserOut($tenkh, $email, $diachi, $dt)
    // {
    //     $db = new connect();

    //     // Tạo username từ tên người dùng
    //     $username = strtolower(str_replace(' ', '', $tenkh));  // Loại bỏ khoảng trắng và chuyển thành chữ thường

    //     // Câu lệnh INSERT
    //     $query = "INSERT INTO khachhang1 (makh, tenkh, username, email, diachi, sodienthoai) 
    //               VALUES (NULL, :tenkh, :username, :email, :diachi, :dt)";
    //     $params = [
    //         ':tenkh' => $tenkh,
    //         ':username' => $username,
    //         ':email' => $email,
    //         ':diachi' => $diachi,
    //         ':dt' => $dt
    //     ];

    //     // Kiểm tra câu lệnh thực thi
    //     try {
    //         // Thực thi câu lệnh INSERT
    //         $db->exec($query, $params);
    //         return true; // Trả về true khi thêm người dùng thành công
    //     } catch (PDOException $e) {
    //         // Nếu có lỗi, thông báo lỗi
    //         echo "Lỗi khi thêm người dùng: " . $e->getMessage();
    //         return false;
    //     }
    // }


    function InsetUserOut($tenkh, $email, $diachi, $dt)
    {
        $db = new connect();
        $select = "select * from user1 where tenkh='$tenkh' and email='$email'";
        if ($select) {
            $query = "insert into user1(makh, tenkh, email, diachi, sodienthoai) 
            values(NULL, '$tenkh', '$email', '$diachi', '$dt')";
            $db->exec($query);
        }
    }


    function login($username, $password)
    {
        $db = new connect();
        $select = "select * from khachhang1 where username='$username' and matkhau='$password'";
        //echo $select;
        $result = $db->getList($select);
        $set = $result->fetch();
        return $set;
    }


    function insertcomment($mahh, $makh, $noidung)
    {
        $db = new connect();
        $date = new DateTime("now");
        $datecreate = $date->format("Y-m-d");

        // Dùng tham số để bảo vệ khỏi SQL Injection
        $query = "INSERT INTO binhluan1 (mabl, mahh, makh, ngaybl, noidung) 
                  VALUES (NULL, :mahh, :makh, :ngaybl, :noidung)";

        $params = [
            ':mahh' => $mahh,
            ':makh' => $makh,
            ':ngaybl' => $datecreate,
            ':noidung' => $noidung
        ];

        // Thực thi câu lệnh
        $db->exec($query, $params);
      
        
    }



    function getCountComment($mahh)
    {
        $db = new connect();
        $select = "SELECT count(mabl) as count FROM binhluan1 WHERE mahh = :mahh";
        $params = [':mahh' => $mahh];  // Truyền tham số an toàn

        $result = $db->getInstance($select, $params);

        if ($result) {
            return $result['count'];  // Trả về số lượng bình luận
        } else {
            return 0;  // Nếu không có bình luận, trả về 0
        }
    }

    function getNoiDungComment($mahh)
    {
        $db = new connect();
        $select = "SELECT a.username, b.noidung, b.ngaybl 
               FROM khachhang1 a
               INNER JOIN binhluan1 b ON a.makh = b.makh 
               WHERE b.mahh = :mahh";
        $params = [':mahh' => $mahh];  // Truyền tham số an toàn

        $result = $db->getList($select, $params);

        // Kiểm tra nếu không có bình luận nào
        if ($result) {
            return $result;  // Trả về dữ liệu bình luận
        } else {
            return [];  // Nếu không có bình luận, trả về mảng rỗng
        }
    }

    //kiểm tra email có tồn tại không 
    function getEmail($email)
    {
        $db = new connect();
        $select = "select * from khachhang1 where email = '$email'";
        $result = $db->getInstance($select);
        return $result;
    }

    function updateEmail($emailold, $passnew)
    {
        $db = new connect();
        echo $emailold;
        $query = "update khachhang1 set matkhau = '$passnew' where email = '$emailold'";
        $db->exec($query);
    }


    function getUserByEmail($email)
    {
        $db = new connect();
        $select = "SELECT * FROM khachhang1 WHERE email = '$email'";
        $result = $db->getInstance($select);
        return $result;
    }

    function addGoogleUser($tenkh, $email, $phone, $address)
    {
        $db = new connect();

        // Tạo username đơn giản từ email
        $username = explode('@', $email)[0];

        $query = "INSERT INTO khachhang1 (tenkh, username, email, sodienthoai, diachi) 
                  VALUES (:tenkh, :username, :email, :phone, :address)";

        $params = [
            ':tenkh' => $tenkh,
            ':username' => $username,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address
        ];

        try {
            $db->exec($query, $params);

            // Lấy mã khách hàng mới nhất
            $result = $db->getInstance("SELECT LAST_INSERT_ID() as makh");
            return $result['makh'];
        } catch (PDOException $e) {
            echo "Lỗi khi thêm người dùng: " . $e->getMessage();
            return false;
        }
    }
}
