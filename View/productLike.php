<?php
// B1: tim tong so record( so san pham trong database hanghoa1)
$hh  = new hanghoa();
// $count = $hh -> getCountRecode() // 19
$result  = $hh->getHangHoaAll(); //$result la bang chua 19 sp
$count = $result->rowCount(); //19

// b2: cho limit tu cho dua vao thiet ke
$limit = 8;
$maloai = 0;
// b3: tinh ra so trang va start
$p = new page();
// tinh ra tong so trang
$page = $p->findPage($count, $limit); // 19,8 $page= 3
// lay ra start
$start = $p->findStart($limit); //8
//b4: thiet lap trang hien tai
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<?php
if ($act == "timkiem") {
    $ac = 1;
} else if ($act == 'filterproduct') {
    $ac = 2;
} else {
    $ac = 0;
}
?>


<!-- =============== Popular =============== -->
<section class="popular section" id="popular">
    <h2 class="section__title">Sushi Shop</h2>
    <span class="section__subtitle">The Like Food</span>



    <div class="popular__container container grid">

        <?php
        foreach ($_SESSION['pro_like'] as $key => $item) :
        ?>
            <article class="popular__card">
                <a href="index.php?action=sanpham&act=detail&id=<?php echo $item['mahh'] ?>">
                    <img src="<?php echo './Content/img/' . $item['hinh'] ?>" alt="" class="popular__img shop_img">

                    <h3 class="popular__name"><?php echo $item['tenhh']; ?></h3>
                    <span class="popular__description">Japanese Dish</span>

                    <span class="popular__price">$ <?php echo $item['dongia']; ?></span>
                </a>
                <button class="popular__button" onclick="location.href='index.php?action=listProduct_like&act=delete_item&id=<?php echo $item['mahh'] ?>'">
                    <i class="bx bxs-trash"> </i>
                </button>


            </article>
        <?php
        endforeach;
        ?>
    </div>


</section>