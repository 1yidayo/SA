<?php
session_start();
if (!isset($_SESSION['identityID']) || empty($_SESSION['identityID'])) {
    echo "錯誤：尚未登入";
    exit;
}
// echo "登入身份ID: " . $_SESSION['identityID'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>社團企業媒合平台</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css" />
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css" />
  <link rel="stylesheet" href="assets/css/owl.css" />
  <link rel="stylesheet" href="assets/css/animate.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <style>
    .custom-orange-btn {
      background-color: #ff7f50;
      color: #000;
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
      border-color: #e3643c;
    }

    .text-links a {
      text-decoration: none;
      color: #333;
      margin: 0 5px;
    }

    .text-links a:hover {
      text-decoration: underline;
    }

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

    button,
    input[type="submit"] {
      background-color: #ff7f50;
      color: #000;
      border: 1px solid #ff7f50;
    }

    button:hover,
    input[type="submit"]:hover {
      background-color: #e3643c;
      color: #fff;
    }
  </style>
</head>

<body>
  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="ai.html">首頁</a></li>
                            <li><a href="properties3.php">瀏覽</a></li>
                            <li><a href="alumni contact.php"  class="active">發布</a></li>
                            <li><a href="aihistory.php">發布歷史</a></li>
                            <li><a href="self.ai.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for ai.html"><i class="fa fa-calendar"></i>進階搜尋</a>
                            </li>
            </ul>
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
          <h3>我的發布歷史</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
      <div class="row properties-box">
        <?php
        $identityID = $_SESSION['identityID'];

        // 連線資料庫
        $link = mysqli_connect('localhost', 'root', '', 'SAS');

        if (!$link) {
          echo "<p>資料庫連線失敗！</p>";
          exit;
        }

        // 只查詢登入者自己發的歷史
        $sql = "SELECT ar.*, i.ainame, i.ainins
        FROM ai_requirements ar
        JOIN identity i ON ar.identityID = i.identityID
        WHERE ar.identityID = '$identityID'
        ORDER BY ar.created_time DESC";

$result = mysqli_query($link, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items adv'>
            <div class='item uniform-box'>
              <h4><a href='ai.php?airequirement_num=" . htmlspecialchars($row['airequirement_num']) . "'>" . htmlspecialchars($row['title']) . "</a></h4>
              <ul>
                <li><span>" . htmlspecialchars($row['text']) . "</span></li>
                <br><br>
                <li>校友名稱：<span>" . htmlspecialchars($row['ainame']) . "</span></li>
                <br>
                <li>校友聯絡方式：<span>" . htmlspecialchars($row['ainins']) . "</span></li>
                <br>
              </ul>
              <div class='text-links'>
                <a href='ai.php?airequirement_num=" . htmlspecialchars($row['airequirement_num']) . "' class='custom-orange-btn'>詳情</a>
                <a href='editaihistory.php?airequirement_num=" . htmlspecialchars($row['airequirement_num']) . "'>修改</a> |
                <a href='deleteaihistory.php?airequirement_num=" . htmlspecialchars($row['airequirement_num']) . "' onclick=\"return confirm('確定要刪除嗎？');\">刪除</a>
              </div>
              <br>
              <p class='publish-time'>發布時間：<span>" . htmlspecialchars($row['created_time']) . "</span></p>
            </div>
          </div>";
  }
}
 else {
          echo "<p>目前沒有發布的歷史資料。</p>";
        }

        mysqli_close($link);
        ?>
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>
