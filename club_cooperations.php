<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'SAS');

$club_identityID = $_SESSION['identityID'];
$mode = $_GET['mode'] ?? 'send';       // send = 我申請的, receive = 被邀請的
$status = $_GET['status'] ?? '待處理'; // 狀態預設待處理

// SQL 查詢依 mode 與 status 分類
if ($mode === 'send') {
  $sql = "SELECT cr.*, e.title AS en_title, i.enterprise, cr.status, cr.request_time
          FROM cooperation_requests cr
          JOIN en_requirements e ON cr.enrequirement_num = e.enrequirement_num
          JOIN identity i ON cr.enterprise_identityID = i.identityID
          WHERE cr.club_identityID = '$club_identityID'
            AND cr.initiator = 'club'
            AND cr.status = '$status'
          ORDER BY cr.request_time DESC";
  $title = "我申請的合作";
} else {
  $sql = "SELECT cr.*, e.title AS en_title, i.enterprise, cr.status, cr.request_time
          FROM cooperation_requests cr
          JOIN en_requirements e ON cr.enrequirement_num = e.enrequirement_num
          JOIN identity i ON cr.enterprise_identityID = i.identityID
          WHERE cr.club_identityID = '$club_identityID'
            AND cr.initiator = 'enterprise'
            AND cr.status = '$status'
          ORDER BY cr.request_time DESC";
  $title = "被企業邀請的合作";
}

$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="zh-Hant">

<head>
  <meta charset="UTF-8">
  <title>我的合作清單 | 社團企業媒合平台</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/fontawesome.css" />
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css" />
  <link rel="stylesheet" href="assets/css/owl.css" />
  <link rel="stylesheet" href="assets/css/animate.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <style>
    .status-tag {
      padding: 5px 10px;
      border-radius: 12px;
      font-size: 0.85rem;
      color: white;
      display: inline-block;
    }

    .status-待處理 {
      background-color: #f0ad4e;
    }

    .status-同意 {
      background-color: #5cb85c;
    }

    .status-拒絕 {
      background-color: #d9534f;
    }
  </style>
</head>

<body>
  <!-- 導覽列 -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="cl.php" class="active">首頁</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="en_html" class="active">首頁</a></li>
              <?php endif; ?>
              <li><a href="properties2.php">瀏覽</a></li>
              <li><a href="club_contact.php">發布</a></li>
              <li><a href="clubhistory.php">發布歷史</a></li>
              <li><a href="club_cooperations.php" class="active">我的合作</a></li>
              <li><a href="self.cl.php">個人頁面</a></li>
              <li><a href="aftersearchforclub.php">進階搜尋</a></li>
              <li><a href="login.html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登出</a></li>
              
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- 頁首 -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>我的合作清單</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- 內容 -->
  <div class="container mt-5">
    <h4 class="mb-4"><?= $title ?></h4>

    <!-- 切換角色 -->
    <div class="mb-3">
      <a href="?mode=send&status=<?= $status ?>"
        class="btn btn-outline-primary <?= ($mode == 'send') ? 'active' : '' ?>">我申請的</a>
      <a href="?mode=receive&status=<?= $status ?>"
        class="btn btn-outline-primary <?= ($mode == 'receive') ? 'active' : '' ?>">被邀請的</a>
    </div>

    <!-- 切換狀態 -->
    <div class="mb-3">
      <?php foreach (['待處理', '同意', '拒絕'] as $st): ?>
        <a href="?mode=<?= $mode ?>&status=<?= $st ?>"
          class="btn btn-sm btn-outline-secondary <?= ($status == $st) ? 'active' : '' ?>"><?= $st ?></a>
      <?php endforeach; ?>
    </div>

    <!-- 顯示合作 -->
    <?php if (mysqli_num_rows($result) == 0): ?>
      <p class="text-muted">目前沒有合作紀錄。</p>
    <?php endif; ?>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= $row['en_title'] ?></h5>
          <p class="card-text">企業名稱：<?= $row['enterprise'] ?></p>
          <p class="card-text">申請時間：<?= $row['request_time'] ?></p>
          <p class="card-text">狀態：
            <span class="status-tag status-<?= $row['status'] ?>"><?= $row['status'] ?></span>
          </p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- 頁尾 -->
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