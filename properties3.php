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
  <!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->

  <style>
    .text-links {
      margin-top: 10px;
      text-align: right;
      font-size: 14px;
    }

    .publish-time {
      margin-top: 10px;
      font-size: 14px;
      text-align: right;
      color: #666;
    }

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

            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="ai.html">首頁</a></li>
              <li><a href="properties3.php" class="active">瀏覽</a></li>
              <li><a href="alumni contact.php">發布</a></li>
              <li><a href="aihistory.php">發布歷史</a></li>
              <li><a href="self.ai.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for ai.php">進階搜尋</a>
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
          <h3>系學會活動</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
  <div class="container">
    <?php
$filter = $_GET['filter'] ?? '提供實習';  // 預設只顯示提供實習
$support_type = ['提供實習'];

function buildFilterUrl($support_type)
{
  return '?filter=' . urlencode($support_type);
}
?>

<form method="get" class="mb-3 text-center">
  <input type="text" name="keyword" placeholder="搜尋學校或科系" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" />
  <input type="hidden" name="filter" value="<?= htmlspecialchars($_GET['filter'] ?? '提供實習') ?>" />
  <button type="submit" class="btn btn-primary">搜尋</button>
</form>


<div class="text-center mb-4">
  <?php foreach ($support_type as $support): ?>
    <a href="<?= buildFilterUrl($support) ?>"
      class="btn custom-filter-btn mx-1 <?= $filter === $support ? 'active' : '' ?>"><?= $support ?></a>
  <?php endforeach; ?>
</div>

<div class="row properties-box">
  <?php
$link = mysqli_connect('localhost', 'root', '', 'SAS');

$filter = $_GET['filter'] ?? '提供實習';
$filter_escaped = mysqli_real_escape_string($link, $filter);
$keyword = $_GET['keyword'] ?? '';
$keyword_escaped = mysqli_real_escape_string($link, $keyword);

$query = "SELECT 
            de_requirements.*, 
            identity.deschool, 
            identity.dename 
          FROM 
            de_requirements 
          JOIN 
            identity 
          ON 
            de_requirements.identityID = identity.identityID
          WHERE 
            de_requirements.support_type = '$filter_escaped'";

// 如果有關鍵字就加條件
if (!empty($keyword_escaped)) {
    $query .= " AND (identity.deschool LIKE '%$keyword_escaped%' OR identity.dename LIKE '%$keyword_escaped%')";
}

$result = mysqli_query($link, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // 在這裡使用 $row['derequirement_num'] 生成連結
        $link_href = "de.php?derequirement_num=" . urlencode($row['derequirement_num']);
        echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items'>
          <div class='item uniform-box'>
            <h4><a href='#'>" . htmlspecialchars($row['title']) . "</a></h4>
            <ul>
              <li><span>" . htmlspecialchars($row['deschool']) . "</span></li>
              <li><span>" . htmlspecialchars($row['dename']) . "</span></li>
              <br>
              <li>預估規模：<span>" . htmlspecialchars($row['people']) . "</span></li>
              <br>
              <li>需要贊助的類型：<span>" . htmlspecialchars($row['support_type']) . "</span></li>
              <br>
            </ul>
            <div class='main-button'>
              <a href='$link_href'>了解詳情</a>
            </div><br>
            <p class='publish-time'>發布時間：<span>" . htmlspecialchars($row['created_time']) . "</span></p>
          </div>
        </div>";
    }
} else {
    echo "<p>沒有資料。</p>";
}
?>

</div>

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