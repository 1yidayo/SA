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

    .custom-orange-btn {
      background-color: #ff7f50;
      /* 橘色背景 */
      color: #000;
      /* 黑色文字 */
      border: 1px solid #ff7f50;
      padding: 6px 12px;
      font-size: 14px;
      border-radius: 4px;
      text-decoration: none;
      transition: background-color 0.3s, color 0.3s;
    }

    .custom-orange-btn:hover {
      background-color: #e3643c;
      color: #fff;
      /* 滑過時白字 */
      border-color: #e3643c;
    }


    .properties-box {
      display: flex;
      flex-wrap: wrap;
      /* 允許換行 */
      gap: 10px;
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

    /* 確保每個歷史紀錄框高度一致 */
    .uniform-box {
      min-height: 430px;
      /* 根據內容調整，讓每筆高度一致 */
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
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="index_cl.php">首頁</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="index_en.php">首頁</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="browse_cl.php">瀏覽</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="properties.php">瀏覽</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post_cl.php">發布</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="en_contact.php">發布</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post.history_cl.php" class="active">發布歷史</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="enhistory.php" class="active">發布歷史</a></li>
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
          <h3>我的發布歷史</h3>
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
        $sql = "SELECT * FROM club_requirements WHERE identityID = '{$_SESSION['identityID']}' ORDER BY created_time DESC";
        $result = mysqli_query($link, $sql);

        // 對照表：英文 value -> 中文顯示
        $supportTypeMap = [
          '金錢' => '金錢',
          '物資' => '物資',
          '場地' => '場地',
          '提供實習' => '提供實習',
          'exposure' => '社群曝光／媒體報導',
          'other' => '其他',
        ];

        while ($row = mysqli_fetch_assoc($result)) {
          $support_type = $row['support_type'];
          $support_type_display = $supportTypeMap[$support_type] ?? $support_type;

          // 顯示人數（僅在不是社群曝光時）
          $people_display = ($support_type === '提供實習') ? $row['intern_number'] : $row['people'];

          echo "<div class='properties-items'>
      <div class='item uniform-box'>
          <h4><a href='history.details_cl.php?clrequirement_num=" . $row['clrequirement_num'] . "'>" . $row['title'] . "</a></h4>
          <ul>
              <li><span>" . htmlspecialchars($row['school']) . "</span></li>
              <li><span>" . htmlspecialchars($row['club']) . "</span></li>
              <br>";

          // 👉 只有當 support_type 不是 "exposure" 時才顯示預估人數／實習人數
          if ($support_type !== 'exposure') {
            echo "<li>" . (($support_type === '提供實習') ? '預估需要的實習人數: ' : '預估規模：') . "<span>" . htmlspecialchars($people_display) . "</span></li>
              <br>";
          }

          // ✅ 顯示預算（僅金錢）
          if ($support_type === '金錢') {
            echo "<li>預算範圍：<span>" . htmlspecialchars($row['money']) . "</span></li>
              <br>";
          }

          // ✅ 顯示活動類型（轉為中文）
          echo "<li>活動類型：<span>" . htmlspecialchars($support_type_display) . "</span></li>
          </ul>
          <div class='text-links'>
              <a href='history.details_cl.php?clrequirement_num=" . $row['clrequirement_num'] . "' class='custom-orange-btn'>詳情</a>
              <a href='history.edit_cl.php?clrequirement_num=" . $row['clrequirement_num'] . "'>修改</a> |
              <a href='history.delete_cl.php?clrequirement_num=" . $row['clrequirement_num'] . "' onclick=\"return confirm('確定要刪除嗎？');\">刪除</a>
          </div>
          <p class='publish-time'>發布時間：<span>" . htmlspecialchars($row['created_time']) . "</span></p>
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