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
        $query = "insert into hoadon1(masohd, makh, ngaydat,tongtien)
        values(Null,$makh,'$ngay',0)";
        $db->exec($query);
        $seclect = "select masohd from hoadon1 order by masohd desc limit 1";
        $mahd = $db->getInstance($seclect);
        return $mahd[0];
    }

    //phuong thuc insert vao bang cthoadon
    function insertOderDetail($mahd, $mah, $solung, $maloai, $thanhtien)
    {
        $db = new connect();
        $query = "insert into cthoadon1(masohd,mahh,soluongmua,maloai,thanhtien,tinhtrang)
        values($mahd,$mah,$solung, $maloai, $thanhtien,0)";
        $db->exec($query);
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
        echo $mahh, $soluong;
        $db = new connect();
        $query = "UPDATE hanghoa 
        SET soluongton = CASE 
                            WHEN (soluongton - $soluong) < 0 THEN 0 
                            ELSE 0
                        END, 
            tinhtrang = CASE 
                            WHEN soluongton <= 0 THEN 1 
                            ELSE 
                                CASE 
                                    WHEN soluongton > 0 THEN 0 
                                    ELSE tinhtrang 
                                END 
                        END 
        WHERE mahh = $mahh;
        ";
        $db->exec($query);
    }

    // pt lay thong tin tu bang hoadon va khachhang
    function getOrder($sohd)
    {
        $db = new connect();
        $select = "select  a.masohd, b.tenkh, a.ngaydat, b.sodienthoai, b.diachi from hoadon1 a inner join khachhang1 b on a.makh = b.makh where a.masohd = $sohd";

        $result = $db->getInstance($select);
        return $result;
    }

    // pt lay thong tin tu bang hoadon va khachhang
    function getOrderDetail($sohd)
    {
        $db = new connect();
        $select = "select  b.tenhh, a.maloai, a.soluongmua, b.dongia from cthoadon1 a inner join hanghoa b on a.mahh = b.mahh where a.masohd = $sohd";

        $result = $db->getList($select);
        return $result;
    }
}
