<?php
$act = "thongke";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
    switch ($act) {
        case 'thongke':
            $option = '';
            $day = '';
            $month = '';
            $year = '';
            $quarter = '';

            if (isset($_POST['optionTK'])) {
                $option = $_POST['optionTK'];
            }

            if (isset($_POST['dateTK'])) {
                $dateTK = $_POST['dateTK'];
                $date = date_create($dateTK);
            }


            if ($option == 1) {
                $day = date_format($date, "d"); // format ngày
                $month = date_format($date, "m"); // format tháng
                $year = date_format($date, "Y"); // format năm
            }

            else if ($option == 2) {
                $month = $_POST['month'];
                $year = $_POST['year'];
            }

            else if ($option == 3) {
                $quarter = $_POST['quarter'];
                $year = $_POST['year'];
            }

            include './View/thongke.php';
            break;
    }

