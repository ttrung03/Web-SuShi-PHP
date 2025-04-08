<?php 
    class connect{
        // thuộc tính
        var $db = null ;

        // hàm tạo thực thi mặc định là cứ đối tượng thì nó sẽ
        // kế nối được với database
        public function __construct(){
            $dsn = 'mysql:host=localhost;dbname=the_sushi';
            $user = 'root';
            $pass = '';

            try {
                $this -> db = new PDO($dsn,$user,$pass,
                   array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            // echo 'Thành công';
            } catch (\Throwable $th) {
                //throw $th;
             echo 'Thất bại';
            }
        }

        // Phương thức thực thi cau truy vấn select trả về nhiều object
        public function getList($select, $params = []) {
            try {
                $stmt = $this->db->prepare($select);  // Chuẩn bị câu lệnh SQL
                $stmt->execute($params);  // Thực thi câu lệnh với tham số
                return $stmt;  // Trả về PDO statement
            } catch (PDOException $e) {
                echo "Lỗi truy vấn: " . $e->getMessage();
                return false;  // Nếu có lỗi, trả về false
            }
        }
        
        
        public function getInstance($select, $params = []) {
            try {
                // Chuẩn bị câu lệnh SQL
                $stmt = $this->db->prepare($select);  
                
                // Thực thi câu lệnh với tham số
                $stmt->execute($params);  
        
                // Lấy kết quả đầu tiên
                return $stmt->fetch(PDO::FETCH_ASSOC); 
            } catch (PDOException $e) {
                echo "Lỗi truy vấn: " . $e->getMessage();
                return false;  // Nếu có lỗi, trả về false
            }
        }
        
        
         //user 
         public function exec($query, $params = []) {
            try {
                $stmt = $this->db->prepare($query);
                $result = $stmt->execute($params); // ✅ Bây giờ dùng $params
                return $result;
            } catch (PDOException $e) {
                echo "Lỗi thực thi câu lệnh: " . $e->getMessage();
                return false;
            }
        }
}
