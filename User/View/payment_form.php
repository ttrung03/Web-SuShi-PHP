<?php
$usd_amount = $_GET['amount'] ?? 8;
$vnd_amount = round($usd_amount * 24000); // Tỷ giá tạm tính
?>

<section class="section" style="padding: 40px 0;">
    <h2 class="section__title" style="text-align: center; margin-top: 40px">Thông tin thanh toán qua VNPAY</h2>

    <form action="index.php?action=payment&act=create" method="post"
          style="max-width: 400px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

        <!-- Hiển thị USD -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Số tiền bạn sẽ thanh toán:</label>
            <input type="text" value="<?= '$' . number_format($usd_amount, 2) ?>" disabled
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f8f8f8;">
        </div>

        <!-- Gửi số tiền VND (ẩn) -->
        <input type="hidden" name="amount" value="<?= $vnd_amount ?>" />

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Chọn ngân hàng:</label>
            <select name="bank_code"
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="">Chuyển đến trang thanh toán</option>
                <option value="NCB">Thanh toán nhanh bằng Ngân hàng NCB</option>
            </select>
        </div>

        <div style="font-size: 14px; color: gray; margin-bottom: 10px;">
            💡 Hệ thống sẽ tự động quy đổi <strong>$<?= $usd_amount ?></strong> thành <strong><?= number_format($vnd_amount) ?> VND</strong> khi thanh toán qua VNPAY.
        </div>

        <button type="submit" class="button card-btn"
                style="width: 100%; padding: 12px; font-size: 16px;">
            Tiếp tục thanh toán
        </button>
    </form>
</section>
