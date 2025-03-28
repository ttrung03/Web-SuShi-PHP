<!-- Cart box -->
<section class=" popular section">
    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) :
        echo '<script> alert("Giỏ hàng của bạn chưa có sản phẩm nào...");</script>';
        include "sanpham.php";
    ?>
    <?php
    else :
    ?>
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

            <!-- Buy Button -->
            <div class="flex cart-buy">
                <a class="button card-btn" href='index.php?action=order'> Buy Now </a>
            </div>
        </form>

    <?php
    endif;
    ?>

</section>