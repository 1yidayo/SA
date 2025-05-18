<?php
session_start();
if (!isset($_SESSION['identityID']) || $_SESSION['level'] !== 'en') {
    header("Location: login.php");
    exit;
}

$link = mysqli_connect('localhost', 'root', '', 'SAS');
if (!$link) {
    die("資料庫連線失敗: " . mysqli_connect_error());
}

$enterprise_identityID = $_SESSION['identityID'];
$mode = $_GET['mode'] ?? 'receive';  // receive: 被申請, send: 我邀請
$status = $_GET['status'] ?? '待處理';

// 轉義輸入防止SQL Injection
$mode = mysqli_real_escape_string($link, $mode);
$status = mysqli_real_escape_string($link, $status);

if ($mode === 'receive') {
    $sql = "SELECT cr.*, cl.school, cl.club, cl.clins, er.title
            FROM cooperation_requests cr
            JOIN identity cl ON cr.club_identityID = cl.identityID
            JOIN en_requirements er ON cr.enrequirement_num = er.enrequirement_num
            WHERE cr.enterprise_identityID = '$enterprise_identityID'
              AND cr.initiator = 'club'
              AND cr.status = '$status'
            ORDER BY cr.request_time DESC";
    $title = "收到社團申請的合作";
} else {
    $sql = "SELECT cr.*, cl.school, cl.club, cl.clins, er.title
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
  <meta charset="UTF-8" />
  <title><?= htmlspecialchars($title) ?> | 社團企業媒合平台</title>
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
              <li><a href="index_en.php">首頁</a></li>
              <li><a href="browse_en.php">瀏覽</a></li>
              <li><a href="post_en.php">發布</a></li>
              <li><a href="post.history_en.php">發布歷史</a></li>
              <li><a href="cooperations_en.php" class="active">我的合作</a></li>
              <li><a href="self_en.php">個人頁面</a></li>
              <li><a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登出</a></li>
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
          <h3><?= htmlspecialchars($title) ?></h3>
        </div>
      </div>
    </div>
  </div>

  <!-- 內容區 -->
  <div class="container mt-5">

    <!-- 模式切換 -->
    <div class="mb-3">
      <a href="?mode=receive&status=<?= urlencode($status) ?>"
        class="btn btn-outline-primary <?= ($mode === 'receive') ? 'active' : '' ?>">收到的申請</a>
      <a href="?mode=send&status=<?= urlencode($status) ?>"
        class="btn btn-outline-primary <?= ($mode === 'send') ? 'active' : '' ?>">我邀請的合作</a>
    </div>

    <!-- 狀態切換 -->
    <div class="mb-3">
      <?php foreach (['待處理', '同意', '拒絕'] as $st): ?>
        <a href="?mode=<?= urlencode($mode) ?>&status=<?= urlencode($st) ?>"
          class="btn btn-sm btn-outline-secondary <?= ($status === $st) ? 'active' : '' ?>"><?= htmlspecialchars($st) ?></a>
      <?php endforeach; ?>
    </div>

    <!-- 合作清單 -->
    <?php if (!$result || mysqli_num_rows($result) === 0): ?>
      <p class="text-muted">目前沒有合作紀錄。</p>
    <?php else: ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card mb-3 shadow-sm">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
            <p class="card-text">社團：<?= htmlspecialchars($row['school']) ?> <?= htmlspecialchars($row['club']) ?></p>
            <p class="card-text">IG：
              <a href="https://instagram.com/<?= htmlspecialchars($row['clins']) ?>" target="_blank">
                @<?= htmlspecialchars($row['clins']) ?>
              </a>
            </p>
            <p class="card-text">申請時間：<?= htmlspecialchars($row['request_time']) ?></p>
            <p class="card-text">
              狀態：
              <span class="status-tag status-<?= htmlspecialchars($row['status']) ?>">
                <?= htmlspecialchars($row['status']) ?>
              </span>
            </p>

            <?php if ($mode === 'receive' && $status === '待處理'): ?>
              <form method="POST" action="handle_cooperation.php" class="mt-2">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
                <button type="submit" name="action" value="accept" class="btn btn-success">同意</button>
                <button type="submit" name="action" value="reject" class="btn btn-danger">拒絕</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>

  </div>

  <!-- Footer -->
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
