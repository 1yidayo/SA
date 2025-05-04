<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <title>發布歷史紀錄</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <style>
    .table th, .table td {
      text-align: center;
    }
    .table th {
      background-color: #f8f9fa;
    }
    .btn-sm {
      font-size: 12px;
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
              <li><a href="ai.html" class="active">首頁</a></li>
              <li><a href="properties3.php">瀏覽</a></li>
              <li><a href="alumni contact.php">發布</a></li>
              <li><a href="aihistory.php">發布歷史</a></li>
              <li><a href="self.ai.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for ai.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

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

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">首頁</a> / 發布歷史</span>
          <h3>發布歷史</h3>
        </div>
      </div>
    </div>
  </div>

  <?php
  session_start();
  if (!isset($_SESSION['identity_ID'])) {
      header("Location: login.php");
      exit();
  }

  $identityID = $_SESSION['identity_ID'];  // 從 session 中取得身份 ID

  // 連接資料庫
  $conn = new mysqli('localhost', 'root', '', 'SAS');
  $conn->set_charset("utf8");

  // SQL 查詢，使用準備語句（Prepared Statement）
  $sql = "SELECT * FROM ai_requirements WHERE identity_ID = ?";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
      die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("i", $identityID);  // 假設 identity_ID 是整數型別
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <div class="container mt-5">
    <h2 class="mb-4">您的發布歷史</h2>

    <?php if ($result->num_rows > 0): ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>標題</th>
            <th>活動地區</th>
            <th>活動月份</th>
            <th>內文</th>
            <th>活動時間</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['title']) ?></td>
              <td><?= htmlspecialchars($row['region']) ?></td>
              <td><?= htmlspecialchars($row['event_time']) ?></td>
              <td><?= htmlspecialchars($row['information']) ?></td>
              <td>
                <a href="view_post.php?id=<?= $row['airequirement_num'] ?>" class="btn btn-info btn-sm">查看</a>
                <a href="delete_post.php?id=<?= $row['airequirement_num'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除這筆資料嗎？')">刪除</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>您尚未發布任何需求。</p>
    <?php endif; ?>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
