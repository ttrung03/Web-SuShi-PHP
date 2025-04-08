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


// Phương thức InsertUserOut trong user.php
function InsertUserOut($tenkh, $email, $diachi, $dt)
{
    $db = new connect();

    // Tạo username từ tên người dùng
    $username = strtolower(str_replace(' ', '', $tenkh));  // Loại bỏ khoảng trắng và chuyển thành chữ thường
    
    // Câu lệnh INSERT
    $query = "INSERT INTO khachhang1 (makh, tenkh, username, email, diachi, sodienthoai) 
              VALUES (NULL, :tenkh, :username, :email, :diachi, :dt)";
    $params = [
        ':tenkh' => $tenkh,
        ':username' => $username,
        ':email' => $email,
        ':diachi' => $diachi,
        ':dt' => $dt
    ];

    // Kiểm tra câu lệnh thực thi
    try {
        // Thực thi câu lệnh INSERT
        $db->exec($query, $params);
        return true; // Trả về true khi thêm người dùng thành công
    } catch (PDOException $e) {
        // Nếu có lỗi, thông báo lỗi
        echo "Lỗi khi thêm người dùng: " . $e->getMessage();
        return false;
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
        $query = "insert into binhluan1(mabl, mahh, makh, ngaybl, noidung) 
        values(Null, $mahh, $makh, '$datecreate', '$noidung')";
        $db->exec($query);
    }

    function getCountComment($mahh)
    {
        $db = new connect();
        $select = "select count(mabl) from binhluan1 where mahh=$mahh";
        $result = $db->getInstance($select);
        return $result[0];
    }
    function getNoiDungComment($mahh)
    {
        $db = new connect();
        $select = "select a.username, b.noidung, b.ngaybl from khachhang1 a
        inner join binhluan1 b on a.makh=b.makh where b.mahh = $mahh";
        $result = $db->getList($select);
        return $result;
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
}
