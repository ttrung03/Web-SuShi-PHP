<?php
session_start();
include "./PHPMailer/src/PHPMailer.php";
include "./PHPMailer/src/SMTP.php";
require 'vendor/autoload.php';

set_include_path(get_include_path() . PATH_SEPARATOR . 'Model/'); // dang ky duong nhan voi model
spl_autoload_extensions('.php'); //lay do co ten .php 
spl_autoload_register();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- =============== Favicon =============== -->
    <link rel="shortcut icon" href="./Content/img/favicon.png" type="image/x-icon">

    <!-- =============== Boxicons =============== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- =============== Css =============== -->
    <link rel="stylesheet" href="./Content/css/style.css">

    <title>Sushi Website</title>
</head>

<body>

    <!-- =============== Header =============== -->
    <?php
    include_once './View/header.php';

    ?>
    <!-- =============== Main =============== -->
    <?php

$ctrl = 'main';
if (isset($_GET['action'])) {
    $tmp = $_GET['action'];
    
    // Kiểm tra file controller tồn tại trước khi include
    if (file_exists('./Controller/' . $tmp . '.php')) {
        $ctrl = $tmp;
    } else {
        $ctrl = 'main'; // fallback nếu không có controller tương ứng
    }
}
include('./Controller/' . $ctrl . '.php');

    ?>

    <!-- =============== Footer =============== -->
    <?php
    include_once './View/footer.php';

    ?>

    <!-- =============== JavaScript =============== -->
    <script src="./Content/js/scrollreveal.min.js"></script>
    <script src="./Content/js/main.js"></script>

</body>

</html>