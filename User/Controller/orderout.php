<?php
$act = 'orderout';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'orderout':
        error_log("Orderout controller - sohd in session: " . (isset($_SESSION['sohd']) ? $_SESSION['sohd'] : 'Not set'));
        
        // Make sure we have an order ID
        if (!isset($_SESSION['sohd'])) {
            echo "<h3 style='color:red; text-align:center'>Không tìm thấy thông tin hóa đơn!</h3>";
            include './View/sanpham.php';
        } else {
            // Load the order view to display details
            include './View/order.php';
        }
        break;

    case 'orderout_action':
        // when user submits checkout form with details
        if (isset($_POST['txttenkh']) && isset($_POST['txtemail'])) { // Added check for txtemail
            $tenkh = trim($_POST['txttenkh']);
            $diachi = trim($_POST['txtdiachi']);
            $sodt = trim($_POST['txtsodt']);
            $email = trim($_POST['txtemail']); // Get email from POST
            // $username = $_POST['txtusername']; // Username not typically submitted here
            
            // Validate inputs
            if (empty($tenkh) || empty($diachi) || empty($sodt) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 echo '<script> alert("Vui lòng điền đầy đủ và đúng định dạng thông tin.");</script>';
                 include './View/orderout.php'; // Show form again
                 exit;
            }
            
            // Controller requests model to insert/get user for checkout
            $ur = new user();
            // Call the new method specifically for checkout registration
            $makh = $ur->registerUserFromCheckout($tenkh, $email, $diachi, $sodt);

            if ($makh !== false) {
                 // User exists or was created, $makh holds their ID
                 // Important: Associate this order with the user ID ($makh)
                 // This logic might need adjustment depending on how orders are finalized
                if (isset($_SESSION['sohd'])) {
                     error_log("Orderout Action: Associating order (".$_SESSION['sohd'].") with user ID (".$makh.")");
                    // Example: $hd = new hoadon(); $hd->updateOrderUser($_SESSION['sohd'], $makh);
                    // If using a guest checkout flow, this might just be for record keeping
                } else {
                    error_log("Orderout Action Warning: No order ID (sohd) in session to associate with user (".$makh.")");
                }
                
                echo '<script> alert("Thông tin đã được ghi nhận. Đơn hàng đang được xử lý.");</script>';
                // Redirect to a final confirmation/thank you page or order view
                 include './View/order.php'; // Show order details
                 // Or maybe redirect: echo '<script>window.location.href="/Web-SuShi-PHP/User/index.php?action=thankyou";</script>';
                exit;
            } else {
                 // Error message logged in model
                echo '<script> alert("Có lỗi xảy ra khi xử lý thông tin. Vui lòng thử lại.");</script>';
                include './View/orderout.php';
                 exit;
            }
        } else {
             // Handle cases where required POST data is missing
             echo '<script> alert("Vui lòng điền đầy đủ thông tin.");</script>';
             include './View/orderout.php';
             exit;
        }
        break;

    default:
        # code...
        break;
}
