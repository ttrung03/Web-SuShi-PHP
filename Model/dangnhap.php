<?php
class dangnhap
{
    function __construct()
    {
    }

    function loginAdmin($username, $password)
    {
        $db = new connect();
        $select = "select * from admin where user='$username' and password='$password'";
        $result = $db->getInstance($select);
        return $result;
    }
    function UpdatePass($user, $passnew)
    {
        $db = new connect();
        $query = "update admin set password='$passnew' where user='$user'";

        $db->exec($query);
    }
}
