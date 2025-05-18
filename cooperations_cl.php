<?php
session_start();
if (!isset($_SESSION['identityID']) || $_SESSION['level'] !== 'cl') {
    header("Location: login.php");
    exit;
}

$link = new mysqli('localhost', 'root', '', 'SAS');
if ($link->connect_errno) {
    die("連線失敗: " . $link->connect_error);
}

$club_identityID = $_SESSION['identityID'];
$mode = $_GET['mode'] ?? 'send';       // send = 我申請的, receive = 被邀請的
$status = $_GET['status'] ?? '待處理'; // 狀態預設待處理

// SQL 查詢依 mode 與 status 分類
if ($mode === 'send') {
    // 社團發起邀請
    $sql = "SELECT cr.*, 
                   COALESCE(e.title, '') AS en_title, 
                   i.enterprise, 
                   cr.status, 
                   cr.request_time, 
                   cr.enrequirement_num
            FROM cooperation_requests cr
            LEFT JOIN en_requirements e ON cr.enrequirement_num = e.enrequirement_num
            LEFT JOIN identity i ON cr.enterprise_identityID = i.identityID
            WHERE cr.club_identityID = ? 
              AND cr.initiator = 'club' 
              AND cr.status = ?
            ORDER BY cr.request_time DESC";
} else {
    // 被企業邀請
    $sql = "SELECT cr.*, 
                   COALESCE(e.title, '') AS en_title, 
                   i.enterprise, 
                   cr.status, 
                   cr.request_time, 
                   cr.enrequirement_num
            FROM cooperation_requests cr
            LEFT JOIN en_requirements e ON cr.enrequirement_num = e.enrequirement_num
            LEFT JOIN identity i ON cr.enterprise_identityID = i.identityID
            WHERE cr.club_identityID = ? 
              AND cr.initiator = 'enterprise' 
              AND cr.status = ?
            ORDER BY cr.request_time DESC";
}

$stmt = $link->prepare($sql);
$stmt->bind_param('is', $club_identityID, $status);
$stmt->execute();
$result = $stmt->get_result();

$title = ($mode === 'send') ? "我申請的合作" : "被企業邀請的合作";
?>

<!DOCTYPE html>
<html lang="zh-Hant">

<head>
  <meta charset="UTF-8" />
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
                <li><a href="index_cl.php">首頁</a></li>
                <li><a href="browse_cl.php">瀏覽</a></li>
                <li><a href="post_cl.php">發布</a></li>
                <li><a href="post.history_cl.php">發布歷史</a></li>
                <li><a href="cooperations_cl.php" class="active">我的合作</a></li>
                <li><a href="self_cl.php">個人頁面</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="index_en.php">首頁</a></li>
                <li><a href="browse_en.php">瀏覽</a></li>
                <li><a href="post_en.php">發布</a></li>
                <li><a href="post.history_en.php">發布歷史</a></li>
                <li><a href="cooperations_en.php" class="active">我的合作</a></li>
                <li><a href="self_en.php">個人頁面</a></li>
              <?php endif; ?>
              <li><a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登出</a></li>
            </ul>
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
    <h4 class="mb-4"><?= htmlspecialchars($title) ?></h4>

    <!-- 切換角色 -->
    <div class="mb-3">
      <a href="?mode=send&status=<?= urlencode($status) ?>"
        class="btn btn-outline-primary <?= ($mode === 'send') ? 'active' : '' ?>">我申請的</a>
      <a href="?mode=receive&status=<?= urlencode($status) ?>"
        class="btn btn-outline-primary <?= ($mode === 'receive') ? 'active' : '' ?>">被邀請的</a>
    </div>

    <!-- 切換狀態 -->
    <div class="mb-3">
      <?php foreach (["待處理", "同意", "拒絕"] as $st): ?>
        <a href="?mode=<?= htmlspecialchars($mode) ?>&status=<?= urlencode($st) ?>"
          class="btn btn-sm btn-outline-secondary <?= ($status === $st) ? 'active' : '' ?>"><?= htmlspecialchars($st) ?></a>
      <?php endforeach; ?>
    </div>

    <!-- 顯示合作 -->
    <?php if ($result->num_rows === 0): ?>
      <p class="text-muted">目前沒有合作紀錄。</p>
    <?php endif; ?>

    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">
            <a href="en_activity_detail.php?enrequirement_num=<?= htmlspecialchars($row['enrequirement_num'] ?? '') ?>" target="_blank">
              <?= htmlspecialchars($row['en_title']) ?>
            </a>
          </h5>
          <p class="card-text">企業名稱：<?= htmlspecialchars($row['enterprise']) ?></p>
          <p class="card-text">申請時間：<?= htmlspecialchars($row['request_time']) ?></p>
          <p class="card-text">狀態：
            <span class="status-tag status-<?= htmlspecialchars($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span>
          </p>
        </div>
      </div>
    <?php endwhile; ?>

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

<?php
$stmt->close();
$link->close();
?>
