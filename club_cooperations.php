<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'SAS');

$club_identityID = $_SESSION['identityID'];

$sql = "SELECT cr.*, e.title AS en_title, i.enterprise, cr.status, cr.request_time
        FROM cooperation_requests cr
        JOIN en_requirements e ON cr.enrequirement_num = e.enrequirement_num
        JOIN identity i ON cr.enterprise_identityID = i.identityID
        WHERE cr.club_identityID = '$club_identityID'
        ORDER BY cr.request_time DESC";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>我的合作清單</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/fontawesome.css" />
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css" />
  <link rel="stylesheet" href="assets/css/owl.css" />
  <link rel="stylesheet" href="assets/css/animate.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <style>
    .status-tag {
      padding: 5px 10px;
      border-radius: 12px;
      font-size: 0.85rem;
      color: white;
      display: inline-block;
    }
    .status-待處理 { background-color: #f0ad4e; }
    .status-同意 { background-color: #5cb85c; }
    .status-拒絕 { background-color: #d9534f; }
  </style>
</head>
<body>
    <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="cl.php">首頁</a></li>
              <li><a href="properties2.php" class="active">瀏覽</a></li>
              <li><a href="club contact.php">發布</a></li>
              <li><a href="clubhistory.php">發布歷史</a></li>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="club_cooperations.php">我的合作</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="enterprise_cooperations.php">合作請求</a></li>
              <?php endif; ?>

              <li><a href="self.cl.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
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
          <h3>合作清單</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <h3 class="mb-4">📌 我申請的合作清單</h3>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= $row['en_title'] ?></h5>
          <p class="card-text">企業名稱：<?= $row['enterprise'] ?></p>
          <p class="card-text">申請時間：<?= $row['request_time'] ?></p>
          <p class="card-text">
            狀態：<span class="status-tag status-<?= $row['status'] ?>"><?= $row['status'] ?></span>
          </p>
        </div>
      </div>
    <?php endwhile; ?>
  </div><br><br>

<footer>
    <div class="container">
      <div class="col-lg-8">
        <p style="text-align: left; font-weight: bold;">社團企業媒合平台</p>
      </div>
    </div>
  </footer>

  <!-- JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
