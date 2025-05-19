<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>社團企業媒合平台</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/fontawesome.css" />
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css" />
  <link rel="stylesheet" href="assets/css/owl.css" />
  <link rel="stylesheet" href="assets/css/animate.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <style>
    .custom-filter-btn {
      border: 2px solid #ff6600;
      background-color: white;
      color: #ff6600;
      border-radius: 25px;
      padding: 8px 20px;
      font-weight: 500;
      transition: 0.3s ease-in-out;
    }

    .custom-filter-btn:hover,
    .custom-filter-btn.active {
      background-color: #ff6600;
      color: #fff;
      text-decoration: none;
    }

    .properties-box {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: flex-start;
    }

    .properties-items {
      width: 30%;
      min-width: 300px;
    }

    @media (max-width: 992px) {
      .properties-items {
        width: 45%;
      }
    }

    @media (max-width: 600px) {
      .properties-items {
        width: 100%;
      }
    }
  </style>
</head>

<body>
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
                <li><a href="browse_cl.php" class="active">瀏覽</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="browse_en.php" class="active">瀏覽</a></li>
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
                <li><a href="self_cl.php">個人頁面</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="self_en.php">個人頁面</a></li>
              <?php endif; ?>
              <li><a href="logout.php">登出</a></li>
            </ul>
            <a class="menu-trigger"><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>社團瀏覽</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- 搜尋表單 -->

  <div class="contact-page section" style="align-item:center">
    <div class="container" style="margin-top: -50px; margin-right: 100px;">
      <form id="search-form" action="browse_cl.php" method="post" style="align-item:right;">
        <div class="row">
          <div class="col-md-2">
          </div>
          <div class="col-md-2">
            <label for="enterprise">企業名稱</label>
            <input class="form-control" type="text" placeholder="請輸入企業名稱" name="enterprise">
          </div>
          <div class="col-md-2">
            <label for="type">行業別</label>
            <select class="form-select" name="type">
              <option value="">請選擇</option>
              <option value="產業與工程類">產業與工程類</option>
              <option value="商業與物流類">商業與物流類</option>
              <option value="專業與金融服務">專業與金融服務</option>
              <option value="教育與公共機構">教育與公共機構</option>
              <option value="文化與創意產業">文化與創意產業</option>
              <option value="其他">其他</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="money">贊助範圍</label>
            <select name="money" class="form-select">
              <option value="">請選擇</option>
              <option value="$20,000以下">$20,000以下</option>
              <option value="$20,001-$30,000">$20,001-$30,000</option>
              <option value="$30,001-$50,000">$30,001-$50,000</option>
              <option value="$50,001-$70,000">$50,001-$70,000</option>
              <option value="$70,001以上">$70,001以上</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="support_type">企業贊助類型</label>
            <select name="support_type" class="form-select">
              <option value="">請選擇</option>
              <option value="金錢">金錢</option>
              <option value="物資">物資</option>
              <option value="場地">場地</option>
              <option value="提供實習">提供實習</option>
            </select>
          </div>

          <div class="col-md-2" style="margin-top: 24px;">
            <button class="btn btn-primary" type="submit"
              style="background-color:black; border: black;"><b>搜尋</b></button>
          </div>
        </div>
      </form>
    </div>
    <!-- </div> -->

    <?php
    $link = mysqli_connect('localhost', 'root', '', 'SAS');
    if (!$link) {
      die("資料庫連線失敗: " . mysqli_connect_error());
    }

    $money = isset($_POST['money']) ? mysqli_real_escape_string($link, $_POST['money']) : '';
    $enterprise = isset($_POST['enterprise']) ? mysqli_real_escape_string($link, $_POST['enterprise']) : '';
    $sponsorship = isset($_POST['$sponsorship']) ? mysqli_real_escape_string($link, $_POST['$sponsorship']) : '';
    $type = isset($_POST['type']) ? mysqli_real_escape_string($link, $_POST['type']) : '';

    $conditions = [];
    if (!empty($money)) {
      $conditions[] = "money LIKE '%$money%'";
    }
    if (!empty($enterprise)) {
      $conditions[] = "enterprise LIKE '%$enterprise%'";
    }
    if (!empty($sponsorship)) {
      $conditions[] = "type LIKE '%$sponsorship%'";
    }
    if (!empty($type)) {
      $conditions[] = "type LIKE '%$type%'";
    }

    $sql = "SELECT * FROM en_requirements";
    if (count($conditions) > 0) {
      $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $result = mysqli_query($link, $sql);
    ?>

    <div class="section properties">
      <div class="container">
        <div class="row properties-box">
          <?php
          if (mysqli_num_rows($result) == 0) {
            echo "<p>未找到符合的活動</p>";
          } else {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<div class='properties-items'>
                  <div class='item'>
                      <h4><a href='history.details_en.php?enrequirement_num={$row['enrequirement_num']}'>" . htmlspecialchars($row['title']) . "</a></h4>
                      <ul>
                        <li>企業名稱：<span>" . htmlspecialchars($row['enterprise']) . "</span></li>
                        <li>行業別：<span>" . htmlspecialchars($row['type']) . "</span></li>
                        <li>贊助範圍：<span>" . htmlspecialchars($row['money']) . "</span></li>
                        <li>企業贊助類型：<span>" . htmlspecialchars($row['sponsorship']) . "</span></li>
                      </ul>
                      <div class='main-button'>
                          <a href='history.details_en.php?enrequirement_num={$row['enrequirement_num']}'>了解活動詳情</a>
                      </div>
                  </div>
                </div>";
            }
          }
          ?>
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
</body>

</html>