<?php
session_start();
include "./PHPMailer/src/PHPMailer.php";
include "./PHPMailer/src/SMTP.php";
require 'vendor/autoload.php';

set_include_path(get_include_path() . PATH_SEPARATOR . 'Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Content/img/favicon.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./Content/css/style.css">
    <title>Sushi Website</title>
</head>

<body>

    <!-- =============== Header =============== -->
    <?php include_once './View/header.php'; ?>

    <!-- =============== Main =============== -->
    <?php
    $action = $_GET['action'] ?? 'main';
    $act = $_GET['act'] ?? '';

    // Các action đặc biệt như VNPAY xử lý riêng
    if ($action === 'payment') {
        include_once './Controller/PaymentController.php';
        $controller = new PaymentController();
        if ($act === 'create') {
            $controller->createPayment();
        }
    } elseif ($action === 'payment_form') {
        include_once './View/payment_form.php';
    } elseif ($action === 'return') {
        include_once './return.php';
    } else {
        // Mặc định: xử lý như MVC ban đầu
        $ctrl = $action;
        include('./Controller/' . $ctrl . '.php');
    }
    ?>

    <!-- =============== Footer =============== -->
    <?php include_once './View/footer.php'; ?>

    <!-- =============== JavaScript =============== -->
    <script src="./Content/js/scrollreveal.min.js"></script>
    <script src="./Content/js/main.js"></script>

</body>

</html>
