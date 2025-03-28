<?php
class listProduct_like
{
    function add_item($key)
    {
        echo $key;
        $prod = new hanghoa();
        $pros = $prod->getHangHoaId($key);
        $hinh = $pros["hinh"];
        $ten = $pros["tenhh"];
        $cost = $pros["dongia"];
        $maloai = $pros["maloai"];
        // tạo 1 đối tượng, kiểu array
        $item = array(
            'mahh' => $key,
            'hinh' => $hinh,
            'tenhh' => $ten,
            'dongia' => $cost,
            'maloai' => $maloai,
        );


        $_SESSION['pro_like'][] = $item;
    }
    function delete_items($key)
    {
        unset($_SESSION['pro_like'][$key]);
    }
}
