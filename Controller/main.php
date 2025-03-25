<main class="main" id="main">
    <!-- =============== Home =============== -->
    <section class="home section" id="home">
        <div class="home__container container grid">
            <img src="./Content/img/home-sushi-rolls.png" alt="home image" class="home__img">
            <div class="home__data">
                <h1 class="home__title">
                    Enjoy Delicious
                    <div>
                        <img src="./Content/img/home-sushi-title.png" alt="home image">
                        SuShi Food
                    </div>
                </h1>

                <p class="home__description">
                    Enjoy a good dinner with the best dishes in the restaurant and improve your day.
                </p>

                <a href="index.php?action=sanpham" class="button">
                    Order Now <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>
        </div>

        <img src="./Content/img/leaf-branch-2.png" alt="" class="home__leaft-1">
        <img src="./Content/img/leaf-branch-4.png" alt="" class="home__leaft-2">
    </section>

    <!-- =============== About =============== -->
    <section class="about section" id="about">
        <div class="about__container container grid">
            <div class="about__data">
                <span class="section__subtitle">About Us</span>
                <h2 class="section__title about_title">
                    <div>
                        We Provide
                        <img src="./Content/img/about-sushi-title.png" alt="about image">
                    </div>

                    Healthy Food
                </h2>

                <p class="about__description">
                    With CSS animations when scrolling. Includes a light and dark mode. And website deployment to
                    the internet. Developed first with the Mobile First methodology, then for desktop.
                </p>
            </div>

            <img src="./Content/img/about-sushi.png" alt="about image" class="about__img">
        </div>
        <img src="./Content/img/leaf-branch-1.png" alt="" class="about__leaf">
    </section>

    <!-- =============== Popular =============== -->
    <section class="popular section" id="popular">
        <span class="section__subtitle">The Best Food</span>
        <h2 class="section__title">Popular Dishes</h2>

        <div class="popular__container container grid">
            <article class="popular__card">
                <img src="./Content/img/popular-onigiri.png" alt="" class="popular__img">

                <h3 class="popular__name">Onigiri</h3>
                <span class="popular__description">Japanese Dish</span>

                <span class="popular__price">$10.99</span>

                <button class="popular__button" onclick="location.href='index.php?action=sanpham'">
                   <i class='bx bx-cart'></i>
                </button>
            </article>

            <article class="popular__card">
                <img src="./Content/img/popular-spring-rols.png" alt="" class="popular__img">

                <h3 class="popular__name">Spring Rolls</h3>
                <span class="popular__description">Japanese Dish</span>

                <span class="popular__price">$15.99</span>

                <button class="popular__button" onclick="location.href='index.php?action=sanpham'">
                   <i class='bx bx-cart'></i>
                </button>
            </article>

            <article class="popular__card">
                <img src="./Content/img/popular-sushi-rolls.png" alt="" class="popular__img">

                <h3 class="popular__name">Sushi Rolls</h3>
                <span class="popular__description">Japanese Dish</span>

                <span class="popular__price">$19.99</span>

                <button class="popular__button" onclick="location.href='index.php?action=sanpham'">
                   <i class='bx bx-cart'></i>
                </button>
            </article>

            <article class="popular__card">
                <img src="./Content/img/recently-salmon-sushi.png" alt="" class="popular__img">

                <h3 class="popular__name">Salmon Sushi</h3>
                <span class="popular__description">Japanese Dish</span>

                <span class="popular__price">$17.99</span>

                <button class="popular__button" onclick="location.href='index.php?action=sanpham'">
                   <i class='bx bx-cart'></i>
                </button>
            </article>
        </div>
        <div class="btn-popular">
            <a href="index.php?action=sanpham" class="button ">
                Order Now <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>
    </section>

    <!-- =============== Recently =============== -->
    <section class="recently section" id="recently">
        <div class="recently__container container grid">
            <div class="recently__data">
                <span class="section__subtitle">Recently Added</span>
                <h2 class="section__title">Sushi Samurai <br>
                    Salmon Cheese
                </h2>

                <p class="recently__description">
                    Take a look at what's new . Anddo not deprive yourself of a good meal, enjoy and be happy
                </p>

                <a href="index.php?action=sanpham" class="button">
                    Order Now <i class='bx bx-right-arrow-alt'></i>
                </a>
                <img src="./Content/img/spinach-leaf.png" alt="recently image" class="recently__data-img">
            </div>

            <img src="./Content/img/recently-salmon-sushi.png" alt="recently image" class="recently__img">
        </div>

        <img src="./Content/img/leaf-branch-2.png" alt="" class="recently__leaf-1">
        <img src="./Content/img/leaf-branch-3.png" alt="" class="recently__leaf-2">
    </section>

    <!-- =============== Newsletter =============== -->
    <section class="newsletter section">
        <div class="newsletter__container container ">
            <div class="newsletter__content grid">
                <img src="./Content/img/newsletter-sushi.png" alt="newsletter image" class="newsletter__img">

                <div class="newsletter__data">
                    <span class="section__subtitle">Newsletter</span>
                    <h2 class="section__title">
                        Subscribe For <br>
                        Offer Updates
                    </h2>

                    <form action="" class="newsletter__form">
                        <input type="email" placeholder="Enter Email" id="" class="newsletter__input">

                        <button class="button newsletter__button">
                            Subscribe <i class='bx bx-mail-send'></i>
                        </button>
                    </form>
                </div>
            </div>

            <img src="./Content/img/spinach-leaf.png" alt="newsletter image" class="newsletter__spinach">
        </div>
    </section>
</main>