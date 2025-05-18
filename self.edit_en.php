<?php
session_start();
?>
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

    <style>
    .btn-check:checked + .btn-outline-dark {
        background-color: #eba04f !important;
        border-color: #eba04f !important;
        color: white !important;
    }
</style>

</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span><span></span><span></span>
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
                        <ul class="nav">
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="index_cl.php">首頁</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="index_en.php">首頁</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="browse_cl.php">瀏覽</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="browse_en.php">瀏覽</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="post_cl.php">發布</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="post_en.php">發布</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="post.history_cl.php">發布歷史</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="post.history_en.php">發布歷史</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="cooperations_cl.php">我的合作</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="cooperations_en.php">我的合作</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="self_cl.php" class="active">個人頁面</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="self_en.php" class="active">個人頁面</a></li>
                            <?php endif; ?>
                            <li><a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登出</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="breadcrumb"><a href="#">Home</a> / My Page</span>
                    <h3>企業個人頁面</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">

        <h2 class="mb-4">修改您的個人檔案</h2>
    </div>
<?php

$userID = $_SESSION['userID'];
$link = mysqli_connect('localhost', 'root', '', 'SAS');
$sql = "SELECT * FROM identity WHERE userID = '$userID'";
$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    // 將資料庫 enprefer 欄位字串拆成陣列
    $collabArr = array();
    if (!empty($row['enprefer'])) {
        $collabArr = array_map('trim', explode(',', $row['enprefer']));
    }

    // 判斷 checkbox 是否勾選的函式
    function isChecked($value, $array) {
        return in_array($value, $array) ? "checked" : "";
    }

    echo "<div class='contact-page section' style='margin-top: 20px;'>
    <div class='row'>
        <div class='col-lg-6' style='margin:auto'>
            <form id='contact-form' action='en_edit.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3'>
                    <label for='enterprise' class='form-label'><b>企業名稱：</b></label>
                    <input class='form-control' name='enterprise' value='" . $row['enterprise'] . "' readonly>
                </div>
                <div class='mb-3'>
                    <label for='entype' class='form-label'><b>行業別：</b></label>
                    <input class='form-control' name='entype' value='" . $row['entype'] . "' readonly>
                </div>
                <div class='mb-3'>
                    <label for='code' class='form-label'><b>統一編號</b></label>
                    <input type='text' class='form-control' name='code' id='code' value='" . $row['code'] . "' readonly>
                </div>
                <div class='mb-3'>
                    <label for='enplace' class='form-label'><b>企業所在地區</b></label>
                    <input type='text' class='form-control' name='enplace' id='enplace' value='" . $row['enplace'] . "' required>
                </div>
                <div class='mb-3'>
                    <label for='enperson' class='form-label'><b>負責人姓名與職稱</b></label>
                    <input type='text' class='form-control' name='enperson' id='enperson' value='" . $row['enperson'] . "' required>
                </div>
                <div class='mb-3'>
                    <label for='enphone' class='form-label'><b>Email／聯絡電話</b></label>
                    <input type='text' class='form-control' name='enphone' id='enphone' value='" . $row['enphone'] . "' required>
                </div>
                <div class='mb-3'>
                    <label for='enins' class='form-label'><b>社群連結</b></label>
                    <input type='text' class='form-control' name='enins' id='enins' value='" . $row['enins'] . "' required>
                </div>
                <div class='mb-3'>
                    <label for='enperson' class='form-label'><b>負責人姓名與職稱</b></label>
                    <input type='text' class='form-control' name='enperson' id='enperson' value='" . $row['enperson'] . "' required>
                </div>
                <div class='mb-3'>
                    <label class='form-label'><b>合作偏好類型</b></label><br>
                    <div class='btn-group flex-wrap' role='group' aria-label='Checkbox group' style='display: flex; gap: 6px;' name='enprefer'>
                        <input type='checkbox' class='btn-check' id='skill' name='collab[]' value='學術性社團' " . isChecked('學術性社團', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='skill'>學術性社團</label>

                        <input type='checkbox' class='btn-check' id='leisure' name='collab[]' value='休閒聯誼性社團' " . isChecked('休閒聯誼性社團', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='leisure'>休閒聯誼性社團</label>

                        <input type='checkbox' class='btn-check' id='services' name='collab[]' value='服務性社團' " . isChecked('服務性社團', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='services'>服務性社團</label>

                        <input type='checkbox' class='btn-check' id='physical' name='collab[]' value='體能性社團' " . isChecked('體能性社團', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='physical'>體能性社團</label>

                        <input type='checkbox' class='btn-check' id='arts' name='collab[]' value='藝術性社團' " . isChecked('藝術性社團', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='arts'>藝術性社團</label>

                        <input type='checkbox' class='btn-check' id='music' name='collab[]' value='音樂性社團' " . isChecked('音樂性社團', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='music'>音樂性社團</label>

                        <input type='checkbox' class='btn-check' id='events' name='collab[]' value='學生活動／迎新／大型晚會' " . isChecked('學生活動／迎新／大型晚會', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='events'>學生活動／迎新／大型晚會</label>

                        <input type='checkbox' class='btn-check' id='competition' name='collab[]' value='公開比賽／競賽活動' " . isChecked('公開比賽／競賽活動', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='competition'>公開比賽／競賽活動</label>

                        <input type='checkbox' class='btn-check' id='marketing' name='collab[]' value='社群經營／行銷類社團' " . isChecked('社群經營／行銷類社團', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='marketing'>社群經營／行銷類社團</label>

                        <input type='checkbox' class='btn-check' id='no_preference' name='collab[]' value='沒有特定偏好' " . isChecked('沒有特定偏好', $collabArr) . ">
                        <label class='btn btn-outline-dark btn-sm' for='no_preference'>沒有特定偏好</label>
                    </div>
                </div>

                <button class='btn btn-dark w-100' type='submit'><b>儲存修改</b></button>
            </form>
        </div>
    </div>
</div>";
}
?>



    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="col-lg-8">
                <p style="text-align: left; font-weight: bold;">社團企業媒合平台</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>