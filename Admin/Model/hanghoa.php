<?php
class hanghoa
{
    public function __construct()
    {
    }

    function getHangHoaAll()
    {
        $db =  new connect();
        $select = "select *  from hanghoa";
        $result = $db->getList($select);
        return $result;
    }

    function getHangHoaId($id)
    {
        $db = new connect();
        $select = "select * from hanghoa where mahh = $id";
        $result = $db->getInstance($select);
        return $result; //Kết quả trả về 
    }

    function getLoai()
    {
        $db = new connect();
        $select = "select * from loai";
        $result = $db->getList($select);
        return $result;
    }

    function updatesp($id, $tenhh, $dongia, $giamgia, $hinh, $Nhom, $maloai, $soluotxem, $ngaylap, $mota, $soluongton, $tinhtrang)
    {
        $db = new connect();
        $query = "update hanghoa set tenhh='$tenhh', dongia=$dongia, giamgia=$giamgia, hinh='$hinh', Nhom=0, maloai=$maloai, soluotxem=$soluotxem, ngaylap='$ngaylap', mota='$mota', soluongton=$soluongton,tinhtrang=$tinhtrang where mahh=$id";
        $db->exec($query);
    }

    function insertHangHoa($tenhh, $dongia, $giamgia, $hinh, $Nhom, $maloai,  $soluotxem, $ngaylap, $mota, $soluongton)
    {
        $db = new connect();
        $query = "insert into hanghoa (mahh , tenhh, dongia, giamgia, hinh, Nhom, maloai,  soluotxem, ngaylap, mota, soluongton,tinhtrang)
        values(NULL, '$tenhh', $dongia, $giamgia, '$hinh', 0, $maloai, $soluotxem, '$ngaylap',' $mota', $soluongton,0)";

        $db->exec($query);
    }

    function DeleteHangHoa($id)
    {
        $db = new connect();
        $query = "delete from hanghoa where mahh = $id";
        $db->exec($query);
    }

    // phương thức thống kê số lượng hàng đã bán 
    function getThongKeMatHang($option, $day, $month, $year, $quarter)
    {
        $db = new connect();

        // if ($choose == 'thongkengay') {
        //     $select = "SELECT c.ngaydat,b.tenhh, sum(a.soluongmua) as soluong
        //     FROM cthoadon1 a, hanghoa b, hoadon1 c
        //     WHERE a.mahh=b.mahh and c.masohd=a.masohd
        //     and day (c.ngaydat)=$day and month (c.ngaydat)=$month and year (c.ngaydat)=$year GROUP by b.tenhh, c.ngaydat;";
        //     $result = $db->getList($select);
        // } else if ($choose == 'thongkequy') {
        //     $select = "SELECT c.ngaydat,b.tenhh, sum(a.soluongmua) as soluong FROM cthoadon1 a, hanghoa b, hoadon1 c WHERE a.mahh=b.mahh and c.masohd=a.masohd and quarter (c.ngaydat)=$quarter and year (c.ngaydat)=$year GROUP by b.tenhh, c.ngaydat;";
        //     $result = $db->getList($select);
        // } else {
        //     $select = "SELECT b.tenhh,sum(a.soluongmua) as soluong FROM cthoadon1 a, hanghoa b WHERE a.mahh=b.mahh GROUP by b.tenhh";
        //     $result = $db->getList($select);
        // }
        if ($option == 1) {
            $select = "SELECT c.ngaydat,b.tenhh, sum(a.soluongmua) as soluong FROM cthoadon1 a, hanghoa b, hoadon1 c WHERE a.mahh=b.mahh and c.masohd=a.masohd and day (c.ngaydat)= $day and month (c.ngaydat)= $month and year (c.ngaydat)= $year GROUP by b.tenhh, c.ngaydat;";
            $result = $db->getList($select);
        } else if ($option == 2) {
            $select = "SELECT c.ngaydat,b.tenhh, sum(a.soluongmua) as soluong FROM cthoadon1 a, hanghoa b, hoadon1 c WHERE a.mahh=b.mahh and c.masohd=a.masohd and month (c.ngaydat)= $month and year (c.ngaydat)= $year GROUP by b.tenhh, c.ngaydat;";
            $result = $db->getList($select);
        } else if ($option == 3) {
            $select = "SELECT c.ngaydat,b.tenhh, sum(a.soluongmua) as soluong FROM cthoadon1 a, hanghoa b, hoadon1 c WHERE a.mahh=b.mahh and c.masohd=a.masohd and quarter (c.ngaydat)=$quarter and year (c.ngaydat)=$year GROUP by b.tenhh, c.ngaydat;";
            $result = $db->getList($select);
        } else {
            $select = "SELECT b.tenhh, sum(a.soluongmua) as soluong FROM cthoadon1 a, hanghoa b WHERE a.mahh = b.mahh GROUP by b.tenhh";
            $result = $db->getList($select);
        }
        return $result;
    }
}
