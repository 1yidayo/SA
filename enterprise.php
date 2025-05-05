<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <title>社團企業媒合平台</title>

  <!-- CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>
  <!-- Preloader -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots"><span></span><span></span><span></span></div>
    </div>
  </div>

  <!-- Header -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="en.html" class="active">首頁</a></li>
              <li><a href="properties.php">瀏覽</a></li>
              <li><a href="en_contact.php">發布</a></li>
              <li><a href="enhistory.php">發布歷史</a></li>
              <li><a href="self.en.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for enterprise.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul> 
            <a class="menu-trigger"><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Heading -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>贊助需求詳情</h3>
        </div>
      </div>
    </div>
  </div>

  <?php
  $enrequirement_num = $_GET['enrequirement_num'];

  $link = mysqli_connect('localhost', 'root', '', 'SAS');
  $sql = "SELECT * FROM en_requirements WHERE enrequirement_num = '$enrequirement_num'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>

  <!-- Main Content -->
  <div class="single-property section">
    <div class="container">
      <div class="row">

        <!-- Left Side: Title & Description -->
        <div class="col-lg-8">
          <div class="main-content">
            <h2 class="mb-3"><?= $row['title'] ?></h2>
            <div style="display: flex; align-items: center; gap: 10px;">

</div>
<br>
            <strong><h10>贊助需求內文：</h10></strong>
            <p><?= $row['information'] ?></p>
          </div>
        </div>
        
        
        <!-- Right Side: Info Table -->
        <div class="col-lg-4">
          <div class="info-table">
            <ul>
              <li>
                <h4>贊助類型<br><span><?= $row['sponsorship'] ?></span></h4>
              </li>

              <?php if ($row['sponsorship'] === '金錢'): ?>
              <li>
                <h4>贊助範圍<br><span><?= $row['money'] ?? '未填寫' ?></span></h4>
              </li>
              <?php endif; ?>
              <li>
                <h4>企業名稱<br><span><?= $row['enterprise'] ?></span></h4>
              </li>
              <li>
                <h4>企業行業別<br><span><?= $row['type'] ?></span></h4>
              </li>
              <li>
                <h4>企業統一編號<br><span><?= $row['code'] ?></span></h4>
              </li>
              <li>
                <h4>企業聯絡方式<br><span><?= $row['enins'] ?></span></h4>
              </li>
              <li>
                <h4>活動地區<br><span><?= $row['region'] ?></span></h4>
              </li>
              <li>
                <h4>預計活動時間<br><span><?= $row['date'] ?></span></h4>
              </li>
              <li>
                <h4>可提供贊助類型<br><span><?= $row['sponsorship'] ?></span></h4>
              </li>
              <li>
                <h4>希望社團達到目的<br><span><?= $row['hope'] ?></span></h4>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <br><br><br>

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
