<?php
class hanghoa
{
    //thuộc tính
    // hàm tạo

    function __construct()
    {
    }
    // Lấy dữ liệu từ database về để  View lấy nó và hiện thị lên
    // pt lấy ra 12 sản phẩm mới nhất

    function getHangHoaNew()
    {
        //b1: kết nối với database
        $db =  new connect();
        $select = "select *  from hanghoa ORDER by mahh desc LIMIT 12";
        $result = $db->getList($select);
        return $result;
    }

    function getHangHoaSale()
    {
        //b1: kết nối với database
        $db =  new connect();
        $select = "select *  from hanghoa where giamgia > 0 LIMIT 4";
        $result = $db->getList($select);
        return $result;
    }

    function getHangHoaAll()
    {
        //b1: kết nối với database
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
    function getHangHoaLoai($maloai)
    {
        $db = new connect();
        $select = "select DISTINCT hinh from hanghoa where maloai= $maloai LIMIT 4";
        $result = $db->getList($select);
        return $result; //Kết quả trả về 
    }
    function getLoai()
    {
        $db =  new connect();
        $select = "select DISTINCT maloai  from hanghoa";
        $result = $db->getList($select);
        return $result;
    }
    function getTenLoai($maloai)
    {
        $db = new connect();
        $select = "select DISTINCT tenloai from loai where maloai= $maloai";
        $result = $db->getInstance($select);
        return $result; //Kết quả trả về 
    }

    // phan trang
    function getHangHoaAllPage($start, $limit)
    {
        //b1: kết nối với database
        $db =  new connect();
        $select = "select * from hanghoa limit $start, $limit";
        $result = $db->getList($select);
        return $result;
    }

    // tìm kiếm
    function getTimKiem($timkiem)
    {
        $db = new connect();
        $select = "select * from hanghoa where tenhh like '%$timkiem%' ";
        $result = $db->getList($select);
        return $result;
    }

    function getFilterProduct($ValueFilter, $ValueFilterType)
    {
        $db = new connect();
        switch ($ValueFilter) {
            case 'name_up':
                $select = "select * from hanghoa ORDER by tenhh asc ";
                break;

            case 'name_down':
                $select = "select * from hanghoa ORDER by tenhh desc ";
                break;

            case 'price_up':
                $select = "select * from hanghoa ORDER by dongia asc ";
                break;

            case 'price_down':
                $select = "select * from hanghoa ORDER by dongia desc ";
                break;
            case 1:
                break;
            default:
                $select = "select * from hanghoa where maloai = $ValueFilterType";
                break;
        }

        $result = $db->getList($select);
        return $result; //Kết quả trả về 
    }
    function getFilterProductPage($ValueFilter, $start, $limit)
    {
        $db = new connect();
        if ($ValueFilter == 'name_up') {
            $select = "select * from hanghoa ORDER by tenhh asc limit  $start, $limit";
        } else if ($ValueFilter == 'name_down') {
            $select = "select * from hanghoa ORDER by tenhh desc limit $start, $limit";
        } else if ($ValueFilter == 'price_up') {
            $select = "select * from hanghoa ORDER by dongia asc limit $start, $limit";
        } else {
            $select = "select * from hanghoa ORDER by dongia desc limit $start, $limit";
        }

        $result = $db->getList($select);
        return $result; //Kết quả trả về 
    }
}
