<section class="about section" id="about">

    <div class="about__container container grid">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $dt = new hanghoa();
            $results = $dt->getHangHoaId($id);
            $mahh = $results['mahh'];
            $tenhh = $results['tenhh'];
            $dongia = $results['dongia'];
            $hinh = $results['hinh'];
            $mota = $results['mota'];
            $maloai = $results['maloai'];
            $soluongton = $results['soluongton'];
            $tinhtrang = $results['tinhtrang'];
            $tloai = $dt->getTenLoai($maloai);
            $tenloai = $tloai['tenloai'];
            $nhom = $results['Nhom'];
        }
        ?>
        <form action="index.php?action=giohang" method="post" class="about__data detail-data">
            <input type="hidden" name="mahh" value="<?php echo $mahh ?>" />
            <span class="section__subtitle detail_subtitle"><?php echo (!$tinhtrang) ? 'Còn hàng' : 'Hết hàng' ?></span>
            <h2 class="section__title detail_title"><?php echo $tenhh ?></h2>

            <span class="popular__price">$<?php echo number_format($dongia) ?>.0</span>

            <h3 class="detail-desc-title">Loại: <?php echo  $tenloai ?> </h3>

            <input type="number" id="soluong" name="soluong" min="1" max="100" value="1" size="10" class="product_quantity">

            <div class="about__description detail-desc">
                <h4 class="detail-desc-title">Description: </h4>
                <?php echo $mota ?>
            </div>

            <button class="button" type="submit" id="product-buy" <?php echo (!$tinhtrang ? '' : 'disabled') ?>>Add To Cart</button>
        </form>

        <div class="detail_product-img">
            <img src="<?php echo './Content/img/' . $hinh ?>" alt="about image" class="about__img">
            <div class="small_product-img flex">
                <?php
                $result = $dt->getHangHoaLoai($maloai);
                while ($set = $result->fetch()) {
                ?>
                    <div class="product_img-item">
                        <img src="<?php echo './Content/img/' . $set['hinh'] ?>" alt="about image">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <img src="./Content/img/leaf-branch-1.png" alt="" class="about__leaf">
</section>
