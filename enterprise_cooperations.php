<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'sas');
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>合作請求 | 社團企業媒合平台</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <style>
    .card-body h5 {
      color: #ff6600;
      font-weight: 600;
    }
    .btn {
      margin-right: 8px;
    }
  </style>
</head>

<body>

  <!-- ***** Preloader ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots"><span></span><span></span><span></span></div>
    </div>
  </div>

  <!-- ***** Header ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="en.html">首頁</a></li>
              <li><a href="properties.php">瀏覽</a></li>
              <li><a href="en_contact.php">發布</a></li>
              <li><a href="enhistory.php">發布歷史</a></li>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="club_cooperations.php">我的合作</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="enterprise_cooperations.php" class="active">合作請求</a></li>
              <?php endif; ?>
              <li><a href="self.en.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for enterprise.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul>
            <a class='menu-trigger'><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- ***** Page Title ***** -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>合作請求</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** 內容區塊 ***** -->
  <div class="section">
    <div class="container">
      <h4 class="mb-4">📩 等待審核的合作申請</h4>

      <?php
      $enterprise_identityID = $_SESSION['identityID'];

      $sql = "SELECT cr.*, cl.school, cl.club, cl.clins, er.title
              FROM cooperation_requests cr
              JOIN identity cl ON cr.club_identityID = cl.identityID
              JOIN en_requirements er ON cr.enrequirement_num = er.enrequirement_num
              WHERE cr.enterprise_identityID = '$enterprise_identityID' 
                AND cr.status = '待處理'
              ORDER BY cr.request_time DESC";

      $result = mysqli_query($link, $sql);

      if (mysqli_num_rows($result) === 0) {
        echo "<p class='text-muted'>目前沒有新的合作申請。</p>";
      }

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card mb-3 shadow-sm'>
                <div class='card-body'>
                  <h5>活動：{$row['title']}</h5>
                  <p>社團名稱：{$row['school']} {$row['club']}</p>
                  <p>社團 IG：<a href='https://instagram.com/{$row['clins']}' target='_blank'>@{$row['clins']}</a></p>
                  <p>申請時間：{$row['request_time']}</p>
                  <form method='POST' action='handle_cooperation.php' class='mt-2'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button name='action' value='accept' class='btn btn-success'>同意</button>
                    <button name='action' value='reject' class='btn btn-danger'>拒絕</button>
                  </form>
                </div>
              </div>";
      }
      ?>
    </div>
  </div>

  <!-- ***** Footer ***** -->
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
