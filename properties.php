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
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="index_cl.php">首頁</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="index_en.php">首頁</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="browse_cl.php" class="active">瀏覽</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="properties.php" class="active">瀏覽</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post_cl.php">發布</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="en_contact.php">發布</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post.history_cl.php">發布歷史</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="enhistory.php">發布歷史</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="cooperations_cl.php">我的合作</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="enterprise_cooperations.php">我的合作</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="self_cl.php">個人頁面</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="self_en.php">個人頁面</a></li>
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
          <h3>企業瀏覽</h3>
        </div>
      </div>
    </div>
  </div>

  <d class="contact-page section" style="align-item:center">
    <div class="container" style="margin-top: 50px; margin-left: 150px;">
      <form id="search-form" action="properties.php" method="post" style="align-item:right;">
        <div class="row">
          <!-- <div class="col-md-3">
          </div> -->
          <div class="col-md-3">
            <label for="school">學校</label>
            <input class="form-control" type="text" placeholder="請輸入學校名稱" name="school">
          </div>
          <div class="col-md-3">
            <label for="school">社團</label>
            <input class="form-control" type="text" placeholder="請輸入社團名稱" name="club">
          </div>
          <div class="col-md-3">
            <label for="support_type">贊助類型</label>
            <select name="support_type" id="support_type" class="form-select">
              <option value="">請選擇</option>
              <option value="金錢">金錢</option>
              <option value="物資">物資</option>
              <option value="場地">場地</option>
              <option value="提供實習">提供實習</option>
            </select>
          </div>

          <div class="col-md-3" style="margin-top: 24px;">
            <button class="btn btn-primary" type="submit"
              style="background-color:black; border: black;"><b>搜尋</b></button>
          </div>
        </div>
      </form>
    </div>
    <!-- 
    <div class="section properties">
      <div class="container">
        <div class="row properties-box">
          <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv"> -->
    <?php
    $link = mysqli_connect('localhost', 'root', '', 'SAS');

    if (!$link) {
      die("Database connection failed: " . mysqli_connect_error());
    }

    // 取得搜尋表單的輸入
    $school = isset($_POST['school']) ? mysqli_real_escape_string($link, $_POST['school']) : '';
    $club = isset($_POST['club']) ? mysqli_real_escape_string($link, $_POST['club']) : '';
    $support_type = isset($_POST['support_type']) ? mysqli_real_escape_string($link, $_POST['support_type']) : '';

    // 動態產生 WHERE 條件
    $conditions = array();

    if (!empty($school)) {
      $conditions[] = "school LIKE '%$school%'";
    }
    if (!empty($club)) {
      $conditions[] = "club LIKE '%$club%'";
    }
    if (!empty($support_type)) {
      $conditions[] = "support_type LIKE '%$support_type%'";
    }

    // 建構完整 SQL
    $sql = "SELECT * FROM club_requirements";
    if (count($conditions) > 0) {
      $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $result = mysqli_query($link, $sql);
    // if (!$result) {
    //   die("Query failed: " . mysqli_error($link));
    // }
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
                    <h4><a href='history.details_cl.php?clrequirement_num=" . $row['clrequirement_num'] . "'>" . htmlspecialchars($row['title']) . "</a></h4>
                    <ul>
                        <li>學校：<span>" . htmlspecialchars($row['school']) . "</span></li>
                        <li>社團：<span>" . htmlspecialchars($row['club']) . "</span></li>
                        <li>需要贊助類型：<span>" . htmlspecialchars($row['support_type']) . "</span></li>
                    </ul>
                    <div class='main-button'>
                        <a href='history.details_cl.php?clrequirement_num=" . $row['clrequirement_num'] . "'>了解活動詳情</a>
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