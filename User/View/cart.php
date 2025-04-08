<!-- Cart box -->
<section class="popular section">
    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) :
        echo '<script> alert("Giỏ hàng của bạn chưa có sản phẩm nào...");</script>';
        include "sanpham.php";
    else :
    ?>
        <!-- Form CẬP NHẬT giỏ hàng -->
        <form method="post" action="index.php?action=giohang&act=update_item" class="cart-container" id="cart-container">
            <div class="cart-title section__title">Your Cart</div>

            <!-- Content -->
            <div class="cart-content">
                <?php
                $j = 0;
                foreach ($_SESSION['cart'] as $key => $item) :
                    $j++;
                    $dt = new hanghoa();
                    $productDetails = $dt->getHangHoaId($item['mahh']);
                    $hinh = $productDetails['hinh'];
                ?>
                    <div class="cart-box grid">
                        <a href="index.php?action=sanpham&act=detail&id=<?php echo $item['mahh']; ?>">
                            <img src="<?php echo './Content/img/' . $hinh; ?>" alt="" class="cart-img">
                        </a>

                        <div class="cart-detail grid">
                            <p id="cart-title" class="popular__name"><?php echo $item['name']; ?></p>
                            <p id="cart-price" class="popular__price">$ <?php echo $item['dongia']; ?></p>
                            <input type="number" class="cart-quantity" name="newqty[<?php echo $key; ?>]" value="<?php echo $item['soluong'] ?>" />
                        </div>

                        <div class="cart-icon">
                            <i class="cart-remove bx bxs-trash" onclick="location.href='index.php?action=giohang&act=delete_item&id=<?php echo $key ?>'"> </i>
                            <button type="submit" class='cart-edit'><i class='cart-edit bx bxs-edit'></i></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Total -->
            <div class="total flex">
                <p class="total-title popular__name">Total:</p>
                <span class="total-price popular__price">
                    <?php
                    $gh = new GioHang();
                    $total_price = $gh->getTotal();
                    echo $total_price;
                    ?> $
                </span>
            </div>

            <!-- Buy Button (trong form giỏ hàng) -->
            <div class="flex cart-buy">
                <a class="button card-btn" href='index.php?action=order'> Thanh toán tiền mặt </a>
            </div>
        </form>

        <!-- FORM THANH TOÁN VNPAY (ngoài form giỏ hàng) -->
        <div class="flex cart-buy" style="justify-content: center; margin-top: 20px;">
            <form action="index.php" method="get" style="display: inline-block;">
                <input type="hidden" name="action" value="payment_form" />
                <input type="hidden" name="amount" value="<?= $total_price ?>" />
                <button type="submit" class="button card-btn" style="padding: 10px 20px; font-size: 16px;">
                    Thanh toán qua VNPAY
                </button>
            </form>
        </div>

    <?php endif; ?>
</section>
