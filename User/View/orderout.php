
<?php
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) :
    echo '<script> alert("Giỏ hàng của bạn chưa có sản phẩm nào...");</script>';
    include "sanpham.php";
?>
<?php
else :
?>
    <section class=" popular section">
        <div class="cart-container ">
            <div class="main flex">
                <form action="index.php?action=orderout&act=orderout_action" method="post" class="form" id="form-1">
                    <h3 class="heading">Thông tin gửi hàng</h3>
                    <p class="desc">Hãy tiếp tục ủng hộ shop nhé ❤️</p>

                    <div class="spacer"></div>

                    <div class="form-group">
                        <label for="fullname+" class="form-label">Tên đầy đủ</label>
                        <input id="fullname" name="txttenkh" type="text" placeholder="VD: Sơn Đặng" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Số điện thoại</label>
                        <input id="phone_number" name="txtsodt" type="text" placeholder="VD: 0913457951" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input id="address" name="txtdiachi" type="text" placeholder="Nhập địa chỉ" class="form-control">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="txtemail" type="text" placeholder="VD: email@domain.com" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <!-- Buy Button -->
                    <div class="flex cart-buy">
                        <button class="form-submit">Xác nhận thanh toán</button>
                    </div>
                </form>
                <div class="user_pro">
                    <form method="post" action="index.php?action=giohang&act=update_item" class="cart-container " id="cart-container">
                        <div class="cart-title section__title">Your Cart</div>

                        <!-- Content -->
                        <div class="cart-content ">
                            <?php
                            $j = 0;
                            foreach ($_SESSION['cart'] as $key => $item) :
                                $j++;
                            ?>

                                <div class="cart-box grid">
                                    <a href="index.php?action=sanpham&act=detail&id=<?php echo $item['mahh']; ?>">
                                        <img src="<?php echo $item['hinh'] ?>" alt="" class="cart-img">
                                    </a>

                                    <div class="cart-detail grid ">
                                        <p id="cart-title" class="popular__name"><?php echo $item['name']; ?></p>
                                        <p id="cart-price" class="popular__price">$ <?php echo $item['dongia']; ?></p>
                                        <input type="number" class="cart-quantity" type="number" name="newqty[<?php echo $key; ?>]" value="<?php echo $item['soluong'] ?>" ?>
                                    </div>

                                    <!-- Remove -->
                                    <div class="cart-icon">
                                        <i class="cart-remove bx bxs-trash" onclick="location.href='index.php?action=giohang&act=delete_item&id=<?php echo $key ?>'"> </i>
                                        <!-- onclick="location.href='index.php?action=giohang&act=update_item'" -->
                                        <button type="submit" class='cart-edit'><i class=' cart-edit bx bxs-edit'></i></button>
                                    </div>
                                </div>

                            <?php
                            endforeach;
                            ?>
                        </div>


                        <!-- Total -->
                        <div class="total flex ">

                            <p class="total-title popular__name">Total:</p>
                            <span class="total-price popular__price ">
                                <?php
                                $gh = new GioHang();
                                echo  $gh->getTotal();
                                ?>
                                $</span>
                        </div>


                    </form>

                <?php
            endif;
                ?>
                </div>
            </div>
        </div>

    </section>