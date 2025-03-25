<?php 
    class connect{
        // thuộc tính
        var $db = null ;

        // hàm tạo thực thi mặc định là cứ đối tượng thì nó sẽ
        // kế nối được với database
        public function __construct(){
            $dsn = 'mysql:host=localhost;dbname=demo_sushi';
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
        public function getList($select){
            $result = $this ->db -> query($select);
            return $result;
        }
        
        public function getInstance($select){
            $result=$this->db->query($select);
            $result= $result->fetch(); // chính là 1 array
            return $result;
        }
        
         //user 
         public function exec ($query) {
            $result= $this ->db-> exec($query);
            return $result;
        }
    }
