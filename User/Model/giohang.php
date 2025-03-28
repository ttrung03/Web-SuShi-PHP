<?php
class giohang
{
    function add_item($key, $quantity)
    {
        $prod = new hanghoa();
        $pros = $prod->getHangHoaId($key);
        $hinh = $pros["hinh"];
        $ten = $pros["tenhh"];
        $maloai = $pros["maloai"];
        $cost = $pros["dongia"];
        $total = $quantity * $cost;
        // tạo 1 đối tượng, kiểu array
        $item = array(
            'mahh' => $key,
            'hinh' => $hinh,
            'name' => $ten,
            'maloai' => $maloai,
            'soluong' => $quantity,
            'dongia' => $cost,
            'total' => $total,
        );

        // đưa đối tượng vào trong session['cart]
        $_SESSION['cart'][] = $item;
        //a[]=$item

    }

    function getTotal()
    {
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['total'];
        }
        return number_format($subtotal, 2);
    }
    function delete_items($key)
    {
        unset($_SESSION['cart'][$key]);
    }

    function update_items($key, $quanity)
    {
        if ($quanity <= 0) {
            $this->delete_items($key);
        } else {
            $_SESSION['cart'][$key]['soluong'] = $quanity;
            $total_new = $_SESSION['cart'][$key]['soluong'] * $_SESSION['cart'][$key]['dongia'];
            $_SESSION['cart'][$key]['total'] = $total_new;
        }
    }
}
