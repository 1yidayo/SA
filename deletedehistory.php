<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>社團企業媒合平台</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->

    <style>
        .properties-box {
      display: flex;
      flex-wrap: wrap; /* 允許換行 */
      gap: 10px; /* 設定間距 */
      justify-content: flex-start; /* 讓內容從左到右排列 */
  }

  .properties-items {
      width: 30%; /* 保持與原本大小相近 */
      min-width: 300px; /* 避免縮小過度 */
  }

  /* 讓小螢幕時調整排列 */
  @media (max-width: 992px) {
      .properties-items {
          width: 45%; /* 平板改為兩欄 */
      }
  }

  @media (max-width: 600px) {
      .properties-items {
          width: 100%; /* 手機版單欄 */
      }
  }

      /* 確保每個歷史紀錄框高度一致 */
      .uniform-box {
          min-height: 430px; /* 根據內容調整，讓每筆高度一致 */
          display: flex;
          flex-direction: column;
          justify-content: space-between;
      }

      /* 讓修改/刪除連結整齊排列 */
      .text-links {
          margin-top: 10px;
          text-align: right;
          font-size: 14px;
      }

      .text-links a {
          text-decoration: none;
          color: #333;
          margin: 0 5px;
      }

      .text-links a:hover {
          text-decoration: underline;
      }


    </style>


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
                    
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                            <li><a href="de.html" class="active">首頁</a></li>
                            <li><a href="properties4.php">瀏覽</a></li>
                            <li><a href="de_contact.php">發布</a></li>
                            <li><a href="dehistory.php">發布歷史</a></li>
                            <li><a href="self.de.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="aftersearchforde.php"><i class="fa fa-calendar"></i>進階搜尋</a>
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
   <?php
session_start();
$link = mysqli_connect("localhost", "root", "", "SAS");

// 檢查是否有傳入 clrequirement_num
if (isset($_GET['derequirement_num'])) {
    $num = intval($_GET['derequirement_num']);

    // 確保是自己的資料才能刪除
    $identityID = $_SESSION['identityID'];
    $sql = "DELETE FROM de_requirements WHERE derequirement_num = $num AND identityID = '$identityID'";

    if (mysqli_query($link, $sql)) {
        header("Location: dehistory.php");
        exit;
    } else {
        echo "刪除失敗：" . mysqli_error($link);
    }
} else {
    echo "未提供要刪除的資料編號";
}
?>






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