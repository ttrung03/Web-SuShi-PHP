<?php
class hoadon
{
    public function __construct()
    {
    }
    //phuong thuc insert vao database hoa don
    function insertOrder($makh)
    {
        $date = new DateTime('now');
        $ngay = $date->format('Y-m-d');
        $db = new connect();
        $query = "INSERT INTO hoadon1 (masohd, makh, ngaydat, tongtien)
                  VALUES (NULL, :makh, :ngay, 0)";  // Sử dụng :makh và :ngay
     
        $params = [':makh' => $makh, ':ngay' => $ngay];  // Truyền tham số đúng cách
        $db->exec($query, $params);  // Thực thi câu lệnh
     
        // Lấy mã hóa đơn mới nhất
        $seclect = "SELECT masohd FROM hoadon1 ORDER BY masohd DESC LIMIT 1";
        $mahd = $db->getInstance($seclect);
        return $mahd['masohd'];  // Trả về mã hóa đơn
    }
    
    
    

    //phuong thuc insert vao bang cthoadon
    function insertOderDetail($mahd, $mah, $soluong, $maloai, $thanhtien)
    {
        $db = new connect();
        $query = "INSERT INTO cthoadon1 (masohd, mahh, soluongmua, maloai, thanhtien, tinhtrang) 
                  VALUES (:mahd, :mahh, :solung, :maloai, :thanhtien, 0)";
        
        $params = [
            ':mahd' => $mahd,
            ':mahh' => $mah,
            ':soluong' => $soluong,  // Lưu đúng số lượng
            ':maloai' => $maloai,
            ':thanhtien' => $thanhtien
        ];
        $db->exec($query, $params);  // Thực thi câu lệnh
    }
    
    
    

    // cap nhat lai tông tiên
    function updateOder($sohd, $tongtien)
    {
        $db = new connect();
        $query = "update hoadon1 set tongtien=$tongtien where masohd=$sohd";
        $db->exec($query);
    }

    // cap nhat lai soluong
    function updateQuantity($mahh, $soluong)
    {
        $db = new connect();
        $query = "UPDATE hanghoa 
                  SET soluongton = CASE 
                                     WHEN (soluongton - :soluong) < 0 THEN 0 
                                     ELSE soluongton - :soluong 
                                   END, 
                      tinhtrang = CASE 
                                     WHEN soluongton <= 0 THEN 1 
                                     ELSE 0 
                                   END
                  WHERE mahh = :mahh";  // Sử dụng tham số đúng
     
        $params = [':soluong' => $soluong, ':mahh' => $mahh];  // Truyền tham số đúng
        $db->exec($query, $params);  // Thực thi câu lệnh
    }
    
    

    // pt lay thong tin tu bang hoadon va khachhang
    function getOrder($sohd)
    {
        $db = new connect();
        $select = "SELECT a.masohd, b.tenkh, a.ngaydat, b.sodienthoai, b.diachi 
                   FROM hoadon1 a 
                   INNER JOIN khachhang1 b ON a.makh = b.makh 
                   WHERE a.masohd = :sohd";  // Sử dụng tham số :sohd
    
        $params = [':sohd' => $sohd];  // Truyền tham số vào câu lệnh SQL
    
        // Thực thi câu lệnh SQL và trả về kết quả
        return $db->getInstance($select, $params);
    }
    

    // pt lay thong tin tu bang hoadon va khachhang
    function getOrderDetail($sohd)
    {
        $db = new connect();
        $select = "SELECT b.tenhh, a.maloai, a.soluongmua, b.dongia 
                   FROM cthoadon1 a 
                   INNER JOIN hanghoa b ON a.mahh = b.mahh 
                   WHERE a.masohd = :sohd";  // Thêm tham số :sohd
    
        $params = [':sohd' => $sohd];  // Truyền tham số vào câu lệnh SQL
    
        // Trả về PDO statement thay vì mảng
        $stmt = $db->getList($select, $params);  
        return $stmt;  // Trả về đối tượng PDO statement
    }
    
    
}