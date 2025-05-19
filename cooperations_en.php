<?php
session_start();
if (!isset($_SESSION['identityID']) || $_SESSION['level'] !== 'en') {
  header("Location: login.php");
  exit;
}

$link = new mysqli('localhost', 'root', '', 'SAS');
if ($link->connect_errno) {
  die("資料庫連線失敗: " . $link->connect_error);
}

$enterprise_identityID = $_SESSION['identityID'];
$mode = $_GET['mode'] ?? 'receive';
$status = $_GET['status'] ?? '待處理';

if ($mode === 'receive') {
  $sql = "SELECT cr.*, 
       COALESCE(e.title, '') AS en_title,
       COALESCE(e.enterprise, '') AS enterprise,
       i.club, i.school,
       cr.request_time, cr.enrequirement_num
FROM cooperation_requests cr
LEFT JOIN en_requirements e ON cr.enrequirement_num = e.enrequirement_num
LEFT JOIN identity i ON cr.club_identityID = i.identityID
WHERE cr.enterprise_identityID = ?
  AND cr.initiator = 'club'
  AND cr.status = ?
ORDER BY cr.request_time DESC;
";

} else {
  $sql = "SELECT cr.*, 
       COALESCE(c.title, '') AS cl_title,
       i.club, i.school,
       cr.request_time, cr.clrequirement_num
FROM cooperation_requests cr
LEFT JOIN club_requirements c ON cr.clrequirement_num = c.clrequirement_num
LEFT JOIN identity i ON cr.club_identityID = i.identityID
WHERE cr.enterprise_identityID = ?
  AND cr.initiator = 'enterprise'
  AND cr.status = ?
ORDER BY cr.request_time DESC;
";

}

$stmt = $link->prepare($sql);
$stmt->bind_param('is', $enterprise_identityID, $status);
$stmt->execute();
$result = $stmt->get_result();

$title = ($mode === 'receive') ? "收到社團申請的合作" : "邀請社團的合作";
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
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="index_cl.php">首頁</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="index_en.php">首頁</a></li>
              <?php endif; ?>

              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="browse_cl.php">瀏覽</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="browse_en.php">瀏覽</a></li>
              <?php endif; ?>

              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post_cl.php">發布</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post_en.php">發布</a></li>
              <?php endif; ?>

              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post.history_cl.php">發布歷史</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post.history_en.php">發布歷史</a></li>
              <?php endif; ?>

              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="cooperations_cl.php" class="active">我的合作</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="cooperations_en.php" class="active">我的合作</a></li>
              <?php endif; ?>

              <li><a href="self_<?= $_SESSION['level'] ?>.php">個人頁面</a></li>
              <li><a href="logout.php">登出</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3><?= htmlspecialchars($title) ?></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <!-- <h4 class="mb-4"><?= htmlspecialchars($title) ?></h4> -->

    <div class="mb-3">
      <a href="?mode=receive&status=<?= urlencode($status) ?>"
        class="btn btn-outline-primary <?= ($mode === 'receive') ? 'active' : '' ?>">收到申請的合作</a>
      <a href="?mode=send&status=<?= urlencode($status) ?>"
        class="btn btn-outline-primary <?= ($mode === 'send') ? 'active' : '' ?>">我邀請的合作</a>
    </div>
    <div class="mb-3">
      <?php foreach (["待處理", "同意", "拒絕"] as $st): ?>
        <a href="?mode=<?= htmlspecialchars($mode) ?>&status=<?= urlencode($st) ?>"
          class="btn btn-sm btn-outline-secondary <?= ($status === $st) ? 'active' : '' ?>"><?= htmlspecialchars($st) ?></a>
      <?php endforeach; ?>
    </div>

    <?php if ($result->num_rows === 0): ?>
      <p class="text-muted">目前沒有合作紀錄。</p>
    <?php endif; ?>

    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">
            <?php if ($mode === 'send'): ?>
              <a style="color:black;"
                href="history.details_cl.php?clrequirement_num=<?= htmlspecialchars($row['clrequirement_num']) ?>"
                target="_blank">
                <?= htmlspecialchars($row['cl_title']) ?>
              </a>
              <div style="font-weight:normal; margin-top:10px;">
                <p class="card-text">學校社團：<?= htmlspecialchars($row['school']) ?>     <?= htmlspecialchars($row['club']) ?>
                </p>
                <p class="card-text">申請時間：<?= htmlspecialchars($row['request_time']) ?></p>
                <p class="card-text">狀態：
                  <span
                    class="status-tag status-<?= htmlspecialchars($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span>
                </p>
              </div>
            <?php else: ?>
              <a style="color:black;"
                href="history.details_en.php?enrequirement_num=<?= htmlspecialchars($row['enrequirement_num']) ?>"
                target="_blank">
                <?= htmlspecialchars($row['en_title']) ?>
              </a>
              <div style="font-weight:normal; margin-top:10px;">
                <p class="card-text">企業名稱：<?= htmlspecialchars($row['enterprise']) ?></p>
                <p class="card-text">申請時間：<?= htmlspecialchars($row['request_time']) ?></p>
                <p class="card-text">狀態：
                  <span
                    class="status-tag status-<?= htmlspecialchars($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span>
                </p>
              </div>
            <?php endif; ?>
          </h5>

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
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p style="text-align: left; font-weight: bold;">社團企業媒合平台</p>
      </div>
    </div>
  </footer>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$stmt->close();
$link->close();
?>