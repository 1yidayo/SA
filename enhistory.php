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
              <li><a href="en.html" class="active">首頁</a></li>
              <li><a href="properties.php">瀏覽</a></li>
              <li><a href="en contact.html">發布</a></li>
              <li><a href="enhistory.php">發布歷史</a></li>
              <li><a href="first.html">登出</a></li>
              <li><a href="advanced search for enterprise.html"><i class="fa fa-calendar"></i>進階搜尋</ruby></a>
              </li>
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
          <span class="breadcrumb"><a href="#">Home</a> / Contact Us</span>
          <h3>發布歷史</h3>
        </div>
      </div>
    </div>
  </div>

  <?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

// 連接資料庫
$conn = new mysqli('localhost', 'root', '', 'SA');
$conn->set_charset("utf8");

// 使用 JOIN 抓該使用者發布過的需求
$sql = "
    SELECT club_requirements.*
    FROM club_requirements
    JOIN users ON club_requirements.club = users.username
    WHERE users.username = ?
";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>發布歷史紀錄</title>
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">您的發布歷史</h2>

    <?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: first.html");
    exit();
}

$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "your_db_name"; // ← 改成你的 DB 名

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
$conn->set_charset("utf8");

// 先處理表單送出（更新資料）
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['requirement_num'])) {
    $requirement_num = $_POST['requirement_num'];
    $money = $_POST['money'];
    $type = $_POST['type'];
    $code = $_POST['code'];
    $ins = $_POST['ins'];
    $title = $_POST['title'];
    $information = $_POST['information'];

    $update_sql = "
        UPDATE club_requirements
        SET money=?, type=?, code=?, ins=?, title=?, information=?
        WHERE requirement_num=?
    ";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssi", $money, $type, $code, $ins, $title, $information, $requirement_num);
    $stmt->execute();
}

// 撈取該企業的資料
$username = $_SESSION['username'];
$sql = "SELECT * FROM club_requirements WHERE enterprise=? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>我的發布歷史</title>
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h2>我的發布紀錄（可直接修改）</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>贊助範圍</th>
        <th>類型</th>
        <th>統一編號</th>
        <th>聯絡方式</th>
        <th>標題</th>
        <th>內文</th>
        <th>發布時間</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <form method="POST" action="enhistory.php">
            <input type="hidden" name="requirement_num" value="<?= $row['requirement_num'] ?>">
            <td><input type="text" class="form-control" name="money" value="<?= htmlspecialchars($row['money']) ?>"></td>
            <td><input type="text" class="form-control" name="type" value="<?= htmlspecialchars($row['type']) ?>"></td>
            <td><input type="text" class="form-control" name="code" value="<?= htmlspecialchars($row['code']) ?>"></td>
            <td><input type="text" class="form-control" name="ins" value="<?= htmlspecialchars($row['ins']) ?>"></td>
            <td><input type="text" class="form-control" name="title" value="<?= htmlspecialchars($row['title']) ?>"></td>
            <td><textarea class="form-control" name="information"><?= htmlspecialchars($row['information']) ?></textarea></td>
            <td><?= $row['created_at'] ?></td>
            <td><button type="submit" class="btn btn-success btn-sm">儲存</button></td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>



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