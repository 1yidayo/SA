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

  <title>Villa Agency - Property Listing by TemplateMo</title>

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
  <style>
    .properties-box {
      display: flex;
      flex-wrap: wrap;
      /* 允許換行 */
      gap: 20px;
      /* 設定間距 */
      justify-content: flex-start;
      /* 讓內容從左到右排列 */
    }

    .properties-items {
      width: 30%;
      /* 保持與原本大小相近 */
      min-width: 300px;
      /* 避免縮小過度 */
    }

    .properties-items .item {
      background-color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .properties-items {
      width: 30%;
      min-width: 300px;
      margin-bottom: 20px;
      /* 每張卡底部加間距 */
    }

    .properties-box {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      /* 控制卡片間的左右間距 */
      justify-content: flex-start;
    }



    /* 讓小螢幕時調整排列 */
    @media (max-width: 992px) {
      .properties-items {
        width: 45%;
        /* 平板改為兩欄 */
      }
    }

    @media (max-width: 600px) {
      .properties-items {
        width: 100%;
        /* 手機版單欄 */
      }
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
            <!-- ***** Logo Start ***** -->

            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="index_cl.php" class="active">首頁</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="index_en.php" class="active">首頁</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="browse_cl.php" class="active">瀏覽</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="browse_en.php" class="active">瀏覽</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post_cl.php" class="active">發布</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post_en.php" class="active">發布</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post.history_cl.php" class="active">發布歷史</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post.history_en.php" class="active">發布歷史</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="cooperations_cl.php" class="active">我的合作</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="cooperations_en.php" class="active">我的合作</a></li>
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
          <h3>社團進階搜尋相關企業</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="contact-page section">
    <div class="container">
      <div class="row">

        <div class="col-lg-10" style="margin:auto">
          <form id="contact-form" action="aftersearchforhistory.details_cl.php" method="post">
            <div class="row g-5">
              <div class="col-4">
                <label for="school">贊助範圍</label>
                <select name="money" id="money" class="form-control">
                  <option value="">請選擇</option>
                  <option value="$20,000以下">$20,000以下</option>
                  <option value="$20,001-$30,000">$20,001-$30,000</option>
                  <option value="$30,001-$50,000">$30,001-$50,000</option>
                  <option value="$50,001-$70,000">$50,001-$70,000</option>
                  <option value="$70,001以上">$70,001以上</option>
                </select>
              </div>
              <div class="col-4">
                <label for="school">企業名稱</label>
                <input class="form-control" type="text" placeholder="請輸入企業名稱" aria-label="Enter a City or Airport"
                  name="enterprise">
              </div>
              <div class="col-4">
                <label for="support_type">企業發展類型</label>
                <select name="support_type" id="support_type" class="form-control">
                  <option value="">請選擇</option>
                  <option value="金錢">金錢</option>
                  <option value="物資">物資</option>
                  <option value="場地">場地</option>
                  <option value="提供實習">提供實習</option>
                </select>
              </div>

              <div class="col-12">
                <button class="btn btn-light w-100 py-1" type="submit"><b>搜尋</b></button>
              </div>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
      <div class="row properties-box">
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv">
          <?php
          $link = mysqli_connect('localhost', 'root', '', 'SAS');

          if (!$link) {
            die("Database connection failed: " . mysqli_connect_error());
          }

          // 正確取得 POST 變數
          $money = isset($_POST['money']) ? mysqli_real_escape_string($link, $_POST['money']) : '';
          $enterprise = isset($_POST['enterprise']) ? mysqli_real_escape_string($link, $_POST['enterprise']) : '';

          // 動態產生 WHERE 條件
          $conditions = array();

          if (!empty($money)) {
            $conditions[] = "money LIKE '%$money%'";
          }
          if (!empty($enterprise)) {
            $conditions[] = "enterprise LIKE '%$enterprise%'";
          }

          // 建構完整 SQL
          $sql = "SELECT * FROM en_requirements";
          if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
          }

          $result = mysqli_query($link, $sql);
          if (!$result) {
            die("Query failed: " . mysqli_error($link));
          }

          if (mysqli_num_rows($result) == 0) {
            echo "<p>未找到符合的活動</p>";
          }

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='properties-items'>
        <div class='item'>
            <h4><a href='history.details_en.php?enrequirement_num=" . $row['enrequirement_num'] . "'>" . $row['title'] . "</a></h4>
            <ul>
                <li><span>" . $row['enterprise'] . "</span></li>
                <li>贊助範圍：<span>" . $row['money'] . "</span></li>
                <li>企業發展類型：<span>" . $row['type'] . "</span></li>
            </ul>
            <div class='main-button'>
                <a href='history.details_en.php?enrequirement_num=" . $row['enrequirement_num'] . "'>了解活動詳情</a>
            </div>
        </div>
        </div>";

          }
          ?>
        </div>
      </div>
      <div class="row">
      </div>
    </div>
  </div>

  <!-- Footer -->
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