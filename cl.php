<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>社團企業媒合平台</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->



    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo
                          End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="cl.php" class="active">首頁</a></li>
                            <li><a href="properties2.php">瀏覽</a></li>
                            <li><a href="club contact.php">發布</a></li>
                            <li><a href="clubhistory.php">發布歷史</a></li>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="club_cooperations.php">我的合作</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="enterprise_cooperations.php">合作請求</a></li>
                            <?php endif; ?>
                            <li><a href="self.cl.php">個人頁面</a></li>
                            <li><a href="aftersearchforclub.php">進階搜尋</a></li>
                            <li><a href="login.html">登出</a></li>
                            

                            <!-- 顯示頭像 -->
                            <?php
                            session_start();
                            $pic = isset($_SESSION['clpicture']) && $_SESSION['clpicture'] !== ''
                                ? 'uploads/' . $_SESSION['clpicture']
                                : 'uploads/default-profile.png';
                            ?>
                            <li>
                                <a href="self.cl.php">
                                    <img src="<?= $pic ?>" alt="頭像"
                                        style="width: 40px; height: 40px; border-radius: 50%;">
                                </a>
                            </li>
                        </ul>

                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="main-banner"
        style="background-image: url('https://themewagon.github.io/Sailor/assets/img/hero-carousel/hero-carousel-2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; height: 100vh; display: flex; align-items: center; justify-content: center; filter: brightness(1.1) contrast(1.2); margin-bottom: 0;">
        <div class="header-text text-center">
            <h2 style="color: white; font-size: 3rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Welcome!</h2>
        </div>
    </div>

    <style>
        footer {
            margin-top: 0;
            padding-top: 0;
        }
    </style>

    <footer>
        <div class="container">
            <div class="col-lg-8">
                <p style="text-align: left; font-weight: bold;">社團企業媒合平台</p>
            </div>
        </div>
    </footer>



    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>