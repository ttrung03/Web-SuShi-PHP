<?php
require_once "./config/vnpay_config.php";

$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = [];
foreach ($_GET as $key => $value) {
    if ($key != "vnp_SecureHash" && $key != "vnp_SecureHashType") {
        $inputData[$key] = $value;
    }
}

ksort($inputData);
$hashData = "";
$i = 0;
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

if ($secureHash === $vnp_SecureHash) {
    if ($_GET['vnp_ResponseCode'] == '00') {
        // ✅ THANH TOÁN THÀNH CÔNG

        // 👉 Gọi model để lưu đơn hàng nếu cần
        // $model = new PaymentModel();
        // $model->saveOrder(...);

        // ✅ Gán thông tin đơn hàng vào SESSION nếu muốn in ra
        $_SESSION['order_info'] = [
            'order_id' => $_GET['vnp_TxnRef'],
            'amount' => $_GET['vnp_Amount'] / 100,
            'payment_time' => $_GET['vnp_PayDate'],
            'bank' => $_GET['vnp_BankCode'],
        ];

        // ➡️ Chuyển hướng sang trang hiển thị hóa đơn
        header("Location: index.php?action=orderout");
        exit;
    } else {
        echo "❌ Giao dịch không thành công.";
    }
} else {
    echo "❌ Chữ ký không hợp lệ.";
}
