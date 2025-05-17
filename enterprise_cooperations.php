<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'SAS');

$enterprise_identityID = $_SESSION['identityID'];
$mode = $_GET['mode'] ?? 'receive';  // receive: 被申請, send: 我邀請
$status = $_GET['status'] ?? '待處理';

if ($mode === 'receive') {
  $sql = "SELECT cr.*, cl.school, cl.club, cl.clins, er.title, cr.request_time
          FROM cooperation_requests cr
          JOIN identity cl ON cr.club_identityID = cl.identityID
          JOIN en_requirements er ON cr.enrequirement_num = er.enrequirement_num
          WHERE cr.enterprise_identityID = '$enterprise_identityID'
            AND cr.initiator = 'club'
            AND cr.status = '$status'
          ORDER BY cr.request_time DESC";
  $title = "收到社團申請的合作";
} else {
  $sql = "SELECT cr.*, cl.school, cl.club, cl.clins, er.title, cr.request_time
          FROM cooperation_requests cr
          JOIN identity cl ON cr.club_identityID = cl.identityID
          JOIN en_requirements er ON cr.enrequirement_num = er.enrequirement_num
          WHERE cr.enterprise_identityID = '$enterprise_identityID'
            AND cr.initiator = 'enterprise'
            AND cr.status = '$status'
          ORDER BY cr.request_time DESC";
  $title = "我邀請社團的合作";
}

$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="zh-Hant">

<head>
  <meta charset="UTF-8">
  <title><?= $title ?> | 社團企業媒合平台</title>
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
                            <li><a href="en.html">首頁</a></li>
                            <li><a href="properties.php">瀏覽</a></li>
                            <li><a href="en_contact.php">發布</a></li>
                            <li><a href="enhistory.php">發布歷史</a></li>
                            <li><a href="enterprise_cooperations.php"  class="active">我的合作</a></li>
                            <li><a href="self.en.php">個人頁面</a></li>
                            <li><a href="aftersearchforen.php">進階搜尋</a></li>
                            <li><a href="login.html"><i class="fa fa-calendar"></i>登出</a>
                            </li>
                        </ul>
            <a class="menu-trigger"><span>Menu</span></a>
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
          <h3><?= $title ?></h3>
        </div>
      </div>
    </div>
  </div>

  <!-- 內容區 -->
  <div class="container mt-5">
    <!-- 模式切換 -->
    <div class="mb-3">
      <a href="?mode=receive&status=<?= $status ?>" class="btn btn-outline-primary <?= ($mode == 'receive') ? 'active' : '' ?>">收到的申請</a>
      <a href="?mode=send&status=<?= $status ?>" class="btn btn-outline-primary <?= ($mode == 'send') ? 'active' : '' ?>">我邀請的合作</a>
    </div>

    <!-- 狀態切換 -->
    <div class="mb-3">
      <?php foreach (['待處理', '同意', '拒絕'] as $st): ?>
        <a href="?mode=<?= $mode ?>&status=<?= $st ?>" class="btn btn-sm btn-outline-secondary <?= ($status == $st) ? 'active' : '' ?>"><?= $st ?></a>
      <?php endforeach; ?>
    </div>

    <!-- 合作清單 -->
    <?php if (mysqli_num_rows($result) == 0): ?>
      <p class="text-muted">目前沒有合作紀錄。</p>
    <?php endif; ?>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= $row['title'] ?></h5>
          <p class="card-text">社團：<?= $row['school'] ?> <?= $row['club'] ?></p>
          <p class="card-text">IG：<a href="https://instagram.com/<?= $row['clins'] ?>" target="_blank">@<?= $row['clins'] ?></a></p>
          <p class="card-text">申請時間：<?= $row['request_time'] ?></p>
          <p class="card-text">狀態：<span class="status-tag status-<?= $row['status'] ?>"><?= $row['status'] ?></span></p>

          <?php if ($mode === 'receive' && $status === '待處理'): ?>
            <form method="POST" action="handle_cooperation.php" class="mt-2">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button name="action" value="accept" class="btn btn-success">同意</button>
              <button name="action" value="reject" class="btn btn-danger">拒絕</button>
            </form>
          <?php endif; ?>
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
