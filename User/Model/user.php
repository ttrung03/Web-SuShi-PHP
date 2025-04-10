<?php
require_once 'connect.php';
class user
{
    function __construct() {}
    //phương thức insert vào bảng khách hàng
    // select là query thực thi
    // insert. update, delete,... là exec thực thi
    //phương thức thêm

    // Fixed: Use prepared statements to prevent SQL injection
    function InsetUser($tenkh, $user, $matkhau, $email, $diachi, $dt)
    {
        $db = new connect();
        // Check if username or email already exists
        $select = "SELECT makh FROM khachhang1 WHERE username = :username OR email = :email";
        $params_check = [':username' => $user, ':email' => $email];
        $existingUser = $db->getInstance($select, $params_check);

        if ($existingUser) {
             error_log("InsetUser Error: Username (".$user.") or Email (".$email.") already exists.");
            return 'false'; // Indicate failure (user exists)
        }

        // Insert new user
        $query = "INSERT INTO khachhang1(makh, tenkh, username, matkhau, email, diachi, sodienthoai, vaitro) 
                  VALUES (NULL, :tenkh, :username, :matkhau, :email, :diachi, :dt, default)";
        $params_insert = [
            ':tenkh' => $tenkh,
            ':username' => $user,
            ':matkhau' => $matkhau, // Should be hashed password (md5($pass) from controller)
            ':email' => $email,
            ':diachi' => $diachi,
            ':dt' => $dt
        ];
        
        try {
            $result = $db->exec($query, $params_insert);
            if ($result) {
                 // Optionally return the new user ID
                 $lastIdResult = $db->getInstance("SELECT LAST_INSERT_ID() as makh");
                 return $lastIdResult ? $lastIdResult['makh'] : true; // Return new ID or true
            } else {
                error_log("InsetUser Error: Database execution failed.");
                return 'false';
            }
        } catch (PDOException $e) {
            error_log("InsetUser PDOException: " . $e->getMessage());
            return 'false';
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

    // This function seems unused or related to a different table (user1)? 
    // Commenting out for now unless it's needed.
    /*
    function InsetUserOut($tenkh, $email, $diachi, $dt)
    {
        $db = new connect();
        // Should check khachhang1 table?
        $select = "select * from khachhang1 where email= :email"; 
        $params_check = [':email' => $email];
        $existing = $db->getInstance($select, $params_check);
        
        // Logic needs clarification - insert into user1 if email exists in khachhang1?
        if ($existing) { 
            // Should use prepared statements here too
            $query = "insert into user1(makh, tenkh, email, diachi, sodienthoai) 
                      values(NULL, :tenkh, :email, :diachi, :dt)";
            $params_insert = [
                ':tenkh' => $tenkh,
                ':email' => $email,
                ':diachi' => $diachi,
                ':dt' => $dt
            ];
            $db->exec($query, $params_insert);
             return true; // Indicate success?
        } 
        return false; // Indicate failure?
    }
    */


    function login($username, $password) 
    {
        $db = new connect();
        $select = "SELECT * FROM khachhang1 WHERE username = :username AND matkhau = :password";
        $params = [
            ':username' => $username,
            ':password' => $password 
        ];
        $result = $db->getInstance($select, $params); 
        return $result; 
    }

   
    function insertcomment($mahh, $makh, $noidung)
    {
        $db = new connect();
        $date = new DateTime("now");
        $datecreate = $date->format("Y-m-d");

        $query = "INSERT INTO binhluan1 (mabl, mahh, makh, ngaybl, noidung) 
                  VALUES (NULL, :mahh, :makh, :ngaybl, :noidung)";

        $params = [
            ':mahh' => $mahh,
            ':makh' => $makh,
            ':ngaybl' => $datecreate,
            ':noidung' => $noidung
        ];
        $db->exec($query, $params); 
    }

   
    function getCountComment($mahh)
    {
        $db = new connect();
        $select = "SELECT count(mabl) as count FROM binhluan1 WHERE mahh = :mahh";
        $params = [':mahh' => $mahh];
        $result = $db->getInstance($select, $params);
        return $result ? $result['count'] : 0;
    }

 
    function getNoiDungComment($mahh)
    {
        $db = new connect();
        $select = "SELECT a.username, b.noidung, b.ngaybl 
                   FROM khachhang1 a
                   INNER JOIN binhluan1 b ON a.makh = b.makh 
                   WHERE b.mahh = :mahh ORDER BY b.ngaybl DESC"; 
        $params = [':mahh' => $mahh];
        $result = $db->getList($select, $params); 
        return $result; 
    }

  
    function getEmail($email)
    {
        $db = new connect();
        $select = "SELECT * FROM khachhang1 WHERE email = :email";
        $params = [':email' => $email];
        $result = $db->getInstance($select, $params);
        return $result;
    }


    function updateEmail($emailold, $passnew) 
    {
        $db = new connect();
        $query = "UPDATE khachhang1 SET matkhau = :passnew WHERE email = :emailold";
        $params = [
            ':passnew' => $passnew,
            ':emailold' => $emailold
        ];
        $db->exec($query, $params);
    }


    function getUserByEmail($email)
    {
        $db = new connect();
        $select = "SELECT * FROM khachhang1 WHERE email = :email";
        $params = [':email' => $email];
        $result = $db->getInstance($select, $params);
        return $result; 
    }

   
    function addGoogleUser($tenkh, $email, $phone, $address)
    {
        $db = new connect();

       
        $existingUser = $this->getUserByEmail($email); 
        if ($existingUser) {
            error_log("addGoogleUser Info: User with email (".$email.") already exists. Returning existing ID: " . $existingUser['makh']);
            return $existingUser['makh']; 
        }

        
        $base_username = explode('@', $email)[0];
        $username = $base_username;
        $counter = 1;
        while (true) {
            $select_user = "SELECT makh FROM khachhang1 WHERE username = :username";
            $params_user = [':username' => $username];
            if (!$db->getInstance($select_user, $params_user)) {
                break; // Username is unique
            }
            
            $username = $base_username . $counter;
            $counter++;
             if ($counter > 100) { 
                 error_log("addGoogleUser Error: Could not generate unique username for base: " . $base_username);
                 return false;
             }
        }
        
        error_log("addGoogleUser Info: Generated username (".$username.") for email (".$email.")");

       
        $query = "INSERT INTO khachhang1 (makh, tenkh, username, matkhau, email, diachi, sodienthoai, vaitro) 
                  VALUES (NULL, :tenkh, :username, '', :email, :address, :phone, default)";

        $params = [
            ':tenkh' => $tenkh,
            ':username' => $username,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address
        ];

        try {
            $result = $db->exec($query, $params);
            if ($result) {
            
                $lastIdResult = $db->getInstance("SELECT LAST_INSERT_ID() as makh");
                 error_log("addGoogleUser Success: Added user (".$username.") with ID: " . ($lastIdResult ? $lastIdResult['makh'] : 'N/A'));
                return $lastIdResult ? $lastIdResult['makh'] : true;
            } else {
                 error_log("addGoogleUser Error: Database execution failed for username: " . $username);
                return false;
            }
        } catch (PDOException $e) {
            error_log("addGoogleUser PDOException for username (".$username."): " . $e->getMessage());
            return false;
        }
    }

  
    function registerUserFromCheckout($tenkh, $email, $diachi, $dt)
    {
        $db = new connect();

       
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser) {
            error_log("registerUserFromCheckout Info: User with email (".$email.") already exists. Returning existing ID: " . $existingUser['makh']);
            return $existingUser['makh'];
        }

        
        $base_username = explode('@', $email)[0];
        $username = $base_username;
        $counter = 1;
        while (true) {
            $select_user = "SELECT makh FROM khachhang1 WHERE username = :username";
            $params_user = [':username' => $username];
            if (!$db->getInstance($select_user, $params_user)) {
                break; // Username is unique
            }
            
            $username = $base_username . $counter;
            $counter++;
             if ($counter > 100) { 
                 error_log("registerUserFromCheckout Error: Could not generate unique username for base: " . $base_username);
                 return false;
             }
        }
        
        error_log("registerUserFromCheckout Info: Generated username (".$username.") for email (".$email.")");

        
        $query = "INSERT INTO khachhang1 (makh, tenkh, username, matkhau, email, diachi, sodienthoai, vaitro)
                  VALUES (NULL, :tenkh, :username, '', :email, :diachi, :dt, default)"; // Empty password
        $params = [
            ':tenkh' => $tenkh,
            ':username' => $username,
            ':email' => $email,
            ':diachi' => $diachi,
            ':dt' => $dt
        ];

        try {
             $result = $db->exec($query, $params);
             if ($result) {
                $lastIdResult = $db->getInstance("SELECT LAST_INSERT_ID() as makh");
                error_log("registerUserFromCheckout Success: Added user (".$username.") with ID: " . ($lastIdResult ? $lastIdResult['makh'] : 'N/A'));
                return $lastIdResult ? $lastIdResult['makh'] : true; // Return new ID or true
             } else {
                error_log("registerUserFromCheckout Error: DB exec failed for username: " . $username);
                return false;
             }
        } catch (PDOException $e) {
            error_log("registerUserFromCheckout PDOException for username (".$username."): " . $e->getMessage());
            return false;
        }
    }
}
