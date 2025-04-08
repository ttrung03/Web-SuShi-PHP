
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

        <!-- onclick="location.href='index.php?action=giohang'" -->
        <!-- href="index.php?action=sanpham&act=cart" -->
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

    <?php
    if (isset($_SESSION['makh'])) {
    ?>
        <div class="comment_container">
            <div class="comment_content">
                <form class="comment_content" action="index.php?action=sanpham&act=comment&id=<?php echo $id ?>" method="post">
                    <input type="hidden" name="txtmahh" value="<?php echo $mahh ?>" />
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="comment_avatar">
                    <textarea type="text" name="comment" class="comment" rows="2" cols="70" placeholder="Xuân đi để lại lá vàng,người xem để muôn ngàn bình luận"></textarea>
                    <button class="button comment_btn">Bình luận</button>
                </form>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="comment_container">
        <div class="comment_content">
        <?php if (isset($_SESSION['makh'])) { ?>
            <form class="comment_content" action="index.php?action=sanpham&act=comment&id=<?php echo $id ?>" method="post">

                <input type="hidden" name="txtmahh" value="<?php echo $mahh ?>" />
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="comment_avatar">
                <textarea type="text" name="comment" class="comment" rows="2" cols="70" placeholder="Xuân đi để lại lá vàng,người xem để muôn ngàn bình luận"></textarea>
                <button class="button comment_btn">Bình luận</button>
            </form>
        <?php } else { ?>
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="comment_avatar">
            <h4>Mời bạn đăng nhập để bình luận</h4>
        <?php } ?>
    </div>
        </div>
    <?php


    }
    ?>
   <div class="area-comment bg-white ">
    <?php
    if (isset($_GET['id'])) {
        $mahh = $_GET['id'];
        $usr = new user();
        $sum = $usr->getCountComment($mahh);  // Lấy số lượng bình luận
    }
    ?>
    <h6>
        <b>Toàn bộ bình luận <?php echo $sum; ?></b>
    </h6>

    <?php
    if ($sum > 0) {
        $result = $usr->getNoiDungComment($mahh);  // Lấy các bình luận
        foreach ($result as $set) {
    ?>
            <div class="p-1 flex input-comment">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="comment_avatar">
                <div class="bg-dark text-light area-info-comment">
                    <p><b><a href="#" class="text-danger"><?php echo htmlspecialchars($set['username']); ?></a> <br> <?php echo $set['ngaybl'] ?> </b><br>
                    </p>
                </div>
                <div class="area-text-comment text-light bg-dark scroll">
                    <p><?php echo htmlspecialchars($set['noidung']); ?></p>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<h6 class="text-center">Chưa có bình luận nào !!</h6>';
    }
    ?>
</div>
</section>