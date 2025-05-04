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
                            <li><a href="advanced search for department society.html"><i class="fa fa-calendar"></i>進階搜尋</a>
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

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <!-- <span class="breadcrumb"><a href="#">首頁</a> / 社團活動</span> -->
          <h3>我的發布歷史</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">;
    <div class="container">
      <div class="row properties-box">
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv">
    <?php


        $link = mysqli_connect('localhost', 'root', '', 'SAS');
        $sql = "SELECT * FROM club_requirements WHERE identityID = '{$_SESSION['identityID']}' ORDER BY created_at DESC";


        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='properties-items'>
                <div class='item uniform-box'>
                    <h4><a href='de.php?clrequirement_num=" . $row['clrequirement_num'] . "'>" . $row['title'] . "</a></h4>
                    <ul>
                        <li><span>" . $row['school'] . "</span></li>
                        <li><span>" . $row['club'] . "</span></li>
                        <br>
                        <li>預估規模：<span>" . $row['people'] . "</span></li>
                        <br>
                        <li>預算範圍：<span>" . $row['money'] . "</span></li>
                        <br>
                        
                    </ul>
                    <div class='text-links'>
                        <a href='de.php?clrequirement_num=" . $row['clrequirement_num'] . "' class='btn btn-info btn-sm'>詳情</a>
                        <a href='editdehistory.php?clrequirement_num=" . $row['clrequirement_num'] . "'>修改</a> |
                        <a href='deletedehistory.php?clrequirement_num=" . $row['clrequirement_num'] . "' onclick=\"return confirm('確定要刪除嗎？');\">刪除</a>
                    </div>
                    <li>發布時間：<span>" . $row['created_time'] . "</span></li>

                </div>
            </div>";
        }

    ?>
</div>

        </div>
      <div class="row">
        <!-- <div class="col-lg-12">
          <ul class="pagination">
            <li><a href="#">1</a></li>
            <li><a class="is_active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">>></a></li>
          </ul>
        </div> -->
      </div>
    </div>
  </div>

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