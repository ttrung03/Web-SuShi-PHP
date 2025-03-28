<?php
class page
{
    // pt tinh so trang
    function findPage($count, $limit)
    {
        //19%8 =3 khac 0 lay floor(19/8= 2+1)
        $page = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit);
        return $page;
    }

    // viet pt tim start
    // current_page la trang hien tai dua vao URL = ..../sanpham&page=2

    function findStart($limit)
    {
        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $start =  0;
            $_GET['page'] = 1;
        } else {
            $start = ($_GET['page'] - 1) * $limit;
        }
        return $start; //8
    }
}
