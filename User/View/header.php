<header class="header" id="header">
    <nav class="nav container">
        <a href="index.php#" class="nav__logo">
            <img src="./Content/img/logo.png" alt="logo image">SuShi
        </a>
        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list ">
                <li class="nav__item">
                    <a href="index.php?action=main" class="nav__link active-link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="index.php#about" class="nav__link">About Us</a>
                </li>
                <li class="nav__item">
                    <a href="index.php#popular" class="nav__link">Popular</a>
                </li>
                <li class="nav__item">
                    <a href="index.php#recently" class="nav__link">Recently</a>
                </li>
            </ul>

            <!-- Close button -->
            <div class="nav__close" id="nav-close">
                <i class='bx bx-x'></i>
            </div>

            <img src="./Content/img/leaf-branch-4.png" alt="" class="nav__img-1">
            <img src="./Content/img/leaf-branch-3.png" alt="" class="nav__img-2">
        </div>

        <div class="nav__buttons">

            <i class='bx bx-shopping-bag' id="cart-button" onclick="location.href='index.php?action=giohang'"></i>

            <?php
            if (isset($_SESSION['makh']) && isset($_SESSION['tenkh'])) :
                $name = $_SESSION['tenkh'];
            ?>
                <a href="index.php?action=dangnhap&act=logout" class="login nav__link">Đăng xuất</a>
                <span><?php echo "Xin chào !" . $name; ?></span>
            <?php
            else :
                echo '<a href="index.php?action=dangnhap" class="login nav__link">Login</a>
                ';
            ?>
            <?php
            endif;
            ?>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>
        </div>
    </nav>
</header>

<?php
