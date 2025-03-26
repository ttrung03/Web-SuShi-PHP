<?php
class hoadon
{
    function getHoadon()
    {
        $db = new connect();
        $select = 'select * from hoadon1';
        $result = $db->getList($select);
        return $result; //Kết quả trả về 
    }

    function getChitiethoadon($sohd)
    {
        $db = new connect();
        $select = "SELECT a.masohd, b.tenkh, a.ngaydat, b.sodienthoai, b.diachi, a.tongtien from hoadon1 a
        INNER JOIN khachhang1 b on a.makh = b.makh WHERE a.masohd = $sohd";
        $result = $db->getInstance($select);
        return $result; //Kết quả trả về 
    }
    
    function getOrderDetail($sohd){
        $db = new connect();
        $select="SELECT b.tenhh, b.hinh, a.soluongmua, b.dongia from cthoadon1 a
        INNER JOIN hanghoa b on a.mahh = b.mahh WHERE a.masohd=$sohd";
        $result=$db->getList($select);
        return $result;

    }
}
