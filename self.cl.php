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
              <li><a href="cl.html" class="active">首頁</a></li>
              <li><a href="properties2.php">瀏覽</a></li>
              <li><a href="club contact.html">發布</a></li>
              <li><a href="clubhistory.php">發布歷史</a></li>
              <li><a href="self.cl.php">個人頁面</a></li>
              <li><a href="first.html">登出</a></li>
              <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</ruby></a>
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
          <span class="breadcrumb"><a href="#">Home</a> / My Page</span>
          <h3>個人頁面</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- <?php
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
?> -->

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>發布歷史紀錄</title>
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5" style="">
    
    <div class="contact-page section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6" style="margin:left"><h2 class="mb-4">您的個人檔案</h2>
              <form id="contact-form" action="club_contact.php" method="post" enctype="multipart/form-data" style="width: 80%; margin-left: 0%;" >
     
                    <div class="col-12">
                      <div class="input-group">
                        <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                          <span class="ms-1"><b>學校名稱</b></span>
                        </div>
                        <input class="form-control" type="text" placeholder="請輸入學校名稱(請輸入學校全名)" aria-label="請輸入學校全名"
                          name="school">
                      </div>
                      <div class="col-12">
                      <div class="input-group">
                        <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                          <span class="ms-1"><b>社團名稱</b></span>
                        </div>
                        <input class="form-control" type="text" placeholder="請輸入社團名稱" aria-label="請輸入社團名稱"
                          name="school">
                      </div>
                      <div class="col-12">
                      <div class="input-group">
                        <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                          <span class="ms-1"><b>社團規模</b></span>
                        </div>
                        <input class="form-control" type="text" placeholder="請輸入社團規模" aria-label="請輸入社團規模"
                          name="school">
                      </div>
                      <div class="col-12">
                      <div class="input-group">
                        <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                          <span class="ms-1"><b>社團成立年份</b></span>
                        </div>
                        <input class="form-control" type="text" placeholder="請輸入社團成立年份" aria-label="請輸入社團成立年份"
                          name="school">
                      </div>
                      <div class="col-12">
                      <div class="input-group">
                        <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                          <span class="ms-1"><b>社團類型</b></span>
                        </div>
                        <input class="form-control" type="text" placeholder="請輸入社團類型" aria-label="請輸入社團類型"
                          name="school">
                      </div>
                      <div class="col-12">
                      <div class="input-group">
                        <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                          <span class="ms-1"><b>社群連結</b></span>
                        </div>
                        <input class="form-control" type="text" placeholder="請輸入社群連結" aria-label="請輸入社群連結"
                          name="school">
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-light w-100 py-2" type="submit"><b>發布</b></button>
                      </div>
                    </div>
    
                  </div>
              </form>
            </div>
    
          </div>
        </div>
      </div><br>
    <!-- <?php if ($result->num_rows > 0): ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>標題</th>
            <th>學校</th>
            <th>社團</th>
            <th>預算</th>
            <th>活動時間</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['title']) ?></td>
              <td><?= htmlspecialchars($row['school']) ?></td>
              <td><?= htmlspecialchars($row['club']) ?></td>
              <td><?= htmlspecialchars($row['money']) ?></td>
              <td><?= htmlspecialchars($row['event_time']) ?></td>
              <td>
                <a href="view_post.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">查看</a>
                <a href="delete_post.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除這筆資料嗎？')">刪除</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>您尚未發布任何需求。</p>
    <?php endif; ?> -->
    
  </div>
</body>
</html>


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